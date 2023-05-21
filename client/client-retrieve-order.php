<?php
session_start();
require_once('../database.php');


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    exit;
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($orders);
} else {

    echo json_encode([]);
}


mysqli_close($conn);
?>