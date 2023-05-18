<?php
// Include the database configuration file
require_once('../database.php');


// Start the session



// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='client') {
    header("location: ../login.php");
    exit;
}

$user_id=$_SESSION["user_id"];


// Retrieve the client profile information
$sql = "SELECT * FROM tbl_client_profiles WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$client_profile = mysqli_fetch_assoc($result);
 //Check whether the query is executed or not
 if($result==true)
 {
     // Check whether the data is available or not
     $count = mysqli_num_rows($result);
     //Check whether we have admin data or not
     if($count==1)
     {
         // Get the Details
         //echo "Staff Available";
       //  $row=mysqli_fetch_assoc($result);

         $first_name = $client_profile["first_name"];
         $last_name = $client_profile["last_name"];
     }
    
    }
if (!empty($client_profile['birthday']) &&!empty($client_profile['weight'] && !empty($client_profile['height'])) ) {
    // Display a success message instead of the form
    echo '<div class="wrapper">';
    echo '<h2>Client Information Saved</h2>';
    echo '<p>First Name: '.$client_profile["first_name"].'</p>';
    echo '<p>Last Name: '.$client_profile["last_name"].'</p>';
    echo '<p>Birthday: '.$client_profile["birthday"].'</p>';
    echo '<p>Weight (kg): '.$client_profile["weight"].'</p>';
    echo '<p>Height (cm): '.$client_profile["height"].'</p>';
    echo '<p>Thank you for providing your information.</p>';
    echo '</div>';
} else{
    //Display the form for adding client information
    echo '<div class="wrapper">';
    echo '<h2>Add Client Information</h2>';
    echo '<form method="post">';
    echo '<div class="form-group">';
    echo '<label>Birthday: </label>';
    echo '<input type="date" name="birthday" class="form-control" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Weight (kg): </label>';
    echo '<input type="decimal" name="weight" class="form-control" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Height (cm): </label>';
    echo '<input type="number" name="height" class="form-control" required>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<input type="submit" value="Save" class="btn btn-primary">';
    echo '</div>';
    echo '</form>';
    echo '</div>';}



// Retrieve the client's orders
//$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
//$result = mysqli_query($conn, $sql);
//$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);


 //Check whether the query is executed or not
 
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
        $saved = true;
        ?>
        <script>Swal.fire(
            'Information saved',
            '',
            'success'
        )</script><?php
    }
    header("location:http://localhost/UEB2_PROJEKTI/client/client_dashboard.php");
}

 



// Close the database connection
mysqli_close($conn);
?>