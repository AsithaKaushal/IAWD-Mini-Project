<?php

include 'db_conn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

   
    $query = "INSERT INTO contact (name,email,message) VALUES('$name','$email','$message')";
    
    if ($conn->query($query) === TRUE) {
        
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
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/valid.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>
    
        <h1>Contact Us</h1>
        <form id="contactForm" action="contact.php" method="POST" onsubmit="return validateContactForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Submit</button>
        </form>
  

    <footer>
        <p>&copy; 2024 Wildlife in Sri Lanka</p>
    </footer>
</body>
</html>

