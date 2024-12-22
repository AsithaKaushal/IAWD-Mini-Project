<?php

include 'db_conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $expericence = $_POST['expericence'];

    
    $query = "INSERT INTO volunteer (name,age,gender,location,expericence) VALUES('$name','$age','$gender','$location','$expericence')";
    
    if ($conn->query($query) === TRUE) {
        echo 'connection scucess';
        
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

   
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration</title>
    <link rel="stylesheet" href="styles.css">
   
</head>
<body>
    <?php include 'navbar.php'; ?>

        <h1>Volunteer Registration</h1>
        <form id="volunteerForm" action="volunteer.php" method="POST" onsubmit="return validateVolunteerForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male" required> Male
            <input type="radio" id="female" name="gender" value="female" required> Female

            <label for="location">Preferred Location:</label>
            <select id="location" name="location" required>
                <option value="">Select</option>
                <option value="yala">Yala National Park</option>
                <option value="wilpattu">Wilpattu National Park</option>
                <option value="udawalawe">Udawalawe National Park</option>
            </select>

            <label for="experience">Experience (if any):</label>
            <textarea id="experience" name="experience"></textarea>

            <label for="terms">
                <input type="checkbox" id="terms" name="terms" required> I agree to the terms and conditions
            </label>

            <button type="submit">Submit</button>
        </form>

    <footer>
        <p>&copy; 2024 Wildlife in Sri Lanka</p>
    </footer>
</body>
</html>
