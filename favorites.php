<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "Replace.3";
$database = "ueb2";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_favorites";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Favorite Diets</title>
</head>
<body>
    <h1>My Favorite Diets</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dietName = $row['diet_name'];
            $dietImage = $row['diet_image'];

            echo "<h2>$dietName</h2>";
            echo "<img src='path/to/images/$dietImage' alt='$dietName' width='300'><br><br>";
        }
    } else {
        echo "No diets found.";
    }

    $conn->close();
    ?>
</body>
</html>
