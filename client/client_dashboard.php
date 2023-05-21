
<?php @include 'client-navbar.php';

session_start();
require_once('../database.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Welcome Client!</title>
   <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="../admin/register-staff.css">
  <link rel = "stylesheet" href="../staff/staff.css">
  <link rel = "stylesheet" href="../admin/manage-staff.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<body>
<br><br><br><br><br>
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site!</h1>
<?php require 'client-info-logic2.php'?>


		
<div class="tbl-container">
  <div class="tbl-content">
    <br><br>
    <h2>Your Orders</h2>
    <table class="tbl-full">
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
      <tbody id="orders-container">
      </tbody>
    </table>
  </div>
</div>

<br><br>
      <p>
      <a href="client-menu.php" class="update-button" style="margin-left:15px;">Order Now</a>
        <a href="../reset-password.php" class="add-button">Reset Your Password</a>
        <a href="../logout.php" class="delete-button">Sign Out of Your Account</a>
    </p>
      
   
  <!--AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    function getOrders() {
      $.ajax({
        url: 'client-retrieve-order.php',
        method: 'GET',
        success: function(response) {
        
          var orders = JSON.parse(response);
          var tbody = $('#orders-container');
       

          if (orders.length > 0) {
            for (var i = 0; i < orders.length; i++) {
              var order = orders[i];
              var row = $('<tr>');
              row.append($('<td>').text(order.order_id));
              row.append($('<td>').text(order.diet_id));
              row.append($('<td>').text(order.address));
              row.append($('<td>').text(order.contact));
              row.append($('<td>').text(order.quantity));
              row.append($('<td>').text(order.total_price));
              row.append($('<td>').text(order.order_date));
              row.append($('<td>').text(order.status));
              tbody.append(row);
            }
          } else {
           
            var emptyRow = $('<tr>');
            emptyRow.append($('<td colspan="8">').text('No orders found'));
            tbody.html(emptyRow);
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }

    getOrders();

  });
</script>
</body>
</html>