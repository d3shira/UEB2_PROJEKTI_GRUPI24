<?php require_once "../database.php"; 

// Initialize the session
session_start(); 

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
} 

// 1. Get the ID of Selected Staff
$id = $_GET['user_id'];

// 2. Create SQL Query to Get the Details
$sql = "SELECT u.user_id, u.user_type, u.username, u.email, 
            s.first_name, s.last_name, s.profession
        FROM tbl_users u 
        INNER JOIN tbl_staff_profiles s ON u.user_id = s.user_id
        WHERE u.user_id = $id";

// Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query is executed or not
if ($res) {
    // Check whether the data is available or not
    $count = mysqli_num_rows($res);
    // Check whether we have admin data or not
    if ($count == 1) {
        // Get the Details
        $row = mysqli_fetch_assoc($res);
        $user_id = $row["user_id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $user_type = $row["user_type"];
        $username = $row["username"];
        $email = $row["email"];
        $profession = $row["profession"];
    } else {
        //Redirect to Manage Admin Page
        header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
        exit();
    }
} else {
    //Redirect to Manage Admin Page
    header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
    exit();
}

if (isset($_POST['submit'])) {
    // Get all the values from form to update
    $id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];

    // Create a SQL Query to Update Admin
    $sql = "UPDATE tbl_users u
            INNER JOIN tbl_staff_profiles s ON u.user_id = s.user_id
            SET u.first_name = '$first_name',
                u.last_name = '$last_name',
                u.username = '$username',
                u.email = '$email',
                s.profession = '$profession'
            WHERE u.user_id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res==true) {
        // Query executed successfully
        $_SESSION['update'] = "<div class='success'>Staff Updated Successfully</div>";
        echo "<script>Swal.fire('Information saved', '', 'success');</script>";
        header("location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php");
        exit();
    } else {
        // Failed to update admin
        $_SESSION['update'] = "<div class='error'>Failed to Update Staff</div>";
        header("location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php");
        exit();
    }
    
}

?>
<?php 
@include 'staff-navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <title>Document</title>

    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../navbar.css">
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="../admin/navbar-admin.css">
    <link rel="stylesheet" href="../admin/manage-staff.css">
    <link rel="stylesheet" href="../admin/register-staff.css">
    <link rel="stylesheet" href="test.css">

    <!--<script src="home.js"></script>--> 
    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<header style="text-decoration:none;">
    <a href="staff_dashboard.php" class="logo"><i class="fas fa-utensils"></i>FitYou - Staff Dashboard</a>
    <nav class="navbar">
        <div class="dropdown">
            <a class="dropbtn">Staff</a>
            <div class="dropdown-content">
                <a href="view-client.php">Clients</a>
                <a href="staff-manage-diets.php">Diets</a>
                <a href="staff-manage-orders.php">Orders</a>
                <a href="staff-manage-questions.php">Questions</a>
            </div>
        </div>
        <a class="" href="home-staff.php">Home</a>
        <a class="" href="aboutus-staff.php">About Us</a>
        <a class="" href="staff-manage-diet">Diets</a>
        <a class="" href="#">Review</a>
        <!-- <a class="" href="order.php">Order</a> -->
        <a class="" href="../faqs.php">FAQs</a> 
    </nav>
    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <a href="staff_dashboard.php" class="fa-solid fa-user"></a>
    </div>
</header>
<br><br><br>
<div class="wrapper">
    <div class="form-group">
    <h3 style="text-align: left; margin:45px; font-size: 25px; color:#192a56;">Edit Your Profile</h3>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td><label>First Name: </label></td>
                    <td>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Last Name: </label></td>
                    <td>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Username: </label></td>
                    <td>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>E-mail: </label></td>
                    <td>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td><label>Profession: </label></td>
                    <td>
                        <input type="text" name="profession" class="form-control" value="<?php echo $profession; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Save Changes" class="update-button">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

</body>
</html>