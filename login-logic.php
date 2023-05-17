<?php


if(isset($_COOKIE["username"])){
    $username = $_COOKIE["username"];
    header("client/client_dashboard.php");
}

if(isset($_COOKIE["user_type"])){
    $user_type = $_COOKIE["user_type"];
}
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    if($_SESSION["user_type"] === "client"){
        header("location: client/client_dashboard.php");
    } elseif ($_SESSION["user_type"] === "staff"){
        header("location: staff/staff_dashboard.php");
    }elseif($_SESSION["user_type"] === "admin"){
        header("location: admin/admin dashboard.php");

    }
    exit;
}
 
// Include config file
require_once "database.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, username, password, user_type FROM tbl_users WHERE username = ? AND verification_status  = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_verification_status);
            
            // Set parameters
            $param_username = $username;
            $param_verification_status='verified';
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) >0){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                           if($id=='') {die($id);}
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                             $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["user_type"] = $role;

                            // Set cookies for username and user type
                            setcookie("username", $username, time() + (86400), "/"); // Cookie lasts for 30 days
                            setcookie("user_type", $role, time() + (86400), "/"); // Cookie lasts for 30 days

                      // Redirect user to dashboard page
                            if($role === "client"){
                                header("location: client/client_dashboard.php");
                            } elseif ($role === "staff"){
                                header("location: staff/staff_dashboard.php");
                            }elseif($role==="admin"){
                                header("location: admin/admin dashboard.php");
                            }
                            } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>