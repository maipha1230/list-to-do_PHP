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
        <title>create new password</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="header-list">
            <h2>create new password</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "edit-form"  method="post" >  
                <div class="input-todo">
                    <label for="pass1">password: </label>
                    <input type="password" name = "pass1">
                    <label for="pass2">confirm-password: </label>
                    <input type="password" name = "pass2">
                    <button type="submit" name = "save-pass" class = "btn btn-success">Save</button>
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

        if (isset($_POST['save-pass'])){
            $pass1 = $_REQUEST['pass1'];
            $pass2 = $_REQUEST['pass2'];

            if(empty($pass1)){
                array_push($errors, "password is required");
            }

            if(empty($pass2)){
                array_push($errors, "password is required");
            }


            if (count($errors) == 0){
                if($pass1 == $pass2){
                    $pass = md5($pass1);

                    $sql_update = "UPDATE users SET password = '$pass' WHERE username = '$username'";
                    mysqli_query($conn, $sql_update);
                    header("location:login.php");
                }

            }
        }
?>