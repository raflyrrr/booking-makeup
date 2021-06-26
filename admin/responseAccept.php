<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$accept="UPDATE booking SET status = 'Diterima' where transnum=$transnum";
mysqli_query($db_connection,$accept);
header("location:adminTransaction.php");
?>