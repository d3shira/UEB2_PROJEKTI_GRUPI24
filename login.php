<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<title> Responsive Login and Signup Form </title>-->
    <script src="https://kit.fontawesome.com/860c7896a7.js" crossorigin="anonymous"></script>

   

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <style type="text/css">
        body{
    background-color: #e8e6e7;
    font-family: Arial, Helvetica, sans-serif;
    
}
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
}
h1{
    color: var(--black);
    font-size: 2.5rem;
    text-align:center;  /*try left later*/
}
.container{
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    column-gap: 30px;
   
}
header{
    font-size: 28px;
   
    color: #232836;
    text-align: center;
}
.form{
    position: absolute;
    max-width: 430px;
    width: 100%;
    padding: 30px;
    border-radius: 6px;
    background: #FFF;
    
}
.form.signup{
    opacity: 0;
    pointer-events: none;
}
.forms.show-signup .form.signup{
    opacity: 1;
    pointer-events: auto;
}
.forms.show-signup .form.login{
    opacity: 0;
    pointer-events: none;
}

form{
    margin-top: 30px;
}
.form .field{
    position: relative;
    height: 50px;
    width: 100%;
    margin-top: 20px;
    border-radius: 6px;
}
.field input,
.field button{
    height: 100%;
    width: 100%;
    border: none;
    font-size: 16px;
    font-weight: 400;
    border-radius: 6px;
}
.field input{
    outline: none;
    padding: 0 15px;
    border: 1px solid#CACACA;
}
.field input:focus{
    border-bottom-width: 2px;
}
.eye-icon{
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 18px;
    color: #8b8b8b;
    cursor: pointer;
    padding: 5px;
}
.field button{
    color: #fff;
    background-color: #4d7973;
    transition: all 0.3s ease;
    cursor: pointer;
}
.field button:hover{
    background-color: #1f4e45;
}
.form-link{
    text-align: center;
    margin-top: 10px;
}
.form-link span,
.form-link a{
    font-size: 14px;
    font-weight: 400;
    color: #232836;
}
.form a{
    color: #4d7973;
    text-decoration: none;
}
.form-content a:hover{
    text-decoration: underline;
}


@media screen and (max-width: 400px) {
    .form{
        padding: 20px 10px;
    }
    
}
</style>


    <title>Document</title>
</head>
<body>
    <?php @include 'navbar.php'?>

    <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <h1>Login</h1>
                    <form action="#">
                        <div class="field input-field">
                            <input type="email" placeholder="Email" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                           <a href="home.html"> <button>Login</button></a>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="signup.php" class="link signup-link">Signup</a></span>
                    </div>
                </div>
            </div>

            </div>
        </section>

        <script src="loginsignup.js"></script>
</body>
</html>