<?php
$db_connection = mysqli_connect("127.0.0.1", "root","", "makeup");
session_start();
if(empty($_SESSION['username'])){
	header("location: login.php");
}elseif(empty($_SESSION['date'])||empty($_SESSION['services'])||empty($_SESSION['price'])){
    header("location: home.php");
}

$username = $_SESSION['username'];
$date=$_SESSION['date'];
$services=$_SESSION['services'];
$totalharga = $_SESSION["price"];

echo $totalharga;

$query = " insert into booking (tgl,username,services,price) values 
            ('$date','$username','$services',$totalharga);";
$query_run = mysqli_query($db_connection,$query);
if($query_run){
    unset($_SESSION['date']);
    unset($_SESSION['services']);
    unset($_SESSION["price"]);
    
    header("location: booking.php");
}else{
    unset($_SESSION['date']);
    unset($_SESSION['services']);
    unset($_SESSION["price"]);

    echo 'Booking failed please try again!';
}
?>