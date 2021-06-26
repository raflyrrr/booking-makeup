<!DOCTYPE html>
<?php
session_start();
if (empty($_SESSION['inputAdmin'])) {
    header("location: adminLogin.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>My Beauty &mdash; Admin</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="mr-auto"></div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, Admin</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="adminLogout.php" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.php">MY BEAUTY</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.php">Mb</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Daftar</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Transaksi</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="adminTransaction.php">Daftar Transaksi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Kategori</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="adminCategory.php">Kategori Makeup</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>





            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Daftar Transaksi</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Daftar Transaksi Makeup</h2>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include "dbConnect.php";


                                    if (isset($_POST['search']) && $_POST['search'] == true) {
                                        $param = '%' . mysqli_real_escape_string($db_connection, $keyword) . '%';

                                        $sql = mysqli_query($db_connection, "SELECT * FROM booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR phonenum like '" . $param . "'");

                                        $sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
                                        $get_jumlah = mysqli_fetch_array($sql2);

                                        $sql3 = mysqli_query($db_connection, "SELECT sum(price) as total from booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
                                        $data2 = mysqli_fetch_array($sql3);

                                        $sqlacc = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahaccept FROM booking where status ='Diterima' AND username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
                                        $get_sqlacc = mysqli_fetch_array($sqlacc);
                                    } else {
                                        $sql = mysqli_query($db_connection, "select * from booking order by tgl desc");

                                        $sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM booking");
                                        $get_jumlah = mysqli_fetch_array($sql2);

                                        $sql3 = mysqli_query($db_connection, "select sum(price) as total from booking where status = 'Diterima'");
                                        $data2 = mysqli_fetch_array($sql3);

                                        $sqlacc = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahaccept FROM booking where status ='Diterima'");
                                        $get_sqlacc = mysqli_fetch_array($sqlacc);

                                        $sqlconf = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahconf FROM booking where status ='Menunggu Konfirmasi'");
                                        $get_sqlconf = mysqli_fetch_array($sqlconf);
                                    }
                                    while ($data = mysqli_fetch_array($sql)) {
                                        $status  = $data['status'];
                                    ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row"><?php echo $data['tgl'] ?></th>
                                                <th scope="row"><?php echo $data['username'] ?></th>
                                                <th scope="row"><?php echo $data['services'] ?></th>
                                                <th scope="row"><?php echo $data['price'] ?></th>
                                                <th scope="row"><?php echo $data['status'] ?></th>
                                                <th scope="row"><?php if ($status == 'Menunggu Konfirmasi') { ?>
                                                        <a href="responseAccept.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-success">Konfirmasi Booking</a>
                                                    <?php } ?>
                                                    <a href="delete.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-danger">Delete</a>
                                                </th>
                                            </tr>
                                        </tbody>
                                    <?php
                                    }
                                    ?>
                                </table>
                                Total data = <?php echo $get_jumlah['jumlah']; ?> data ditemukan. (<?php echo $get_sqlacc['jumlahaccept']; ?> diterima) (<?php echo $get_sqlconf['jumlahconf']; ?> ditolak)
                                <br>
                                Total pemasukan = Rp. <?php echo number_format($data2['total']) ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="./assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="./assets/js/scripts.js"></script>
    <script src="./assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>