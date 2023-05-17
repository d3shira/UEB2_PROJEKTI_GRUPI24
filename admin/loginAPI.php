<?php   

require_once 'config.php';
require_once 'vendor/autoload.php';



session_start();

if (isset($_POST['signupBtn'])) {
    // Validate user input
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirmPassword']);

    $userExists = "Select * from tbl_users where username = '$username'";

    $result =  mysqli_query($conn,$userExists);
    if(mysqli_num_rows($result)>0){
        $error[] = "The username is already taken!";
    }
    else{

        if($password != $confirm_password){
            $error[] = "Passwords do not match!";
        }
        else{


        $verificationCode = rand(100000, 999999);
        $sql = "INSERT INTO tbl_users (first_name, last_name, user_type, email, username, password, VerificationCode, VerificationStatus, Status, Created_at)
        VALUES ('$first_name', '$last_name', '$user_type', '$email', '$username', '$password', '$verificationCode', '0', '0', NOW())";
        mysqli_query($conn, $sql);

        $user_id = mysqli_insert_id($conn);

        // Send verification email using SendGrid
        $email = new \SendGrid\Mail\Mail();
        // Set the verification URL as a substitution value
    // Set the HTML content of the email using your SendGrid template, with the substitution value included
        $email->setFrom("fit_youwebsite@outlook.com", "Fit You");
        $email->setTemplateId("d-ba05ed0bbbb545449dc35d43ac06c7b6");
        $email->addDynamicTemplateData("verificationCode", $verificationCode);
        $email->addDynamicTemplateData("userId", $userId);
        $email->addTo($emailAddress, $firstName . " " . $lastName);
        /*$email->addContent(
            "text/plain",
            "To finish creating your account please click the link to verify your email: <a href='http://localhost/Online-Exam-System/verify-email.php?code={$verificationCode}'>Verify Email</a>"
        );*/
        
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            // Check response status code and headers for errors
            if ($response->statusCode() >= 400) {
                throw new Exception('Error sending email: ' . $response->body());
            }   
            // Redirect to login page after successful sign up
            $_SESSION["success"] = "Please check your email. We've sent a link to verify your account";
            header('Location:signup.php');
            exit();
        } catch (Exception $e) {
            $errors[] = 'Error sending email: ' . $e->getMessage();
        }
        }
    }

}
?>