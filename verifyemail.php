        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <?php
            @include 'database.php';
            $_GET['user_id'];
            $_GET['token'];
        
            
            $sql = "select * from tbl_users where user_id='{$_GET['user_id']}' and token='{$_GET['token']}'";
        
            $VerifyUser = "update tbl_users set verification_status='verified' where token='{$_GET['token']}' and user_id='{$_GET['user_id']}'";
        
        
            $result = mysqli_query($conn,$sql);
            mysqli_query($conn,$VerifyUser);
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_array($result);
            }
            ?>
            <h1>Welcome</h1>
            <a href="login.php"></a>
            
        </body>
        </html>