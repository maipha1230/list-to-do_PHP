<?php
    include('server.php');
    include('errors.php');

?>
<?php 

    $info_admin_sql = "SELECT * FROM admin WHERE username = 'admin' AND id_admin = 1";
    $info_admin = mysqli_fetch_array(mysqli_query($conn, $info_admin_sql));
    $info = "SELECT * FROM users ";
    if (!empty($info)){
        $info_query = mysqli_query($conn, $info);
    }
    

    if (isset($_POST['admin-delete-btn'])){
        $del_id = mysqli_real_escape_string($conn,$_POST['admin-delete-btn']);
        mysqli_query($conn, "DELETE FROM todo  WHERE user_id = $del_id");
        $sql_user_del = "DELETE FROM users WHERE user_id = $del_id";
        mysqli_query($conn,$sql_user_del);
        header('Location: admin.php');
    }

    if (isset($_REQUEST['todo-page'])){
        $_SESSION['user_id'] = $info_admin['id_admin'];
        $_SESSION['username'] = $info_admin['username'];
        header('location:index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

        
        <div class="header-list">
            <h2>Admin Page</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "admin-form"  method="post">
                <button type="submit"class="btn btn-outline-primary" name = "todo-page" style = "color: black; margin-left:10px; float:right ;" >List-To-Do<i class="	fas fa-clipboard-list"></i></button>
                <a href="index.php?logout='1'" style = "color: red">Logout</a> 
                    
                <table class = "table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope = "col">Username</th>
                            <th scope = "col">E-mail</th>
                            <th colspan = "2" scope = "col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = mysqli_fetch_array($info_query)) {?>
                    <tr>
                        <td><?php echo $row['username'] ;?></td>
                        <td><?php echo $row['email'] ;?></td>
                        <td><a class="btn btn-outline-warning" href="admin_edit.php?user_id=<?php echo $row['user_id'] ; ?>" ><i class="fas fa-edit"></i></a></td>
                        <td><button style = "font-size:16px;" type="submit" name = "admin-delete-btn" class = "btn" value = "<?php echo $row['user_id']; ?>"><i class = "fas fa-trash"  style = "color:red;"></i></button></td>
                    </tr>
                    <?php } ?>
                    </tbody>

                </table>
                    
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
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>