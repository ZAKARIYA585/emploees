<?php
    include 'connection.php'; 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM employee WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            echo "Employee deleted successfully.";
            header("Location: display.php"); 
            exit;
        } 
        else {
            echo "Error deleting employee: " . mysqli_error($conn);
        }
    } 
    else {
        echo "Invalid request. No ID provided.";
    }
?>
