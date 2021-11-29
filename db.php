<?php 

    $localhost  = "localhost";
    $username   = "root";
    $password   = "";
    $database   = "dbtodolist";

    $connection = mysqli_connect($localhost,$username,$password,$database);

    if ($connection -> connect_error){
        die("Something Wrong ".$connection->connect_error);
    }
?>