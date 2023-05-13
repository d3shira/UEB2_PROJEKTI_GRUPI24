<?php require_once "database.php";



// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

/*require_once('database.php');*/

$user_id = $_SESSION['user_id'];

// Create MySQLi object
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve client profile information
$client_profile = array();
$stmt = $mysqli->prepare('SELECT * FROM tbl_client_profiles WHERE user_id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $client_profile = $result->fetch_assoc();
}

// Get the values from the form submission
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$weight = mysqli_real_escape_string($conn, $_POST['weight']);
$height = mysqli_real_escape_string($conn, $_POST['height']);

// Prepare the SQL statement
$sql = "INSERT INTO tbl_client_profiles (birthday, weight, height) VALUES ('$birthday', $weight, $height)";
// Retrieve client's orders
$orders = array();
$stmt = $mysqli->prepare('SELECT * FROM tbl_orders WHERE user_id = ? ORDER BY order_date DESC');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Client!!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/register-staff.css">
	<title>Insert Client Profile</title>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site, you are our newest client!!</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

 

<h1>Welcome, <?php echo $client_profile['first_name'] . ' ' . $client_profile['last_name']; ?></h1>


	<div class="wrapper">
		<h2>Insert Client Profile</h2>
		<form action="insert_profile.php" method="post">
			<div class="form-group">
				<label>Birthday: </label>
				<input type="date" name="birthday" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Weight (kg): </label>
				<input type="number" name="weight" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Height (cm): </label>
				<input type="number" name="height" class="form-control" required>
			</div>
			<div class="form-group">
				<input type="submit" value="Submit" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>

<?php 
// Get the database connection



// Get the values from the form submission
//$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
//$weight = mysqli_real_escape_string($conn, $_POST['weight']);
//$height = mysqli_real_escape_string($conn, $_POST['height']);

// Prepare the SQL statement
//$sql = "INSERT INTO tbl_client_profiles (birthday, weight, height) VALUES ('$birthday', $weight, $height)";

// Execute the SQL statement
/*if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}*/

// Close the database connection
//mysqli_close($conn);
//?>


