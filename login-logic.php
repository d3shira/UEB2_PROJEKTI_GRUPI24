@ -1,104 +1,118 @@
<?php


if(isset($_COOKIE["username"])){
    $username = $_COOKIE["username"];
    header("client/client_dashboard.php");
}

if(isset($_COOKIE["user_type"])){
    $user_type = $_COOKIE["user_type"];
}

session_start();
 
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
 
require_once "database.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT user_id, username, password, user_type FROM tbl_users WHERE username = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) >0){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                           if($id=='') {die($id);}
                            $_SESSION["loggedin"] = true;
                             $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            $_SESSION["user_type"] = $role;

                            setcookie("username", $username, time() + (86400), "/"); // Cookie lasts for 30 days
                            setcookie("user_type", $role, time() + (86400), "/"); // Cookie lasts for 30 days

                            if($role === "client"){
                                header("location: client/client_dashboard.php");
                            } elseif ($role === "staff"){
                                header("location: staff/staff_dashboard.php");
                            }elseif($role==="admin"){
                                header("location: admin/admin dashboard.php");
                            }
                            } else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($conn);
}
?>