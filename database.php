
<?php
$dbhost='localhost:3307';
$dbuser='root';

$dbpass='';
$db='ueb2'; 
$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$db);

if(!$conn)
{
  die('Could not connect: '.mysqli_connect_error());
  
}

echo 'Connected successfully<br>';


?>