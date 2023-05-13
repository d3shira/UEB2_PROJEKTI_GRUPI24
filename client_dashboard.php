<?php
// Include the database configuration file
require_once('database.php');



// Start the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: clientlogin.php");
    exit;
}

$user_id=$_SESSION["user_id"];


// Retrieve the client profile information
$sql = "SELECT * FROM tbl_client_profiles WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$client_profile = mysqli_fetch_assoc($result);


// Retrieve the client's orders
$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission for updating the client profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $birthday = $_POST['birthday'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $formatted_birthday = date('Y-m-d', strtotime($birthday));

    $sql = "UPDATE tbl_client_profiles SET birthday = '$formatted_birthday', weight = '$weight', height = '$height' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        $client_profile["birthday"] = $formatted_birthday;
        $client_profile["weight"] = $weight;
        $client_profile["height"] = $height;
    }
}



// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Welcome Client!!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/register-staff.css">
	
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site!</h1>
<div class="row">
<div class="col-md-6">
	<div class="wrapper">
		<h2>Insert Client Profile</h2>
		<form  method="post">
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
				<input type="submit" value="Save" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>

  <div class="col-md-6">
  <h2>Your Orders</h2>
  <table border="1" class="mx-auto">
  <table class="table table-striped">
  <thead>
      <tr>
        <th>Order ID</th>
        <th>Diet ID</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order): ?>
      <tr>
        <td><?php echo $order['order_id']; ?></td>
        <td><?php echo $order['diet_id']; ?></td>
        <td><?php echo $order['address']; ?></td>
        <td><?php echo $order['contact']; ?></td>
        <td><?php echo $order['quantity']; ?></td>
        <td>$<?php echo $order['total_price']; ?></td>
        <td><?php echo $order['order_date']; ?></td>
        <td><?php echo $order['status']; ?></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
      </div>
</div>
<br><br>
      <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
      </body>
</html>