<?php require_once "../database.php"; 


session_start(); 


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true && ['user_type']!=='staff'){
    header("location: ../login.php");
    exit;
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

    <script src="../navbar.js"></script> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

</head>
<body>
    
<br><br><br>
<div class="wrapper">
    <div class="form-group">
    <h3 style="text-align: left; margin:45px; font-size: 25px; color:#192a56;">Edit Your Profile</h3>

    
<?php
require_once "../database.php";

$id = $_GET['user_id'];

$sql = "SELECT u.user_id, u.user_type, u.username, u.email, 
            s.first_name, s.last_name, s.profession
        FROM tbl_users u 
        INNER JOIN tbl_staff_profiles s ON u.user_id = s.user_id
        WHERE u.user_id = $id";

$res = mysqli_query($conn, $sql);

if ($res) {

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $row = mysqli_fetch_assoc($res);
        $user_id = $row["user_id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $user_type = $row["user_type"];
        $username = $row["username"];
        $email = $row["email"];
        $profession = $row["profession"];
    } else {

        header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
        exit();
    }
} else {

    header('location:http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php');
    exit();
}

if (isset($_POST['submit'])) {

    $id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];

    $sql = "UPDATE tbl_users u
            INNER JOIN tbl_staff_profiles s ON u.user_id = s.user_id
            SET u.first_name = '$first_name',
                u.last_name = '$last_name',
                u.username = '$username',
                u.email = '$email',
                s.profession = '$profession'
            WHERE u.user_id = $id";

    $res = mysqli_query($conn, $sql);

if ($res) {

    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['profession'] = $profession;


    header("location: http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php");
    exit();
} else {
    
    $_SESSION['update'] = "<div class='error'>Failed to Update Staff</div>";
    header("location: http://localhost/UEB2_PROJEKTI/staff/staff_dashboard.php");
    exit();
}

}
?>
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