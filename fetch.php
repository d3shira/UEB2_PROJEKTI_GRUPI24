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
    * {
      background-color: #e0dddd;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-left: 20px;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    h1 {
      margin-left: 20px;
    }
  </style>
</head>
<body>
  <h1>Most Frequently Asked Questions</h1>

  <table>
    <tr>
      <th>Question</th>
      <th>Frequency</th>
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
