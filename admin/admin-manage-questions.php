<!DOCTYPE html>
<html>
    <head>
<title>Faqs</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="richtext/richtext.min.css" />
 
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="richtext/jquery.richtext.js"></script>

<script src="add.js"></script>

<style>

    .text-center{
        text-align:center;
        color:#192a56;
    }

.inputq{
    width:300px;
    height:40px;
    margin-left:50px;
}
.inputa{
    width:287px;
    height:40px;
    margin-left:63px;
    margin-top:5px;
}

.form-group {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.form-group label {
  margin-bottom: 5px;
}

.form-group textarea {
  padding: 10px;
  resize: vertical;
}

.Addfaq{
    margin-left:730px;
    margin-top:20px;
    height:40px;
    width:100px;
    background: #666;
    font-weight:600;
    font-size:15px;
    background: #666;
    color:white;
    padding: 6px 10px;
    border-radius: 4px;
border-color:transparent;
    
}
.Addfaq:hover{
    background: #534e4e;
}

#editbtn{
    background-color:#27ae60;
    /* border-radius:6px */
    /* height:30px;
    width:50px; */
    color:white;
    padding: 6px 17px;
    border-radius: 4px;
    /* border-color:transparent; */

}
.editbtn:hover{    
    background-color:#19914b;
}

.deletebtnn{
    background: #666;
    /* border-radius:6px; */
    /* height:30px;
    width:50px; */
    color:white;
    padding:6px 10px;
    border-radius: 4px;
    border-color:transparent;

}
.deletebtnn:hover{
    background: #534e4e;
}

.tablee{
    display:flex;
    /* border:3px solid grey; */
    justify-content:center;
    width:60%;
    margin-left:20%;
}

th{
    font-size:20px;
    border-bottom: 1px solid black;
}
td{
    padding:5px;
}

#txt{
    font-size:20px;
}
</style>
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
                    <label style="font-size:25px; margin-left:420px; font-weight:700px;">Enter Question</label>
                    <input class="inputq" type="text" name="question" class="form-control" required />
                </div>
 
                <!-- answer -->
                <div class="form-group">
                    <label style="font-size:25px; margin-left:420px;font-weight:700px; ">Enter Answer</label>
                    <textarea class="inputa"name="answer" id="answer" class="form-control" required></textarea>
                </div>


                <!-- submit button -->
                <input class="Addfaq" type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
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
        // echo "Question: " . $faq["question"] . "<br>";
        // echo "Answer: " . $faq["answer"] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM tbl_faq ORDER BY faq_id DESC";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();

?>
 <!-- Duhet me shtu diqka  Per me i rendit pytjet newest to oldest...--> 


    


 <div class="row">
    <div class="offset-md-2 col-md-8 tablee">
        <table class="table table-bordered">
            <!-- table heading -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
 
            <!-- table body -->
            <tbody>
                <?php foreach ($faqs as $faq): ?>
                    <tr>
                        <td id='txt'><?php echo $faq["faq_id"]; ?></td>
                        <td id='txt'><?php echo $faq["question"]; ?></td>
                        <td id='txt'><?php echo $faq["answer"]; ?></td>
                        <td>
                            <!-- [edit button goes here] -->
                          <!-- <button class="editbtn" ><a href="edit.php?id=<?php echo $faq['faq_id']; ?>" class="btn btn-warning btn-sm">Edit </a>
 </button> -->
 <a href="edit-question.php?id=<?php echo $faq['faq_id']; ?>" class=" btn btn-warning btn-sm" id="editbtn">
    Edit
 <td>
                            <form method="POST" action="delete-question.php" onsubmit="return confirm('Are you sure you want to delete this FAQ ?');">
    <input type="hidden" name="id" value="<?php echo $faq['faq_id']; ?>" required />
    <input class="deletebtnn"type="submit" value="Delete" class="btn btn-danger btn-sm" />
</form>
   
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
 
<!--  -->
</body>
</html>