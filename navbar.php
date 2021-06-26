<nav class="my-nav navbar navbar-expand-lg navbar-light bg-none navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Beauty</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
      <ul class="navbar-nav ml-auto">

        <?php


        if (isset($_SESSION['username'])) :  $username = $_SESSION["username"];
          $query = "select name from customer where username = '$username'";
          $query_run = mysqli_query($db_connection, $query);
          $row = mysqli_fetch_assoc($query_run);
          $name = $row['name']; ?>

          <li class="nav-item dropdown"> <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons" style="font-size:30px">account_circle</i>
              <font color="black"><?php echo $row['name']; ?></font>
            </a>
            <div class="dropdown-menu ml-5">
              <a class="dropdown-item" href="booking.php">Lihat Booking</a>
              <a class="dropdown-item" href="history.php">Riwayat Booking</a>
              <a class="dropdown-item" href="logout.php">Log Out</a>
            </div>
          </li>

        <?php

        else : ?>
          <li class="nav-top">
            <a href="service.php">Services</a>
            <a href="signup.php">Daftar</a>
            <a href="login.php">Login</a>
          </li>
        <?php
        endif;

        ?>
      </ul>
    </div>
  </div>
</nav>