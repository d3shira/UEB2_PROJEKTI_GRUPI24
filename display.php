<?php
$host = "localhost:3307";
$dbname = "ueb2";
$username = "root";
$password = 'Replace.3';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM tbl_faq";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $faqs = $statement->fetchAll();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" href="add.css">
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-12 accordion_one">
            <div class="panel-group">
                <?php foreach ($faqs as $faq): ?>
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#faq-<?php echo $faq['faq_id']; ?>" aria-expanded="false" class="collapsed">
                                    <?php echo $faq['question']; ?>
                                </a>
                            </h4>
                        </div>

                        <div id="faq-<?php echo $faq['faq_id']; ?>" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                            <div class="panel-body">
                                <div class="text-accordion">
                                    <?php echo $faq['answer']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
