<!DOCTYPE html>
<html>
<head>
    <title>Delete questions</title>

    <style>
 body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin-top:150px;
    }

    .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        margin-bottom: 50px;
    }

    h1.text-center {
        text-align: center;
        color: #192a56;
    }

    form {
        text-align: center;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .btnSubmit {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #27ae60;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btnSubmit:hover {
        background-color: #45a049;
    }

    h1 {
        text-align: center;
        color: #192a56;
    }

    p {
        font-size: 20px;
    }

    .deletebtn {
        background: #666;
        width: 100px;
        height: 50px;
        font-size: 20px;
        border-radius: 10px;
    }

    .deletebtn:hover {
        background: #534e4e;
    }
    </style>
</head>

<body>
    <?php @include 'navbar-admin.php' ?>
    <?php
    $host = "localhost:3307";
    $dbname = "ueb2";
    $username = "root";
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST["submit"])) {
            $sql = "DELETE FROM tbl_faq WHERE faq_id = ?";
            $statement = $conn->prepare($sql);
            $statement->execute([$_POST["id"]]);

            header("Location: staff-manage-mquestions.php");
            exit();
        }

        if (empty($_REQUEST["id"])) {
            die("FAQ ID is missing");
        }

        $sql = "SELECT * FROM tbl_faq WHERE faq_id = ?";
        $statement = $conn->prepare($sql);
        $statement->execute([$_REQUEST["id"]]);
        $faq = $statement->fetch();

        if (!$faq) {
            die("FAQ not found");
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    ?>

    <div class="container">
        <h1 class="text-center">FAQ Details</h1>
        <div style="margin-bottom:10px; margin-top:10px;">
            <p style="margin-left:42px;">Question: <?php echo $faq["question"]; ?></p>
            <p style="margin-left:42px;">Answer: <?php echo $faq["answer"]; ?></p>
        </div>

        <h1 class="text-center">Delete FAQ</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $faq["faq_id"]; ?>">
            <p style="margin-top:10px;">Are you sure you want to delete this FAQ?</p>
            <div class="text-center">
                <button type="submit" name="submit" class="deletebtn">Delete</button>
            </div>
        </form>
    </div>
</body>
</html>
