<?php

    session_start();
    include ('server.php');
    $errors = array();

    if (isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password_1)) {
            array_push($errors, "password is required");
        }

        if ($password_1 != $password_2){
            array_push($errors, "The two password do not match");
        }
        
        $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);        

        if ($result) { // if user exists
            if ($result['username'] === $username) {
                array_push($errors, "Username already exists");
            }
            if ($result['email'] === $email) {
                array_push($errors, "Email already exists");
            }
        }

        if (count($errors) == 0){
            $password = md5($password_1);

            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')" ;
            mysqli_query($conn, $sql);

            
            $sql_user_id = "SELECT * FROM users WHERE username = '$username'";
            $sql_result = mysqli_query($conn, $sql_user_id);
            $row = mysqli_fetch_array($sql_result);

            if (mysqli_num_rows($sql_result) == 1){
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('Location: index.php');
            }
            
        } else {
            array_push($errors, "username or Email already exists");
            $_SESSION['error'] = 'username or Email already exists';
            header("location:register.php");
        }
    }

?>