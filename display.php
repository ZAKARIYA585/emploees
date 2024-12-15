<?php
    include 'connection.php'; 

    $sql = "SELECT * FROM employee";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Records</title>
        <link rel="stylesheet" href="style.css">
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            .button-container {
                margin-bottom: 20px;
            }
            .add-button {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
            }
            .add-button:hover {
                background-color: #45a049;
            }
            .edit-button {
                padding: 5px 10px;
                background-color: #008CBA;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
            }
            .edit-button:hover {
                background-color: #007bb5;
            }
            .delete-button {
                padding: 5px 10px;
                background-color: #f44336;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
            }
            .delete-button:hover {
                background-color: #da190b;
            }
        </style>
    </head>
    <body>
        <h3>Employee Records</h3>

        <div class="button-container">
            <a href="insert.php" class="add-button">Add Employee</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                    <th>Image</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['fname'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['mno'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['gender'] . "</td>";
                            echo "<td>" . $row['hobbies'] . "</td>";
                            echo "<td><img src='" . $row['image'] . "' alt='Employee Image' width='50' height='50'></td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . $row['id'] . "' class='edit-button'>Edit</a> ";
                            echo "<a href='delete.php?id=" . $row['id'] . "' class='delete-button'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } 
                    else {
                        echo "<tr><td colspan='10'>No records found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>
