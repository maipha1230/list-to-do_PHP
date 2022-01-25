<?php

    include('server.php');
    include('errors.php');

    $errors = array();

    if (isset($_REQUEST['user_id'])){
        $user_id = $_REQUEST['user_id'];
    }

    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $info = mysqli_fetch_array(mysqli_query($conn,$sql));

    if (isset($_POST['save-edit'])){

       $email = $_REQUEST['email-edit'];
       $pass1 = $_REQUEST['pass1'];
       $pass2 = $_REQUEST['pass2'];
       $password = $_REQUEST['password-confirm-edit'];

        if(empty($password)){
            array_push($errors, "please enter your password to confirm");
        }
       
        if (md5($password) != $info['password']){
            array_push($errors, "password are not match");
        }
        if (count($errors) == 0){
            if (!empty($email) && !empty($pass1)){
                if (empty($pass2)){
                    array_push($errors, "please enter confirm new-password");
                }
                if ($pass1 != $pass2){
                    array_push($errors, "both new passwords must match");
                }
                if(count($errors) == 0){
                    $pass1 = md5($pass1);
                    mysqli_query($conn, "UPDATE users SET email = '$email', password = '$pass1' WHERE user_id = '$user_id'");
                    header("location:index.php");
                }
        } else if (!empty($email) && empty($pass1)){
            if(count($errors) == 0){
                mysqli_query($conn, "UPDATE users SET email = '$email' WHERE user_id = '$user_id'");
                header("location:index.php");
            }
        } else if (empty($email) && !empty($pass1)){
            if (empty($pass2)){
                array_push($errors, "please enter confirm new-password");
            }
            if ($pass1 != $pass2){
                array_push($errors, "both new passwords must match");
            }
            if(count($errors) == 0){
                $pass1 = md5($pass1);
                mysqli_query($conn, "UPDATE users SET password = '$pass1' WHERE user_id = '$user_id'");
                header("location:index.php");
            }
        }
    }else {
        array_push($errors, "E-mail and password are required");
    }
}
      
     

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit proflie</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

        <div class="header-list">
            <h2>Edit Profile</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "edit-form"  method="post">  
                <div class="input-todo">
                    <label for="todo">Email: </label>
                    <input type="text" name = "email-edit" value = "<?php echo $info['email']; ?>">
                    <label for="due">New-Password: </label>
                    <input type="password" name = "pass1" value = "">
                    <label for="due">Confirm New-Password: </label>
                    <input type="password" name = "pass2" value = "">
                    <label for="due">Currently-Password: </label>
                    <input type="password" name = "password-confirm-edit" value = "">
                    <button type="submit" name = "save-edit" class = "btn btn-success">Save change</button>
                    <a type="submit" name = "cancel-btn" class = "btn btn-danger" href = "index.php" style ="margin:10px auto;">Cancel</a>
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