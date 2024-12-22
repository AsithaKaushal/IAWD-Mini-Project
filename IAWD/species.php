<?php
include 'db_conn.php';  


$sql = "SELECT * FROM addspecies";
$result = $conn->query($sql);

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wildlife Species</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>

   
    <?php include 'navbar.php'; ?>

    <h1>Wildlife Species in Sri Lanka</h1>
    <table id="specialTable" border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <th>Species Name</th>
                <th>Habitat</th>
                <th>Conservation Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["sname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["habitat"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo "</tr>";
                }
            } else {
               
                echo "<tr><td colspan='3'>No species found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <footer>
        <p>&copy; 2024 Wildlife in Sri Lanka</p>
    </footer>
</body>
</html>


