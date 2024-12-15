<?php
    include 'connection.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $email = $_POST['email'];
        $mobile_number = $_POST['mno'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $hobbies = implode(", ", $_POST['hobby']); 
        
        $image_folder = "image/";
        $target_image = $image_folder . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_image);

        $sql = "INSERT INTO employee (fname, lname, email, mno, address, gender, hobbies, image )
                VALUES ('$first_name', '$last_name', '$email', '$mobile_number', '$address', '$gender', '$hobbies', '$target_image')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "New employee inserted successfully.";
            header("Location: display.php"); 
            exit(); 
        } else {
            echo "Data problem: " . mysqli_error($conn); 
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Employee Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Add New Employee</h3>
    <form method="POST" enctype="multipart/form-data">
        
        <label>First Name:</label>
        <input type="text" name="fname" id="fname" required><br>
            
        <label>Last Name:</label>
        <input type="text" name="lname" id="lname" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        
        <label>Mobile Number:</label>
        <select name="country_code" id="country_code" required>
            <option value="+91">+91 (India)</option>
            <option value="+1">+1 (USA)</option>
            <option value="+44">+44 (UK)</option>

        </select>
        <input type="number" name="mno" id="mno" required><br>
        
        <label>Address:</label>
        <textarea name="address" id="address" rows="4" required></textarea><br>
        
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female<br>
        
        <label>Hobby:</label>
        <input type="checkbox" name="hobby[]" value="Reading"> Reading
        <input type="checkbox" name="hobby[]" value="Cookibg"> Cooking
        <input type="checkbox" name="hobby[]" value="Dancing"> Dancing
        <input type="checkbox" name="hobby[]" value="Sports"> Sports
        <input type="checkbox" name="hobby[]" value="Music"> Music<br>
        
        <label>Image</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>