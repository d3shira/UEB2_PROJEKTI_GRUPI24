<?php 
//AJAX
// PHP code in retrieve_orders.php
// Connect to the database
require_once("../database.php");

// Retrieve the client's orders
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Output the orders as HTML
foreach ($orders as $order) {
  echo "<p>".$order['order_title']."</p>";
  echo"<tr>";
  echo "<td>".$order['order_id']."</td>";
  echo "<td>".$order['diet_id']. "</td>";
  echo "<td>".$order['address']. "</td>";
  echo "<td>".$order['contact']. "</td>";
  echo "<td>".$order['quantity']."</td>";
  echo "<td>".$order['total_price']."</td>";
  echo "<td>".$order['order_date']."</td>";
  echo "<td>".$order['status']."</td>";
echo"</tr>";
}

// Close the database connection
mysqli_close($conn);
?>
