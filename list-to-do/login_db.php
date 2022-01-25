<?php

    session_start();
    include ('server.php');

    $errors = array();

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)){
            array_push($errors,'username is required');
        }

        if (empty($password)){
            array_push($errors,'password is required');
        }

        if (count($errors) == 0){
            $password = md5($password);

            if ($username == 'admin'){
                $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            } else {
                $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            }
            
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            // $query_user_id = "SELECT user_id FROM users WHERE username = '$username'";
            // $user_id = mysqli_query($conn,$query_user_id);
            

            if ($username == 'admin' && $row['id_admin'] == 1){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id_admin'];
                header("Location:admin.php");
            }else {
                if (mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['success'] = 'you are now logged in';
                header("location:index.php");

                } else {
                array_push($errors, "wrong username or password combination");
                $_SESSION['error'] = 'wrong username or password try again!';
                header("location:login.php");
                }
            }
            
        } else {
            array_push($errors, "Username & Password is required");
            $_SESSION['error'] = "Username & Password is required";
            header("location: login.php");
        }
    }


?>