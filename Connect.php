<?php
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "buisness";
    $conn = "";

    try{
        $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    }catch(mysqli_sql_exception){
        echo "<script type='text/javascript'>alert('Could not connect to database');</script>";
    }

?>