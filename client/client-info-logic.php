
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


// Retrieve the client's details
//$sql = "SELECT  first_name, last_name FROM tbl_client_profiles WHERE user_id = '$user_id'";
//$result1 = mysqli_query($conn, $sql);
//$client_profile= mysqli_fetch_assoc($result1);


// Retrieve the client's orders
//$sql = "SELECT * FROM tbl_orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
//$result = mysqli_query($conn, $sql);
//$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);



// Handle form submission for updating the client profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $birthday = $_POST['birthday'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $formatted_birthday = date('Y-m-d', strtotime($birthday));
    echo '<div class="wrapper">';
    echo '<h2>Client Profile</h2>';
    
   
    echo '<p>Birthday: '.$birthday.'</p>';
    echo '<p>Weight (kg): '.$weight.'</p>';
    echo '<p>Height (cm): '.$height.'</p>';
    echo '<button class="btn btn-primary" onclick="window.location.href=\'admin/update_client.php\'">Edit</button>';
    echo '</div>';

    $sql = "UPDATE tbl_client_profiles SET birthday = '$formatted_birthday', weight = '$weight', height = '$height' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        $client_profile["birthday"] = $formatted_birthday;
        $client_profile["weight"] = $weight;
        $client_profile["height"] = $height;
        ?>
        <script>Swal.fire(
            'Information saved',
            '',
            'success'
        )</script><?php
    }
}



// Close the database connection
mysqli_close($conn);
?>