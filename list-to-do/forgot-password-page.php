<?php   include('server.php');
        include('errors.php');

        $errors = array();
        ?>

<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>forgot password</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="header-list">
            <h2>Forgot password</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "edit-form"  method="post" >  
                <div class="input-todo">
                    <label for="user-pass">Username: </label>
                    <input type="text" name = "user-change">
                    <label for="email-pass">Email: </label>
                    <input type="text"  name="email-change">
                    <button type="submit" name = "send" class = "btn btn-success">Send</button>
                    <a type="submit" name = "cancel-btn" class = "btn btn-danger" href = "login.php" style ="margin:10px auto;">Cancel</a>
                </div>                   
            </form>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="error">
                    <h3>
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </h3>
                </div>
            <?php endif ?>
        </div>
    
        </div>
        
    </body>
</html>

<?php

if(isset($_POST['send'])){
    $username = $_POST['user-change'];
    $email = $_POST['email-change'];
    
    if (empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($email)){
        array_push($errors, "Email is required");
    }
    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $user_sql = mysqli_fetch_array(mysqli_query($conn, $sql));

    if (empty($user_sql)){
        array_push($errors, "user, not exist");
    }
    
    if (count($errors) == 0){
        $otp = random_int(100000, 999999);
        $sql_update = "UPDATE users SET password = '$otp' WHERE username = '$username' AND email = '$email'";
        mysqli_query($conn, $sql_update);
        $emailto = $email; //อีเมล์ผู้รับ
        $subject = "List-To-Do your OTP:  "; //หัวข้อ
        $headers = "From: List-To-Do ". "phathompong.se@rmuti.ac.th"; //ชื่อและอีเมลผู้ส่ง
        $messages = "Your password is: " .$otp ; //ข้อความ
        $send_mail = mail($emailto,$subject,$messages,$headers);
        header("location:OTP.php?username=".$user_sql['username']."");

        
    
    }else {
        array_push($errors, "username and email are required");
    }
    

}
?>