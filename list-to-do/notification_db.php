<?php
    include('server.php');
    include('errors.php');


        $info = "SELECT users.*,todo.* FROM users INNER JOIN todo ON users.user_id = todo.user_id WHERE status_active = 1 ORDER BY due_date ASC";
        $result = mysqli_query($conn, $info);

        while ($todo = mysqli_fetch_array($result)){

            $datenow = getDatetimeNow();

                                
                if (date('Y', strtotime($datenow)) == date('Y', strtotime($todo['due_date'])) && date('m', strtotime($datenow)) == date('m', strtotime($todo['due_date'])) && date('d', strtotime($datenow)) == date('d', strtotime($todo['due_date'])))  {
                                    
                    // echo date('Y', strtotime($datenow)) . date('Y', strtotime($todo['due_date'])) . date('m', strtotime($datenow)) . date('m', strtotime($todo['due_date']));
                    // echo "\n".date('d', strtotime($datenow)) . date('d', strtotime($todo['due_date']));                                
                    if (date('H', strtotime($todo['due_date'])) - date('H', strtotime($datenow)) == 3 && date('i', strtotime($todo['due_date'])) - date('i', strtotime($datenow)) >= -5 && date('i', strtotime($todo['due_date'])) - date('i', strtotime($datenow)) <= 5){                
                        $id_todo = $todo['id_todo'];
                        $sql_user_info = "SELECT users.* FROM users 
                        INNER JOIN todo
                        ON users.user_id = todo.user_id
                        WHERE id_todo = $id_todo ";
                        $user_info = mysqli_fetch_array(mysqli_query($conn,$sql_user_info));
                        // echo $user_info['email'];
                        $emailto = $user_info['email']; //อีเมล์ผู้รับ
                        $subject = "List-To-Do notification: ". $todo['task']; //หัวข้อ
                        $headers = "From: List-To-Do ". "phathompong.se@rmuti.ac.th"; //ชื่อและอีเมลผู้ส่ง
                        $messages = "You have task ".$todo['username'] ." : " .$todo['task']." in 3 hours"."\n". //ข้อความ
                        "from: List-To-Do"; //ข้อความ
                        $send_mail = mail($emailto,$subject,$messages,$headers);
                        $user_id_noti = $user_info['user_id'];
                        $sql_noti = "INSERT INTO notification(user_id,message) VALUES ('$user_id_noti','$messages')";
                        mysqli_query($conn, $sql_noti);

                        if ($send_mail){
                            echo "success";
                        }
                    }
                }
                
                if ($todo['priority'] == "HIGH"){
                    if (date('Y', strtotime($datenow)) == date('Y', strtotime($todo['due_date'])) && date('m', strtotime($datenow)) == date('m', strtotime($todo['due_date'])) && date('d', strtotime($datenow)) == date('d', strtotime($todo['due_date'])))  {
                                    
                        // echo date('Y', strtotime($datenow)) . date('Y', strtotime($todo['due_date'])) . date('m', strtotime($datenow)) . date('m', strtotime($todo['due_date']));
                        // echo "\n".date('d', strtotime($datenow)) . date('d', strtotime($todo['due_date']));                                
                        if (date('H', strtotime($todo['due_date'])) - date('H', strtotime($datenow)) == 0 && date('i', strtotime($todo['due_date'])) - date('i', strtotime($datenow)) >= -5 && date('i', strtotime($todo['due_date'])) - date('i', strtotime($datenow)) <= 5){                
                            $id_todo = $todo['id_todo'];
                            $sql_user_info = "SELECT users.* FROM users 
                            INNER JOIN todo
                            ON users.user_id = todo.user_id
                            WHERE id_todo = $id_todo ";
                            $user_info = mysqli_fetch_array(mysqli_query($conn,$sql_user_info));
                            // echo $user_info['email'];
                            $emailto = $user_info['email']; //อีเมล์ผู้รับ
                            $subject = "List-To-Do notification: ". $todo['task']; //หัวข้อ
                            $headers = "From: List-To-Do ". "phathompong.se@rmuti.ac.th"; //ชื่อและอีเมลผู้ส่ง
                            $messages = "You have task ".$todo['username'] ." : " .$todo['task']." now it's time"."\n". //ข้อความ
                            "from: List-To-Do"; //ข้อความ
                            $send_mail = mail($emailto,$subject,$messages,$headers);
                            $user_id_noti = $user_info['user_id'];
                            $sql_noti = "INSERT INTO notification(user_id,message) VALUES ('$user_id_noti','$messages')";
                            mysqli_query($conn, $sql_noti);
    
                            if ($send_mail){
                                echo "success";
                            }
                        }
                    }
                }
    
        }
       function getDatetimeNow() {
                $tz_object = new DateTimeZone('Asia/Bangkok');
                $datetime = new DateTime();
                $datetime->setTimezone($tz_object);
                return $datetime->format('Y\-m\-d\ H:i:s');
            }
?>