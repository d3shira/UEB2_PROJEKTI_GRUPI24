<style>

*{
    background-color:#e0dddd;
}
    .text-center{
        text-align:center;
        color: #192a56;

    }

    .form-control{
        height:50px;
        width:200px;
    }
    .form-group {
        display: flex;
        flex-direction: row;
        align-items: center;
        font-size:20px;
        font-weight:600;
        margin-left:550px;
      }



.form-group textarea {
  padding: 10px;
  resize: vertical;
}

#answer{
    margin-top:5px;
    margin-left:12px;
}


.btnSubmit{
     margin-left:730px;
     height:50px;
     width:100px;
     margin-top:10px;
     font-weight:600;
     font-size:16px;
    background-color:#7db9be;
    border-radius:8px;
}

.btnSubmit:hover{
    background-color:#5a939a;
}
</style>

<?php
// Connect to the database using PHPMyAdmin
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

    // Update the FAQ in the database
    if (isset($_POST["submit"])) {
        $updateSql = "UPDATE tbl_faq SET question = :question, answer = :answer WHERE faq_id = :id";
        $updateStatement = $conn->prepare($updateSql);
        $updateStatement->bindParam(':question', $_POST["question"]);
        $updateStatement->bindParam(':answer', $_POST["answer"]);
        $updateStatement->bindParam(':id', $_POST["id"]);
        $updateStatement->execute();

        // Redirect to FAQs page or show a success message
        header("Location: faqs.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

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

            <!-- form to edit FAQ -->
            <form method="POST" action="edit.php">

                <!-- hidden ID field of FAQ -->
                <input type="hidden" name="id" value="<?php echo $faq['faq_id']; ?>" required />

                <!-- question, auto-populate -->
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