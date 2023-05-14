<?php
// Establish a database connection
$host = 'localhost:3307';
$db = 'ueb2';
$user = 'root';
$password = 'Replace.3';

// Create a PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);

// Set PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prepare the SQL statement with GROUP BY and ORDER BY clause
$sql = "SELECT question, COUNT(*) AS frequency FROM tbl_faq GROUP BY question ORDER BY frequency DESC";
$statement = $pdo->prepare($sql);

// Execute the statement
$statement->execute();

// Fetch all the FAQs as an associative array
$faqs = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Most Frequently Asked Questions</title>
  <style>
   
  table {
    width: 80%;
    border-collapse: collapse;
    margin-left: 20px;
  }
  th, td {
    padding: 8px;
    text-align: left;
   
 
  }
  th {
    /* background-color: #f2f2f2; */
    font-weight: bold;
    border-bottom: 1px solid black; 
    color:#192a56;
  }
  
  h3 {
    margin-left: 20px;
    color:#192a56;
    font-size:25px;
  } 

  
</style>
</head>
<body>
  <h3>Most Frequently Asked Questions</h3>

  <table>
    <tr>
      <th style="font-size:20px;">Question</th>
      <th style="font-size:20px;">Frequency</th>
    </tr>
    <?php
    // Iterate over the fetched FAQs and display them in a table row
    foreach ($faqs as $faq) {
      echo '<tr>';
      echo '<td>' . $faq['question'] . '</td>';
      echo '<td>' . $faq['frequency'] . '</td>';
      echo '</tr>';
    }
    ?>
  </table>
</body>
</html>
