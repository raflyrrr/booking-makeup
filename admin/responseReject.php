<?php
include 'dbConnect.php';
$transnum = $_GET['transnum'];
$reject="UPDATE booking SET status = 'Ditolak', price=0 where transnum=$transnum";
mysqli_query($db_connection,$reject);
header("location:adminTransaction.php");
?>