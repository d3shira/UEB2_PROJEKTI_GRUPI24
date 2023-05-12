<!DOCTYPE html>
<html>
    <head>
<title>Faqs</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />
 
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>

<script src="add.js"></script>
</head>
<body>
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <h1 class="text-center">Add FAQ</h1>
 
            <!-- for to add FAQ -->
            <form method="POST" action="add.php">
 
                <!-- question -->
                <div class="form-group">
                    <label>Enter Question</label>
                    <input type="text" name="question" class="form-control" required />
                </div>
 
                <!-- answer -->
                <div class="form-group">
                    <label>Enter Answer</label>
                    <textarea name="answer" id="answer" class="form-control" required></textarea>
                </div>
 
                <!-- submit button -->
                <input type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
            </form>
        </div>
    </div>
 
</div>


<!-- lidhja me database per phpmyadmin -->
<?php
// Database connection parameters
$host = "localhost:3307";
$dbname = "ueb2";
$username = "root";
$password = 'Replace.3';

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the insert form is submitted
    if (isset($_POST["submit"])) {
        // Insert into the tbl_faq table
        $sql = "INSERT INTO tbl_faq (question, answer) VALUES (?, ?)";
        $statement = $conn->prepare($sql);
        $statement->execute([
            $_POST["question"],
            $_POST["answer"]
        ]);
    }

    // Query to get all FAQs
    $sql = "SELECT * FROM tbl_faq";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $faqs = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Display the FAQs
    foreach ($faqs as $faq) {
        echo "Question: " . $faq["question"] . "<br>";
        echo "Answer: " . $faq["answer"] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


    

</body>
</html>