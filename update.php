<?php
    include 'connection.php'; 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM employee WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $employee = mysqli_fetch_assoc($result);
        } 
        else {
            echo "Employee not found.";
            exit;
        }
    } 
    else {
        echo "Invalid request.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mno'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $hobbies = implode(", ", $_POST['hobby']);

        // Image handling
        if (!empty($_FILES["image"]["name"])) {
            $image_folder = "image/";
            $target_image = $image_folder . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_image);
        } else {
            $target_image = $employee['image']; 
        }

        $update_sql = "UPDATE employee SET fname='$first_name', lname='$last_name', email='$email', mno='$mobile_number', address='$address', gender='$gender', hobbies='$hobbies', image='$target_image' WHERE id=$id";

        if (mysqli_query($conn, $update_sql)) {
            echo "Employee updated successfully.";
            header("Location: display.php"); // Redirect to display page
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Employee</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h3>Update Employee</h3>
        <form method="POST" enctype="multipart/form-data">
            <label>First Name:</label>
            <input type="text" name="fname" value="<?php echo $employee['fname']; ?>" required><br>

            <label>Last Name:</label>
            <input type="text" name="lname" value="<?php echo $employee['lname']; ?>" required><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $employee['email']; ?>" required><br>

            <label>Mobile Number:</label>
            <input type="number" name="mno" value="<?php echo $employee['mno']; ?>" required><br>

            <label>Address:</label>
            <textarea name="address" rows="4" required><?php echo $employee['address']; ?></textarea><br>

            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" <?php if ($employee['gender'] == 'Male') echo 'checked'; ?>> Male
            <input type="radio" name="gender" value="Female" <?php if ($employee['gender'] == 'Female') echo 'checked'; ?>> Female<br>

            <label>Hobby:</label>
            <?php
            $hobby_array = explode(", ", $employee['hobbies']);
            ?>
            <input type="checkbox" name="hobby[]" value="Reading" <?php if (in_array('Reading', $hobby_array)) echo 'checked'; ?>> Reading
            <input type="checkbox" name="hobby[]" value="Cooking" <?php if (in_array('Cooking', $hobby_array)) echo 'checked'; ?>> Cooking
            <input type="checkbox" name="hobby[]" value="Dancing" <?php if (in_array('Dancing', $hobby_array)) echo 'checked'; ?>> Dancing
            <input type="checkbox" name="hobby[]" value="Sports" <?php if (in_array('Sports', $hobby_array)) echo 'checked'; ?>> Sports
            <input type="checkbox" name="hobby[]" value="Music" <?php if (in_array('Music', $hobby_array)) echo 'checked'; ?>> Music<br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*"><br>
            <img src="<?php echo $employee['image']; ?>" alt="Current Image" width="100"><br><br>

            <button type="submit">Update</button>
        </form>
    </body>
</html>
