<?php
include 'dbConnect.php';
$kategori = $_GET['kategori'];
$delete="DELETE FROM services where kategori = '$kategori'";
mysqli_query($db_connection,$delete);
header("location:adminCategory.php");
?>