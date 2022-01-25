<?php   include('server.php');
        include('errors.php');
        include('todo_db.php') ?>
<?php 
    //session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "you must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List-to-Do</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="head_listtodo">
        <h1>List - to - Do</h1>
    </div>
    <div class="header-list">
        <h2>To make you realize what you gonna do</h2>
    </div>

    <div class="content">

        <!-- notification message -->

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <a href="index.php?logout='1'" style = "color: red">Logout</a>
            
            <a class="btn btn-outline-success" href="history.php" style = "color: black; margin-left:10px; float:right;" >History <i class="fas fa-history"></i></a>
            <a class="btn btn-outline-warning" href="edit-proflie.php?user_id=<?php echo $user_id_query ; ?>" style = "color: black; margin-left:10px; float:right;" >Edit profile <i class="fas fa-edit"></i></a>
            <?php if ($_SESSION['username'] == 'admin') { ?>
                <a class="btn btn-outline-primary" href="admin.php" style = "color: black; margin-left:10px; float:right;" >Admin page <i class="fas fa-eye"></i></a>
            <?php } ?>
        <?php endif ?>

        <!-- list to do content -->
        <div class="container-1">
            <form class = "todo-form" action="todo_db.php" method="post">  
                <div class="input-todo">
                        <label for="todo">Task: </label>
                        <input type="text" name = "todo-text" placeholder = "Enter task to do"><br>
                        <label for="due">Due: </label>
                        <input type="datetime-local" id="due-time" name="due-time"><br>          
                        <select name = "priority" class="form-select" aria-label="Default select example">
                            <option disable selected value = "">Priority</option>
                            <option value="HIGH">HIGH</option>
                            <option value="LOW">LOW</option>
                        </select>                        
                        <button type="submit" name = "add-todo" class = "btn btn-primary" style = "margin:10px auto;">add task</button>
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

        <div class="container-2">
            <div class="item">
                <h2 style = "text-align:center">Task</h2>
                <form class="item-todo" action="todo_db.php" method="post">
                    <p style = "color: #ff7979; -webkit-text-stroke-width: 0.5px; -webkit-text-stroke-color: black;">Priority: HIGH</p>
                    <div class="wrapper-high">
                    
                    <?php 
                        while ($todo = mysqli_fetch_array($todos_high)) {?>
                    
                        <div class="task">
                            <p style = "font-size:24px"><?php echo $todo['task']; ?></p> 
                            <button style = "font-size:16px" type="submit" name = "finish-btn" class = "btn btn-success" value = "<?php echo $todo['id_todo']; ?>">Finish</button>
                            <button style = "font-size:16px" type="submit" name = "expire-btn" class = "btn btn-danger" value = "<?php echo $todo['id_todo']; ?>">Expired</button>
                            <a style = "font-size:16px;" type="submit" name = "edit-btn" class = "btn btn-warning" href="edit_task.php?update_id=<?php echo $todo['id_todo']; ?>&amp;oldtask=<?php echo $todo['task']; ?>" value = "<?php echo $todo['id_todo']; ?>">Edit</a>
                            <button style = "font-size:16px;" type="submit" name = "delete-btn" class = "btn" value = "<?php echo $todo['id_todo']; ?>"><i class = "fas fa-trash"  style = "color:red;"></i></button>
                            <p style = "font-size: 16px; padding-top:5px;">create: <?php echo $todo['create_date'];?></p>
                            <p style = "font-size: 16px;">due: <?php echo $todo['due_date'];?></p>
                        </div>
                    <?php } ?>  
                   </div>

                   <p style = "color: #6ab04c; -webkit-text-stroke-width: 0.5px; -webkit-text-stroke-color: black; ">Priority: LOW</p>
                   <div class="wrapper-low">
                    
                    <?php 
                        while ($todo = mysqli_fetch_array($todos_low)) {?>
                    
                        <div class="task">
                            <p style = "font-size:24px"><?php echo $todo['task']; ?></p> 
                            <button style = "font-size:16px" type="submit" name = "finish-btn" class = "btn btn-success" value = "<?php echo $todo['id_todo']; ?>">Finish</button>
                            <button style = "font-size:16px" type="submit" name = "expire-btn" class = "btn btn-danger" value = "<?php echo $todo['id_todo']; ?>">Expired</button>
                            <a style = "font-size:16px;" type="submit" name = "edit-btn" class = "btn btn-warning" href="edit_task.php?update_id=<?php echo $todo['id_todo']; ?>&amp;oldtask=<?php echo $todo['task']; ?>" value = "<?php echo $todo['id_todo']; ?>">Edit</a>
                            <button style = "font-size:16px;" type="submit" name = "delete-btn" class = "btn" value = "<?php echo $todo['id_todo']; ?>"><i class = "fas fa-trash"  style = "color:red;"></i></button>
                            <p style = "font-size: 16px; padding-top:5px;">create: <?php echo $todo['create_date'];?></p>
                            <p style = "font-size: 16px;">due: <?php echo $todo['due_date'];?></p>
                        </div>
                    <?php } ?>  
                   </div>                               
                </form>
            </div>
        </div>


        
        
    </div>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>