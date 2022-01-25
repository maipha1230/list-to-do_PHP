<?php

    session_start();
    include ('server.php');

    $errors = array();

    if(isset($_POST['add-todo'])){
        $task = mysqli_real_escape_string($conn,$_POST['todo-text']);
        $create_date = mysqli_real_escape_string($conn,getDatetimeNow());
        $due_date = mysqli_real_escape_string($conn,$_POST['due-time']);
        $priority = mysqli_real_escape_string($conn,$_POST['priority']);

        if (empty($task)){
            array_push($errors,"task is required");
        }
        if (empty($due_date)){
            array_push($errors,"due date is required");
        }

         if ($due_date <= $create_date){
            array_push($errors,"Due time must not less than create time");            
        }
        if (empty($priority)){
            array_push($errors,"priority is required");
        }
  
        if(count($errors) == 0 ){
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO todo (user_id,task,due_date,status_active,priority) VALUES ('$user_id','$task', '$due_date', '1','$priority')";
            mysqli_query($conn,$sql);
            header ('location: index.php');
        } else {
            array_push($errors, "something went wrong try again");
            $_SESSION['error'] = $errors[0];
            header ('Location: index.php');
        }       
    }
    
    $user_id_query = $_SESSION['user_id'];
    $username_query = $_SESSION['username'];

    $query_todo_high = "SELECT * FROM todo WHERE status_active = 1 AND user_id = $user_id_query AND priority = 'HIGH' ORDER BY due_date ASC";
    $query_todo_low = "SELECT * FROM todo WHERE status_active = 1 AND user_id = $user_id_query  AND priority = 'LOW' ORDER BY due_date ASC";
    
        

    
    if(!empty($query_todo_high)){
        $todos_high = mysqli_query($conn,$query_todo_high);
    }
    if(!empty($query_todo_low)){
        $todos_low = mysqli_query($conn,$query_todo_low);
    }
    
    
    
    if (isset($_POST['finish-btn'])){
        $finish_id = mysqli_real_escape_string($conn,$_POST['finish-btn']);
        
        $sql_task_finish = "INSERT INTO todo_finish(id_todo) VALUES ('$finish_id')" ;
        mysqli_query($conn,$sql_task_finish);
        $update_status_finish = "UPDATE todo SET status_active = 2 WHERE id_todo = $finish_id";
        mysqli_query($conn,$update_status_finish); 
        header('Location: index.php');       

    }

    if (isset($_POST['expire-btn'])){
        $expire_id = mysqli_real_escape_string($conn,$_POST['expire-btn']);
        $sql_task_expire = "INSERT INTO todo_expire(id_todo) VALUES ('$expire_id')";
        mysqli_query($conn,$sql_task_expire);
        $update_status_expire = "UPDATE todo SET status_active = 3 WHERE id_todo = $expire_id";
        mysqli_query($conn,$update_status_expire);
        header('Location: index.php');
    }

    if (isset($_POST['delete-btn'])){
        $del_id = mysqli_real_escape_string($conn,$_POST['delete-btn']);
        $sql_task_del = "DELETE FROM todo WHERE id_todo = $del_id";
        mysqli_query($conn,$sql_task_del);
        header('Location: index.php');
    }

    function getDatetimeNow() {
        $tz_object = new DateTimeZone('Asia/Bangkok');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }

?>