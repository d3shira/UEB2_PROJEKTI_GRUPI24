<?php
$servername = "localhost:3307";
$username = "root";
$password = "Replace.3";
$dbname = "ueb2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if FAQ exists
    $sql = "SELECT * FROM tbl_faq WHERE faq_id = :id";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':id', $_REQUEST["id"]);
    $statement->execute();
    $faq = $statement->fetch();

    if (!$faq) {
        die("FAQ not found");
    }

    if (isset($_POST["submit"])) {
        $updateSql = "UPDATE tbl_faq SET question = :question, answer = :answer WHERE faq_id = :id";
        $updateStatement = $conn->prepare($updateSql);
        $updateStatement->bindParam(':question', $_POST["question"]);
        $updateStatement->bindParam(':answer', $_POST["answer"]);
        $updateStatement->bindParam(':id', $_POST["id"]);
        $updateStatement->execute();


        header("Location: edit-success.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<style>
 body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
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
</style>


<!-- include CSS -->
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />

<!-- include JS -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>



<!-- layout for form to edit FAQ -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">Edit FAQ</h1>

            <form method="POST" action="edit-question.php">

                <input type="hidden" name="id" value="<?php echo $faq['faq_id']; ?>" required />

                <div class="form-group">
                    <label>Enter Question</label>
                    <input type="text" name="question" class="form-control" value="<?php echo $faq['question']; ?>" required />
                </div>

                <!-- answer, auto-populate -->
                <div class="form-group">
                    <label>Enter Answer</label>
                    <textarea name="answer" id="answer" class="form-control" required><?php echo $faq['answer']; ?></textarea>
                </div>


                <!-- submit button -->
               <div class="butoniSubmit">
                <input  type="submit" name="submit" class="btnSubmit" value="Edit FAQ" /></div>
            </form>
        </div>
    </div>
</div>

<script>
    // initialize rich text library
    window.addEventListener("load", function () {
        $("#answer").richText();
    })
</script>