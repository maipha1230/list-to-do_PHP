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
        <title>send OTP</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="header-list">
            <h2>send OTP</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "edit-form"  method="post" >  
                <div class="input-todo" style = "padding-left:50px;">
                    <label for="otp">OTP: </label>
                    <input type="text" name = "otp-text">
                    <button type="submit" name = "send-otp" class = "btn btn-primary">Send</button>
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

        if(isset($_REQUEST['username'])){
            $username = $_REQUEST['username'];

            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
        }

        if (isset($_POST['send-otp'])){
            $otp = $_REQUEST['otp-text'];

            if(empty($otp)){
                array_push($errors, "otp is required");
                header('location:login.php');
            }

            if (count($errors) == 0){
                if($otp == $row['password']){
                    header("location:newpass.php?username=".$row['username']);
                }else {
                header('location:login.php');
                }
            } 
        }
?>