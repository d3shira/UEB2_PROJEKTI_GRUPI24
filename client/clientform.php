<?php require_once "../database.php";?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="admin/register-staff.css">
	<title>Insert Client Profile</title>
</head>
<body>
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
$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
$weight = mysqli_real_escape_string($conn, $_POST['weight']);
$height = mysqli_real_escape_string($conn, $_POST['height']);

// Prepare the SQL statement
$sql = "INSERT INTO tbl_client_profiles (birthday, weight, height) VALUES ('$birthday', $weight, $height)";

// Execute the SQL statement
if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>


