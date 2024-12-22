<?php
include 'db_conn.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $sname = isset($_POST['sname']) ? $_POST['sname'] : '';  
    $habitat = isset($_POST['habitat']) ? $_POST['habitat'] : '';                
    $status = isset($_POST['status']) ? $_POST['status'] : '';                   

    
    $query = "INSERT INTO addspecies(sname,habitat,status) VALUES('$sname','$habitat','$status')";
   
    if ($conn->query($query) === TRUE) {
        echo "connection sucess";
        
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
    <title>Add New Wildlife Species</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <h1>Add New Wildlife Species</h1>

    <form action="add_species.php" method="POST">
        <label for="speciesname">Species Name:</label>
        <input type="text" id="sname" name="sname" required><br><br>

        <label for="habitat">Habitat:</label>
        <input type="text" id="habitat" name="habitat" required><br><br>

        <label for="status">Conservation Status:</label>
        <select id="status" name="status">
            <option value="Endangered">Endangered</option>
            <option value="Vulnerable">Vulnerable</option>
            <option value="Least Concern">Least Concern</option>
            <option value="Critically Endangered">Critically Endangered</option>
        </select><br><br>

        <button type="submit">Add Species</button>
    </form>
    <footer>
        <p>&copy; 2024 Wildlife in Sri Lanka</p>
    </footer>
</body>
</html>
