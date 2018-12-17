<?php


$host='localhost';
$user='root';
$pass='';
$database='medicaltravel';

$connect=mysqli_connect($host, $user, $pass);

mysqli_select_db($connect, $database);

?>