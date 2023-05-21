<?php

require_once "../database.php";
 

$first_name = $last_name = $username = $password = $role = $confirm_password = $email = $confirm_email = $token= "";
$first_name_err = $last_name_err = $username_err = $role_err = $password_err = $confirm_password_err = $email_err = $confirm_email_err = $token_err= "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{

        $sql = "SELECT user_id FROM tbl_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
  
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
        
            $param_username = trim($_POST["username"]);
            
  
            if(mysqli_stmt_execute($stmt)){
              
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

          
            mysqli_stmt_close($stmt);
        }
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter your email address.";
        } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $email_err = "Please enter a valid email address.";
        } else{
            $email = trim($_POST["email"]);
        }


     
$sql = "SELECT user_id FROM tbl_users WHERE email = ?";
      
if($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = trim($_POST["email"]);
        
    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
          
        if(mysqli_stmt_num_rows($stmt) == 1) {
            $email_err = "This email is already registered.";
        } else {
            $email = trim($_POST["email"]);
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    mysqli_stmt_close($stmt);
}


 
        if (empty(trim($_POST["confirm_email"]))) {
    $confirm_email_err = "Please confirm email address.";
        } else {
    $confirm_email = trim($_POST["confirm_email"]);
        if ($confirm_email !== $email) {
        $confirm_email_err = "Email addresses do not match.";
        }
    }


    if(empty(trim($_POST["user_type"]))){
        $role_err = "Please select a role.";
    } elseif(!in_array(trim($_POST["user_type"]), array("client", "staff"))){
        $role_err = "Invalid role.";
    } else{
        $role = trim($_POST["user_type"]);
    }
    

    if(empty($first_name_err)&&empty($last_name_err)&&empty($username_err) && empty($email_err)&&empty($token_err)&&empty($password_err) && empty($confirm_password_err)&& empty($role_err)){


         $token = bin2hex(random_bytes(32));

 
        $sql = "INSERT INTO tbl_users (first_name, last_name, username, email, token, password, user_type) VALUES (?, ?, ?, ?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
 
            mysqli_stmt_bind_param($stmt, "ssssiss", $param_first_name, $param_last_name, $param_username, $param_email, $param_token, $param_password, $param_role);
            
       
            $param_first_name=$first_name;
            $param_last_name=$last_name;
            $param_username = $username;
            $param_email=$email;
            $param_token=$token;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_role = $role;
            


            if(mysqli_stmt_execute($stmt)){

                $user_id = mysqli_insert_id($conn);

                  if($role == "client"){
                    $sql = "INSERT INTO tbl_client_profiles (user_id, first_name, last_name) VALUES (?,?,?)";
                } elseif($role == "staff"){
                    $sql = "INSERT INTO tbl_staff_profiles (user_id, first_name, last_name) VALUES (?,?,?)";
                }

                $stmt2 = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt2, "iss", $user_id, $first_name, $last_name);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_close($stmt2);


                header("location: admin-manage-staff.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    mysqli_close($conn);
}
?>
 