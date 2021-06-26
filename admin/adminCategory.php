<!DOCTYPE html>
<?php
include "dbConnect.php";
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
                        <h1>Daftar Kategori</h1>
                    </div>
                    <h2 class="section-title">Daftar Kategori Makeup</h2>
                    <div class="section-body">
                        <br>
                        <a href="adminAddCategory.php" class="btn btn-success mb-3">Add</a>
                        <?php if (isset($_POST['submit'])) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>Berhasil</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $query = "select * from services;";
                                $query_run = mysqli_query($db_connection, $query);
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['kategori']; ?></td>
                                            <td><?php echo "<img src='../assets/img/makeupimages/" . $row['gambar'] . "' height='130' width='150' />"; ?></td>
                                            <td><?php echo $row['harga']; ?></td>
                                            <td><a href="adminEditCategory.php?kategori=<?php echo $row['kategori']; ?>" class="btn btn-primary">Edit </a>
                                                <a href="deleteField.php?kategori=<?php echo $row['kategori']; ?>" class="btn btn-danger">Delete </a>
                                            </td>
                                        </tr>
                                    </tbody><?php } ?>
                            </table>
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