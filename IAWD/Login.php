<?php
session_start();
include 'db_conn.php';

$error_message = "";




$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    
    $sql = "SELECT * FROM signup WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $user_name;
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid Username or Password!";
        }
    } else {
        $error_message = "Invalid Username or Password!";
    }

    
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login</h1>

    <?php if ($error_message): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="Login.php" method="POST">
        <label for="user_name">Username:</label>
        <input type="text" id="user_name" name="user_name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <footer>
        <p>&copy; 2024 Wildlife in Sri Lanka</p>
    </footer>
</body>
</html>
