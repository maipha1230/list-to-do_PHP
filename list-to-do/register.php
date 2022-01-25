<?php include('server.php');
    session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form class = "form-rl" action="register_db.php" method = "post">
        <?php include('errors.php'); ?>
        
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
            <label for="email">E-mail</label>
            <input type="email" name = "email">
        </div>
        <div class="input-group">
            <label for="password_1">Password</label>
            <input type="password" name = "password_1">
        </div>
        <div class="input-group">
            <label for="password_2">Confirm Password</label>
            <input type="password" name = "password_2">
        </div>
        <div class="input-group">
            <button type="submit" name = "reg_user" class = "btn btn-info">Register</button>
        </div>
        <p>Already a member ? <a href="login.php">Sign in</a></p> 
    </form>
</body>
</html>