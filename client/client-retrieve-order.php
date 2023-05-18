<?php

require_once('../database.php');

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    exit;
}

$user_id = $_SESSION["user_id"];

// Retrieve the client's orders
$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);

// Check if any orders are found
if (mysqli_num_rows($result) > 0) {
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Send the orders data as JSON response
    echo json_encode($orders);
} else {
    // Send an empty response if no orders are found
    echo json_encode([]);
}

// Close the database connection
mysqli_close($conn);
?>