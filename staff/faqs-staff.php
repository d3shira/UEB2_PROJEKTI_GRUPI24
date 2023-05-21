<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    <link rel="stylesheet" href="faqs.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .faq {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin: 0 auto;
            margin:5px;
        }

        .question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .question h3 {
            font-size: 18px;
            color: #333;
            margin: 0;
        }

        .question svg {
            width: 15px;
            height: 10px;
        }

        .answer {
            display: none;
        }

        .answer p {
            margin: 0;
            color: #333;
            font-size:20px;
            text-align:left;
        }
    </style> 
</head>
<body>
    <?php @include 'staff-navbar.php' ?>
    
    <section class="sectionn">
        <h2 class="title">FAQs</h2>

        <?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "ueb2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT question, answer FROM tbl_faq WHERE answer <> '' ORDER BY date_time DESC LIMIT 4";
    $statement = $conn->prepare($sql);
    
    $statement->execute();
    
    $faqs = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($faqs as $faq) {
        echo '<div class="faq">';
        echo '<div class="question">';
        echo '<h3>' . $faq['question'] . '</h3>';
        echo '<svg width="15" height="10" viewBox="0 0 42 25">';
        echo '<path d="M3 3L21 21L39 3" stroke="white" stroke-width="7" stroke-linecap="round"/>';
        echo '</svg>';
        echo '</div>';
        echo '<div class="answer">';
        echo '<p> -' . $faq['answer'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>

<script>
    const questions = document.querySelectorAll('.question');

    questions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            answer.style.display = answer.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>