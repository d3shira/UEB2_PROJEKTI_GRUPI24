<?php 
@include 'register-staff-logic.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
        *{
            text-decoration: none;
        }
        body{ font: 14px sans-serif;}
        .wrapper{ 
            width: 360px;
            padding:20px; 
            /* Include the Bootstrap stylesheet here */
            /* Note: the URL should be enclosed in quotes */
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            margin: 0 auto;
            margin-top: 50px;
            box-shadow: 0px 0px 10px #d9d9d9;
            -moz-box-shadow: 0px 0px 10px #d9d9d9;
            -webkit-box-shadow: 0px 0px 10px #d9d9d9;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: #555555;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 20px;
            font-size: 16px;
            line-height: 1.5;
            color: #555555;
            background-color: #ffffff;
            background-image: none;
            border: 1px solid #cccccc;
            border-radius: .25rem;
        }
        input[type="submit"],
        input[type="reset"] {
            display: block;
            width: 100%;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            background-image: none;
            border: 1px solid #007bff;
            border-radius: .25rem;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        input[type="submit"]:focus,
        input[type="reset"]:focus {
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Staff Sign Up</h2>
        <p>Create staff accounts.</p>
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
            <div class="form-group">
                <label>User Type</label>
                <br>

                <label for="staff">Staff</label>
		        <input type="radio" id="staff" name="user_type" value="staff" class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $role; ?>">
		        <span class="invalid-feedback"><?php echo $role_err; ?></span>
            </div>
    
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
                <br>
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="../login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>