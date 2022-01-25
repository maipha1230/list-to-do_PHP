<?php   include('server.php');
        include('todo_db.php');
        include('errors.php');
        ?>

<?php 

        $errors = array();
        if(isset($_REQUEST['update_id'])){
            $id_edit = $_REQUEST['update_id'];
            $oldtask = $_REQUEST['oldtask'];
        }

        if(isset($_POST['save-edit'])){
            $edit_task  = $_REQUEST['todo-text-edit'];
            $edit_due = $_REQUEST['due-time-edit'];
            

            if (empty($edit_task)){
                array_push($errors,"task is required");
            }
            if(empty($edit_due)){
                array_push($errors,"due is required");
            }


            if(count($errors) == 0){
                echo $edit_task . ' ' . $edit_due . ' ' . $id_edit;
                $sql_edit = "UPDATE todo SET task = '$edit_task', due_date = '$edit_due'  WHERE id_todo = $id_edit";
                echo $sql_edit;
                mysqli_query($conn,$sql_edit);
                header('Location:index.php');
            }
            
        } else {
            array_push($errors,"task and due are required");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit-task</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

        <div class="header-list">
            <h2>Edit task</h2>
        </div>
        <div class="content">
            <div class="container-1">
            <form class = "edit-form"  method="post">  
                <div class="input-todo">
                    <label for="todo">Task: </label>
                    <input type="text" name = "todo-text-edit" value = "<?php echo $oldtask ;?>">
                    <label for="due">Due: </label>
                    <input type="datetime-local" id="due-time" name="due-time-edit">
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