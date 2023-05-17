<?php
// Include the database configuration file
require_once('../database.php');

// Start the session
session_start();

// Check if the user is logged in and is a client, if not then redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] !== 'client') {
    header("location: ../login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Retrieve the client profile information
$sql = "SELECT * FROM tbl_client_profiles WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$client_profile = mysqli_fetch_assoc($result);

// Check if the client profile information is already saved
if ($client_profile) {
    // Display the client profile information
    echo '<div class="wrapper">';
    echo '<h2>Client Profile</h2>';
    echo '<p>First Name: '.$client_profile["first_name"].'</p>';
    echo '<p>Last Name: '.$client_profile["last_name"].'</p>';
    echo '<p>Birthday: '.$client_profile["birthday"].'</p>';
    echo '<p>Weight (kg): '.$client_profile["weight"].'</p>';
    echo '<p>Height (cm): '.$client_profile["height"].'</p>';
    echo '<button class="btn btn-primary" onclick="window.location.href=\'admin/update_client.php\'">Edit</button>';
    echo '</div>';
} else {
    // Display the form for adding client information
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
    echo '</div>';
}

// Handle form submission for updating the client profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $birthday = $_POST['birthday'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $formatted_birthday = date('Y-m-d', strtotime($birthday));

    $sql = "INSERT INTO tbl_client_profiles (user_id, birthday, weight, height) VALUES ('$user_id', '$formatted_birthday', '$weight', '$height')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>Swal.fire("Information saved", "", "success");</script>';
    }
}

// Close the database connection
mysqli_close($conn);
