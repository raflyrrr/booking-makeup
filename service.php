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
    <title>Services - My Beauty</title>
    <style class="bg">
        body {
            background: url("assets/img/bg.jpg") no-repeat fixed center;
            position: relative;
            background-size: 100%;

        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <?php include('navbar.php'); ?>

</head>

<body>
    <div class="heading">
        <div class="container">
            <h1 class="form-heading">Gallery</h1>
            <div class="row">
                <?php $query = "select * from services;";
                $query_run = mysqli_query($db_connection, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {

                ?>
                    <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="card mb-3 card-gallery">
                            <img src="./assets/img/makeupimages/<?php echo $row['gambar'] ?>" class="card-img-top">
                            <div class="card-body">
                                <h5><?php echo $row['kategori'] ?></h5>
                                <p>Harga: Rp. <?php echo number_format($row['harga']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
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