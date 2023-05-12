<?php

// Connect to the database
$host = "localhost:3307";
$dbname = "ueb2";
$username = "root";
$password = 'Replace.3';

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the delete form is submitted
    if (isset($_POST["submit"])) {
        // Delete the FAQ from the database
        $sql = "DELETE FROM tbl_faq WHERE faq_id = ?";
        $statement = $conn->prepare($sql);
        $statement->execute([$_POST["id"]]);

        // Redirect back to the previous page
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }

    // Check if the FAQ exists
   // Check if the FAQ exists
$sql = "SELECT * FROM tbl_faq WHERE faq_id = ?";
$statement = $conn->prepare($sql);
$statement->execute([$_REQUEST["id"]]); // Change $_GET to $_REQUEST
$faq = $statement->fetch();


    if (!$faq) {
        die("FAQ not found");
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>

<!-- Display the FAQ and delete form -->
<h1>FAQ Details</h1>
<p>Question: <?php echo $faq["question"]; ?></p>
<p>Answer: <?php echo $faq["answer"]; ?></p>

<form method="POST" action="" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
    <input type="hidden" name="id" value="<?php echo $faq['faq_id']; ?>" required>
    <input type="submit" name="submit" value="Delete">
</form>
