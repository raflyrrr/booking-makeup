<?php
$db_connection = mysqli_connect("127.0.0.1", "root", "", "makeup");

session_start();
if (empty($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Booking - My Beauty</title>
    <style class="bg">
        body {
            background: url("assets/img/bg.jpg") no-repeat fixed center;
            position: relative;
            background-size: 100%;

        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>



</head>

<body>
    <header>
        <?php include('navbar.php') ?>
    </header>


    <?PHP
    $date = $_GET['date'];
    $services = $_GET['services'];
    $time = strtotime($date);
    $now = date('Y-m-d');
    $newformat = date('l\, F jS Y', $time);
    $day = floor(($time - time()) / 86400);

    ?>
    <div class="heading-home">
        <div class="form-heading">
            <div class="container">
                <div class="card card-book">
                <h1>Ringkasan Pemesanan</h1>
                <form method="post" class="mt-3 mb-1" style="max-width: 60%">
                    <div class="form-group row">
                        <?php
                        $username = $_SESSION["username"];
                        $query = "select name from customer where username = '$username'";
                        $query_run = mysqli_query($db_connection, $query);
                        $row = mysqli_fetch_assoc($query_run);
                        $name = $row['name']
                        ?>
                        <label for="staticEmail" class="col-sm-2">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value=": <?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="inputPassword" value=": <?php echo $newformat; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2">Nomor Lapangan</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="inputPassword" value=": <?php echo $services; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2">Total Harga</label>
                        <div class="col-sm-10">
                            <?php
                            $queryHarga = "select * from services where harga and kategori = '$services'";
                            $query_run = mysqli_query($db_connection, $queryHarga);
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                 $totalharga = $row['harga'];
                            }
                            ?>
                            <input type="text" readonly class="form-control-plaintext font-weight-bold" id="inputPassword" value=": Rp. <?php echo number_format($totalharga) ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <?php
                            $_SESSION['date'] = $date;
                            $_SESSION['services'] = $services;
                            $_SESSION['price'] = $totalharga;
                            ?>
                            <a href=book.php><button type="button" class="btn btn-success btn-login" name="confirm">Konfirmasi</button></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div></div>
    <?php
    ?>
    <?php
    if (isset($_POST['confirm'])) {
        $query = "insert into booking (tgl,username,kategori) values 
                                ('$date',$username,'$services');";
        $query_run = mysqli_query($db_connection, $query);
        if ($query_run) {
            echo 'Sukses booking';
        } else {
            echo "Terjadi beberapa kesalahan, coba lagi!";
        }
    }
    ?>
    <?php include('footer.php') ?>

</body>

</html>