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
        .tbl-full{
    width:100%;
}


table{
    margin-top:100px;
}
table tr th{
    border-bottom:1px solid black;
    padding: 1%;
    text-align: left;
}

.tbl-content{
    width:80%;
    bottom:55%;
    left:10%;
    right:30%;
    position:relative;
}

table tr td{
    padding:1%;
}

       
        .editbtn {
            background-color: #27ae60;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 10px;
        }

        .editbtn:hover {
            background-color:  #168d48 ;
        }

        .deletebtnn {
            background-color: #666;
            color: white;
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .deletebtnn:hover {
            background:   #4b4545;

        }

       
</style>
</head>
<body>
    <?php @include 'staff-navbar.php' ?>
<?php
$host = "localhost:3307";
$dbname = "ueb2";
$username = "root";
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["submit"])) {
        $sql = "INSERT INTO tbl_faq (question, answer) VALUES (?, ?)";
        $statement = $conn->prepare($sql);
        $statement->execute([
            $_POST["question"],
            $_POST["answer"]
        ]);
    }

    $sql = "SELECT * FROM tbl_faq";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $faqs = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($faqs as $faq) {
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM tbl_faq ORDER BY faq_id DESC";
$statement = $conn->prepare($sql);
$statement->execute();
$faqs = $statement->fetchAll();

?>

 <div class="container">
    <div class="tbl-contents">
        <table class="tbl-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $faq): ?>
                    <tr>
                        <td id='txt'><?php echo $faq["faq_id"]; ?></td>
                        <td id='txt'><?php echo $faq["question"]; ?></td>
                        <td id='txt'><?php echo $faq["answer"]; ?></td>
                        <td>
                          <!-- <button class="editbtn" ><a href="edit.php?id=<?php echo $faq['faq_id']; ?>" class="btn btn-warning btn-sm">Edit </a>
 </button> -->
 <!-- <a href="edit-question.php?id=<?php echo $faq['faq_id']; ?>" class="btn btn-warning btn-sm">
    Edit
</a> -->
<button class="editbtn" onclick="window.location.href='staff-edit-question.php?id=<?php echo $faq['faq_id']; ?>'" class="btn btn-warning btn-sm">Answer</button>

 <td>
                            <form method="POST" action="staff-delete-question.php" onsubmit="return confirm('Are you sure you want to delete this FAQ ?');">
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

</body>
</html>

