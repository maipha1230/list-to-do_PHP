<?php 
    include('server.php');
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="head_listtodo">
        <h1>List - to - Do</h1>
    </div>

    <div class="header">
        <h2>Login</h2>
    </div>
    
    <form class = "form-rl" action="login_db.php" method = "post">

        <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </h3>
            </div>
        <?php endif ?>

        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name = "username">
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name = "password">
        </div>
        <div class="input-group">
            <button type="submit" name = "login_user" class = "btn btn-info ">Login</button>
        </div>
        <p>Don't have an account ? <a href="register.php">Sign Up</a></p> 
        <p>Forgot password ? <a href="forgot-password-page.php">reset password</a></p> 
    </form>
</body>
</html>