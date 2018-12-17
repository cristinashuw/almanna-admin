<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['username'])){
header ("location:login.php");
}

session_destroy();
echo "<script>alert('You have successfully logged in')</script>";
echo "<meta http-equiv='refresh' content='1 url=php/dashboard.php'>";

?>