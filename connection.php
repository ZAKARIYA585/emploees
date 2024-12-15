<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "employees";

    $conn = mysqli_connect($server,$username, $password, $database);

    if(!$conn){
        // echo "Connection Successful";
        die ("not conect" . mysqli_connect_error());
    }
    else{
        
    }
?>