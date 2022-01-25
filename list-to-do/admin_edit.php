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

        if(empty($email)){
            array_push($errors, "please enter your E-mail");
        }

        if (count($errors) == 0){
            $sql = "UPDATE users SET email = '$email' WHERE user_id = $user_id";
            mysqli_query($conn,$sql);
            header('location:admin.php');
        }
    } else {
        array_push($errors, "E-mail is required");
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
                    <button type="submit" name = "save-edit" class = "btn btn-success">Save change</button>
                    <a type="submit" name = "cancel-btn" class = "btn btn-danger" href = "admin.php" style ="margin:10px auto;">Cancel</a>
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