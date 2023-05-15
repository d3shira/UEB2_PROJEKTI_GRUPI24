
<?php session_start();
require_once('../database.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Welcome Client!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../admin/register-staff.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>

<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site!</h1>
<?php require 'client-info-logic.php'?>
<div class="row">
<div class="col-md-6">
	<div class="wrapper">
<?php
  echo '<h2>Add Client Information</h2>';
  echo '<form method="post">';
  echo '<div class="form-group">';
  echo '<label>Birthday: </label>';
  echo '<input type="date" name="birthday" class="form-control" value="'.$client_profile['birthday'].'" required>';
  echo '</div>';
  echo '<div class="form-group">';
  echo '<label>Weight (kg): </label>';
  echo '<input type="decimal" name="weight" class="form-control" value="'.$client_profile['weight'].'" required>';
  echo '</div>';
  echo '<div class="form-group">';
  echo '<label>Height (cm): </label>';
  echo '<input type="number" name="height" class="form-control" value="'.$client_profile['height'].'" required>';
  echo '</div>';
  echo '<div class="form-group">';
  echo '<input type="submit" value="Save" class="btn btn-primary">';
  echo '</div>';
  echo '</form>';
  echo '</div>';?>
		
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
      </tbody>
  </table>
      </div>
</div>
<br><br>
      <p>
        <a href="../reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="../logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="../order.php" class="btn btn-primary" style="margin-left:15px;">Order Now</a>
    </p>
      
   
    <!--AJAX -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to retrieve orders via Ajax
    function getOrders() {
      $.ajax({
        url: 'client-retrieve-orders.php',
        method: 'GET',
        success: function(response) {
          // Handle the response from the server
          $('#orders-container tbody').html(response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }

    // Call the getOrders function initially to load orders
    getOrders();

    // Set an interval to periodically update the orders
    setInterval(getOrders, 5000); // Update every 5 seconds
  });
</script>
</body>
</html>