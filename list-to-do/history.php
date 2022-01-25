
<?php   include('server.php');
        include('todo_db.php');
        include('errors.php');
        ?>

<?php 
    $sql_finish_history = "SELECT todo.* FROM todo INNER JOIN todo_finish ON todo.id_todo = todo_finish.id_todo WHERE user_id = $user_id_query";
    $finish_history = mysqli_query($conn, $sql_finish_history);

    $sql_expire_history = "SELECT todo.* FROM todo INNER JOIN todo_expire ON todo.id_todo = todo_expire.id_todo WHERE user_id = $user_id_query";
    $expire_history = mysqli_query($conn, $sql_expire_history);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

        <div class="header-list">
            <h2>History</h2>

        </div>
        

        <div class="content">
            <a class="btn btn-outline-success" href="index.php" style = "color: black; margin:0px 0 10px 10px; discplay:inline-block;" >Back <i class="fas fa-backspace"></i></a>
            
            <div class="wrapper-history">
                <div class="finish-history">

                <h2 style = "text-align:center; color:white;">FINISH</h2>
                    <?php while ($finish_show = mysqli_fetch_array($finish_history)) { ?>
                        <div class="task-history">
                            <p><?php echo  $finish_show['task'] ;?></p>
                            <p>create: <?php echo  $finish_show['create_date'] ;?></p>
                            <p>due: <?php echo  $finish_show['due_date'] ;?></p>
                        </div>                
                    <?php } ?>
                    
                </div>
                <div class="expire-history">

                <h2 style = "text-align:center; color:white;">EXPIRE</h2>
                    <?php while ($expire_show = mysqli_fetch_array($expire_history)) { ?>
                
                        <div class="task-history">
                            <p><?php echo  $expire_show['task'] ;?></p>
                            <p>create: <?php echo  $expire_show['create_date'] ;?></p>
                            <p>due: <?php echo  $expire_show['due_date'] ;?></p>
                        </div>     
                    <?php } ?>
                    
                </div>

            </div>
    
        </div>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        
</body>
</html>