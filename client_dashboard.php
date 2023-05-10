<?php require_once("database.php");

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

require_once('database.php');

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
  <p>Birthday: <?php echo $client_profile['birthday']; ?></p>
  <p>Weight: <?php echo $client_profile['weight']; ?> kg</p>
  <p>Height: <?php echo $client_profile['height']; ?> cm</p>
  <p>BMI: <?php echo $client_profile['bmi']; ?></p>
  
  <h2>Your Orders</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Date</th>
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
</body>
</html>