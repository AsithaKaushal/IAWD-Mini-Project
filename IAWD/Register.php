<?php
session_start();
include 'db_conn.php';


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($user_name) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $sql_check = "SELECT * FROM signup WHERE user_name = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, "s", $user_name);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result_check) > 0) {
            $error_message = "Username already exists!";
        } else {
            
            $sql = "INSERT INTO signup (user_name, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $user_name, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "registered successfully!";
                header("Location: Login.php?register_success=true");
                exit;
            } else {
                $error_message = "Error: Unable to register user.";
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Registration</h2>

        <?php if ($error_message) : ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message) : ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="user_name" class="form-label">Username</label>
                <input type="text" class="form-control" name="user_name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

</body>
</html>
