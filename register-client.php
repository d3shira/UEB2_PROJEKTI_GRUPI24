<?php
// Include config file
require_once "database.php";
 
// Define variables and initialize with empty values
$first_name = $last_name = $username = $password = $confirm_password = $email = $confirm_email = $token= "";
$first_name_err = $last_name_err = $username_err = $password_err = $confirm_password_err = $email_err = $confirm_email_err = $token_err= "";
$role = 'client';
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Validate first name
      if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM tbl_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

        // Validate email
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter your email address.";
        } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $email_err = "Please enter a valid email address.";
        } else{
            $email = trim($_POST["email"]);
        }


        // Check if email is already taken
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


        // Validate confirm email
        if (empty(trim($_POST["confirm_email"]))) {
    $confirm_email_err = "Please confirm email address.";
        } else {
    $confirm_email = trim($_POST["confirm_email"]);
        if ($confirm_email !== $email) {
        $confirm_email_err = "Email addresses do not match.";
        }
    }

    /////////////////////////////Validate role////////////////////////

    
    // Check input errors before inserting in database
    if(empty($first_name_err)&&empty($last_name_err)&&empty($username_err) && empty($email_err)&&empty($token_err)&&empty($password_err) && empty($confirm_password_err)&& empty($role_err)){

         // Generate a verification token
         $token = bin2hex(random_bytes(32));

        // Prepare an insert statement
        $sql = "INSERT INTO tbl_users (first_name, last_name, username, email, token, password, user_type) VALUES (?, ?, ?, ?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssiss", $param_first_name, $param_last_name, $param_username, $param_email, $param_token, $param_password, $param_role);
            
            // Set parameters
            $param_first_name=$first_name;
            $param_last_name=$last_name;
            $param_username = $username;
            $param_email=$email;
            $param_token=$token;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = 'client';
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            //        // Send the verification email
            // $to = $email;
            // $subject = 'Verify Your Email Address';
            // $message = '
            //     Hello '.$username.',<br><br>
            //     Thank you for signing up! To activate your account, please click the link below:<br><br>
            //     <a href="http://yourwebsite.com/verify.php?email='.$email.'&token='.$token.'">Verify Email Address</a><br><br>
            //     If you did not create an account on our website, please ignore this email.<br><br>
            //     Best regards,<br>
            //     Your Website Team
            // ';
            // $headers = 'From: yourwebsite@example.com' . "\r\n" .
            //             'Reply-To: yourwebsite@example.com' . "\r\n" .
            //             'Content-Type: text/html; charset=UTF-8' . "\r\n" .
            //             'X-Mailer: PHP/' . phpversion();
            // mail($to, $subject, $message, $headers);
            //      // Redirect to login page
            //      header("location: login.php");
            //      exit();

                // Get the user_id of the newly inserted row
                $user_id = mysqli_insert_id($conn);
                  // Insert additional data into the appropriate table
                  if($role == "client"){
                    $sql = "INSERT INTO tbl_client_profiles (user_id, first_name, last_name) VALUES (?,?,?)";
                } else{
                    $sql = "INSERT INTO tbl_staff_profiles (user_id, first_name, last_name) VALUES (?,?,?)";
                }

                $stmt2 = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt2, "iss", $user_id, $first_name, $last_name);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_close($stmt2);

                // Redirect the user to the appropriate dashboard page
                header("location: login.php");
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
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>  
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Email</label>
                <input type="email" name="confirm_email" class="form-control <?php echo (!empty($confirm_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_email; ?>">
                <span class="invalid-feedback"><?php echo $confirm_email_err; ?></span>
            </div>
            <!-- <div class="form-group">
                <label>User Type</label>
                <br>
                <label for="client">Client</label>
                <input type="radio" id="client" name="user_type" value="client" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
	            <span class="invalid-feedback"><?php //echo $role_err; ?></span>

                <label for="staff">Staff</label>
		        <input type="radio" id="staff" name="user_type" value="staff" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
		        <span class="invalid-feedback"><?php //echo $role_err; ?></span>
            </div>
     -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>