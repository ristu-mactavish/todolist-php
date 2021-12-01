<?php include 'db.php'?>


<?php 

    if ( isset($_POST['add_task']) ) {
        $name_task = mysqli_real_escape_string($connection,$_POST['name_task']);
        $query     = mysqli_query($connection,"INSERT INTO task (name_task,status_task,date_task)
                                VALUES ('$name_task','pending',now()) ");
        header("Location: index.php");
    }

    
// tombol done pada pending list
    if ( isset($_GET['edit']) ) {
        $task_id    = $_GET['edit'];
        $query      = mysqli_query($connection,"UPDATE task SET status_task='done' WHERE id_task='$task_id' ");
    }
// tombol delete pada pending list
    if ( isset($_GET['delete']) ) {
        $task_id    = $_GET['delete'];
        $query      = mysqli_query($connection,"DELETE FROM task WHERE id_task='$task_id' ");
    }

    if ( isset($_GET['alldelete']) ) {
        $status_task    = $_GET['alldelete'];
        $query          = mysqli_query($connection, "DELETE FROM task WHERE status_task='$status_task' ");
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TODOLIST-APP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    </head>
    <body>
    <!-- Start Section -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">TODOLIST APP</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h3>ADD TASK</h3>
                            <form method="post">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="name_task" placeholder="input your task" autocomplete="off">
                                </div>
                                <div class="d-grid gap-2 mb-2">
                                    <button type="submit" name="add_task" class="btn btn-success me-md-2">Add Task</button>
                                </div>
                            </form>
                            <h3>Task Pending</h3>
                            <ul class="list-group">
                                <?php 

                                    $query = mysqli_query($connection,"SELECT * FROM task WHERE status_task='pending' ");
                                    while ($row = mysqli_fetch_array($query)){
                                        $name_task  = $row['name_task'];
                                        $id_task    = $row['id_task'];
                                    
                                ?>
                                <li class="list-group-item mb-3 border-1 border-info rounded">
                                    <?php echo $name_task;?>
                                    <div class="float-end">
                                        <span class="badge bg-primary">Pending</span>
                                        <a href="index.php?edit=<?php echo $id_task; ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as done">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="index.php?delete=<?php echo $id_task; ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete list">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </li>
                                <?php 
                            }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <div class="row">
                                <h3>FINISH TASK</h3>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger mb-3">
                                    <a class="text-decoration-none text-light" href="index.php?alldelete=<?= $status_task='done' ; ?>">Delete All Finished Task</a>
                                </button>
                            </div>
                            
                            <ul class="list-group">
                                <?php
                                    $query = mysqli_query($connection,"SELECT * FROM task WHERE status_task='done' ");
                                    while ($row = mysqli_fetch_array($query)) {
                                ?>
                                <li class="list-group-item border-1 border-primary mb-2 rounded">
                                    <?php echo $row['name_task']; ?>
                                    <div class="float-end">
                                        <span class="badge bg-primary">
                                            <?php echo $row['status_task']; ?>
                                        </span>
                                    </div>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javasript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </body>
</html>