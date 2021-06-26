<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "makeup");

session_start();
if (!empty($_SESSION['username'])) {
    header("location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Beauty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <?php include('navbar.php'); ?>

</head>

<body>

    <div id="carouselExampleSlidesOnly" class="my-carousel carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./assets/img/bgfixx.jpg" class="d-block w-100" alt="...">

                <div class="carousel-caption d-none d-md-block" style="right:0; left:55%;  top:-5%">
                    <img src="./assets/img/bg_2.png" class="d-block w-100" alt="">

                </div>
                <div class="carousel-caption d-none d-md-block text-left">
                    <div class="container">
                        <div class="text-h">
                            <h1>My Beauty</h1>
                            <p>Kami bangga pada pekerjaan kami yang berkualitas tinggi dan perhatian terhadap detail. Produk yang kami gunakan adalah produk branded dengan kualitas terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="booking-page">
        <div class="booking-text">
            <p>Yuk Cari Makeup Artist Yang Paling Sesuai Dengan Selera dan Budgetmu, Ada di MyBeauty! Temukan Paket Menarik & Promo Dari Makeup Artist Pernikahan, Semuanya di MyBeauty!</p>
        </div>
        <div class="book-button-hero">
            <a href="login.php" class="btn btn-primary float-right book-button btn-lg">Booking sekarang!</a>
        </div>
        <div class="book-image">
            <img src="./assets/img/bg_1.png" alt="" style="margin-top:35%; width:40%">
        </div>

    </div>

    <?php include('footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="js/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>