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

    // Update query goes here

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
                <input type="submit" name="submit" class="btn btn-warning" value="Edit FAQ" />
            </form>
        </div>
    </div>
</div>

<script>
    // initialize rich text library
    window.addEventListener("load", function () {
        $("#answer").richText();
    });
</script>
