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
    <title>Booking Detail - My Beauty</title>
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <?php include('navbar.php') ?>
    </header>

    <?php
    $username = $_SESSION['username'];
    $query = "select name from customer where username = '$username'";
    $query_run = mysqli_query($db_connection, $query);
    $row = mysqli_fetch_assoc($query_run);
    $name = $row['name'];

    $transnum = $_GET['transnum'];
    $query = "select * from booking where transnum = $transnum";
    $query_run = mysqli_query($db_connection, $query);
    $row = mysqli_fetch_assoc($query_run);
    $tgl = $row['tgl'];
    $services = $row['services'];
    $price = $row['price'];
    $status = $row['status'];
    $datecreated = $row['datecreated'];

    $created = strtotime($datecreated);
    $createdformat = date('d M, h.i a', $created);

    $date = strtotime($tgl);
    $now = date('Y-m-d');
    $newformat = date('j F Y', $date);

    ?>

    <!-- <p class = "mt-3 ml-4 mb-1">OrderID:</p>
    <p class = "mt-3 ml-4">Booking for:</p>
    <h3 class = "mt-3 ml-4 mb-1">day, MM DD YYYY</h2> -->

    <div class="container card shadow-sm mt-4" style="width:900px; max-width: 90%">
        <div class="card-body">
            <div class=border-bottom>
                <div class="row">
                    <div class="col ">
                        <h3>Rincian Booking</h3>
                    </div>
                    <div class="col  card-title">
                        <p class="text-right"><?php echo $createdformat; ?></p>
                    </div>
                </div>
            </div>

            <div class="border-bottom mt-3 mb-3">
                <div class="mb-3">
                    <p class="text-muted">Nama</p>
                    <h4><?php echo $name; ?></h4>
                </div>
            </div>

            <div class="border-bottom mt-3 mb-1">
                <div class="mb-4">
                    <p class="text-muted">Rincian Pemesanan:</p>
                    <p class="card-title">Tanggal Booking:</p>
                    <h4 class="mb-3"><?php echo $newformat; ?></h4>
                    <p class="card-title">Nomor Lapangan:</p>

                    <h6 class="mb-3"><?php echo $services ?></h6>
                    <p class="card-title">Status:</p>

                    <h6 class="mb-3"><?php echo $status ?></h6>
                </div>
            </div>

            <div class="mt-3 mb-1">
                <div class="mb-1">
                    <p class="text-muted">Total Pembayaran:</p>
                    <h4>Rp. <?php echo money_format($price); ?></h4>
                </div>
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Batalkan Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin?<br>
                        Anda tidak dapat membatalkan tindakan ini
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a href="cancelbooking.php?transnum=<?php echo $transnum ?>"><button type="button" class="btn btn-primary">Yes</button></a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($status == "Menunggu Konfirmasi" && $tgl >= $now) {
        ?>

            <div class="container mb-2">
                <div class="mb-1">
                    Untuk pembayaran silahkan dapat transfer di rekening dibawah ini :
                    <br>
                    <br>
                    <img src="assets/img/bca.svg" width="80px" class="mr-3">Bank BCA
                    <br>
                    <p class="mt-2">No. Rekening 012345-123-123 atas nama <span class="norek">My Beauty</span></p>
                </div>
                <div class="mt-4 mb-4">
                    <a href="https://api.whatsapp.com/send?phone=6289653455762&text=Halo%2C%20saya%20ingin%20mengkonfirmasi%20pembayaran%20dengan%20Order%20id%3A%20<?php echo $transnum ?>%2C%20Username%3A%20<?php echo $username ?>%2C%20Total%20pembayaran%3A%20Rp.<?php echo $price ?>" class="btn btn-success" target="_blank"><i class="fab fa-whatsapp"></i> Konfirmasi Pembayaran</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Batalkan Pemesanan
                    </button>
                </div>
            </div>
    </div>
    <?php include('footer.php') ?>

<?php

        }
?>

<?Php //echo(time_elapsed_string($datecreated));




?>



</body>

</html>

<?php


function money_format($floatcurr, $curr = 'EUR')
{
    $currencies['ARS'] = array(2, ',', '.');          //  Argentine Peso
    $currencies['AMD'] = array(2, '.', ',');          //  Armenian Dram
    $currencies['AWG'] = array(2, '.', ',');          //  Aruban Guilder
    $currencies['AUD'] = array(2, '.', ' ');          //  Australian Dollar
    $currencies['BSD'] = array(2, '.', ',');          //  Bahamian Dollar
    $currencies['BHD'] = array(3, '.', ',');          //  Bahraini Dinar
    $currencies['BDT'] = array(2, '.', ',');          //  Bangladesh, Taka
    $currencies['BZD'] = array(2, '.', ',');          //  Belize Dollar
    $currencies['BMD'] = array(2, '.', ',');          //  Bermudian Dollar
    $currencies['BOB'] = array(2, '.', ',');          //  Bolivia, Boliviano
    $currencies['BAM'] = array(2, '.', ',');          //  Bosnia and Herzegovina, Convertible Marks
    $currencies['BWP'] = array(2, '.', ',');          //  Botswana, Pula
    $currencies['BRL'] = array(2, ',', '.');          //  Brazilian Real
    $currencies['BND'] = array(2, '.', ',');          //  Brunei Dollar
    $currencies['CAD'] = array(2, '.', ',');          //  Canadian Dollar
    $currencies['KYD'] = array(2, '.', ',');          //  Cayman Islands Dollar
    $currencies['CLP'] = array(0,  '', '.');          //  Chilean Peso
    $currencies['CNY'] = array(2, '.', ',');          //  China Yuan Renminbi
    $currencies['COP'] = array(2, ',', '.');          //  Colombian Peso
    $currencies['CRC'] = array(2, ',', '.');          //  Costa Rican Colon
    $currencies['HRK'] = array(2, ',', '.');          //  Croatian Kuna
    $currencies['CUC'] = array(2, '.', ',');          //  Cuban Convertible Peso
    $currencies['CUP'] = array(2, '.', ',');          //  Cuban Peso
    $currencies['CYP'] = array(2, '.', ',');          //  Cyprus Pound
    $currencies['CZK'] = array(2, '.', ',');          //  Czech Koruna
    $currencies['DKK'] = array(2, ',', '.');          //  Danish Krone
    $currencies['DOP'] = array(2, '.', ',');          //  Dominican Peso
    $currencies['XCD'] = array(2, '.', ',');          //  East Caribbean Dollar
    $currencies['EGP'] = array(2, '.', ',');          //  Egyptian Pound
    $currencies['SVC'] = array(2, '.', ',');          //  El Salvador Colon
    $currencies['ATS'] = array(2, ',', '.');          //  Euro
    $currencies['BEF'] = array(2, ',', '.');          //  Euro
    $currencies['DEM'] = array(2, ',', '.');          //  Euro
    $currencies['EEK'] = array(2, ',', '.');          //  Euro
    $currencies['ESP'] = array(2, ',', '.');          //  Euro
    $currencies['EUR'] = array(2, ',', '.');          //  Euro
    $currencies['FIM'] = array(2, ',', '.');          //  Euro
    $currencies['FRF'] = array(2, ',', '.');          //  Euro
    $currencies['GRD'] = array(2, ',', '.');          //  Euro
    $currencies['IEP'] = array(2, ',', '.');          //  Euro
    $currencies['ITL'] = array(2, ',', '.');          //  Euro
    $currencies['LUF'] = array(2, ',', '.');          //  Euro
    $currencies['NLG'] = array(2, ',', '.');          //  Euro
    $currencies['PTE'] = array(2, ',', '.');          //  Euro
    $currencies['GHC'] = array(2, '.', ',');          //  Ghana, Cedi
    $currencies['GIP'] = array(2, '.', ',');          //  Gibraltar Pound
    $currencies['GTQ'] = array(2, '.', ',');          //  Guatemala, Quetzal
    $currencies['HNL'] = array(2, '.', ',');          //  Honduras, Lempira
    $currencies['HKD'] = array(2, '.', ',');          //  Hong Kong Dollar
    $currencies['HUF'] = array(0,  '', '.');          //  Hungary, Forint
    $currencies['ISK'] = array(0,  '', '.');          //  Iceland Krona
    $currencies['INR'] = array(2, '.', ',');          //  Indian Rupee
    $currencies['IDR'] = array(2, ',', '.');          //  Indonesia, Rupiah
    $currencies['IRR'] = array(2, '.', ',');          //  Iranian Rial
    $currencies['JMD'] = array(2, '.', ',');          //  Jamaican Dollar
    $currencies['JPY'] = array(0,  '', ',');          //  Japan, Yen
    $currencies['JOD'] = array(3, '.', ',');          //  Jordanian Dinar
    $currencies['KES'] = array(2, '.', ',');          //  Kenyan Shilling
    $currencies['KWD'] = array(3, '.', ',');          //  Kuwaiti Dinar
    $currencies['LVL'] = array(2, '.', ',');          //  Latvian Lats
    $currencies['LBP'] = array(0,  '', ' ');          //  Lebanese Pound
    $currencies['LTL'] = array(2, ',', ' ');          //  Lithuanian Litas
    $currencies['MKD'] = array(2, '.', ',');          //  Macedonia, Denar
    $currencies['MYR'] = array(2, '.', ',');          //  Malaysian Ringgit
    $currencies['MTL'] = array(2, '.', ',');          //  Maltese Lira
    $currencies['MUR'] = array(0,  '', ',');          //  Mauritius Rupee
    $currencies['MXN'] = array(2, '.', ',');          //  Mexican Peso
    $currencies['MZM'] = array(2, ',', '.');          //  Mozambique Metical
    $currencies['NPR'] = array(2, '.', ',');          //  Nepalese Rupee
    $currencies['ANG'] = array(2, '.', ',');          //  Netherlands Antillian Guilder
    $currencies['ILS'] = array(2, '.', ',');          //  New Israeli Shekel
    $currencies['TRY'] = array(2, '.', ',');          //  New Turkish Lira
    $currencies['NZD'] = array(2, '.', ',');          //  New Zealand Dollar
    $currencies['NOK'] = array(2, ',', '.');          //  Norwegian Krone
    $currencies['PKR'] = array(2, '.', ',');          //  Pakistan Rupee
    $currencies['PEN'] = array(2, '.', ',');          //  Peru, Nuevo Sol
    $currencies['UYU'] = array(2, ',', '.');          //  Peso Uruguayo
    $currencies['PHP'] = array(2, '.', ',');          //  Philippine Peso
    $currencies['PLN'] = array(2, '.', ' ');          //  Poland, Zloty
    $currencies['GBP'] = array(2, '.', ',');          //  Pound Sterling
    $currencies['OMR'] = array(3, '.', ',');          //  Rial Omani
    $currencies['RON'] = array(2, ',', '.');          //  Romania, New Leu
    $currencies['ROL'] = array(2, ',', '.');          //  Romania, Old Leu
    $currencies['RUB'] = array(2, ',', '.');          //  Russian Ruble
    $currencies['SAR'] = array(2, '.', ',');          //  Saudi Riyal
    $currencies['SGD'] = array(2, '.', ',');          //  Singapore Dollar
    $currencies['SKK'] = array(2, ',', ' ');          //  Slovak Koruna
    $currencies['SIT'] = array(2, ',', '.');          //  Slovenia, Tolar
    $currencies['ZAR'] = array(2, '.', ' ');          //  South Africa, Rand
    $currencies['KRW'] = array(0,  '', ',');          //  South Korea, Won
    $currencies['SZL'] = array(2, '.', ', ');         //  Swaziland, Lilangeni
    $currencies['SEK'] = array(2, ',', '.');          //  Swedish Krona
    $currencies['CHF'] = array(2, '.', '\'');         //  Swiss Franc
    $currencies['TZS'] = array(2, '.', ',');          //  Tanzanian Shilling
    $currencies['THB'] = array(2, '.', ',');          //  Thailand, Baht
    $currencies['TOP'] = array(2, '.', ',');          //  Tonga, Paanga
    $currencies['AED'] = array(2, '.', ',');          //  UAE Dirham
    $currencies['UAH'] = array(2, ',', ' ');          //  Ukraine, Hryvnia
    $currencies['USD'] = array(2, '.', ',');          //  US Dollar
    $currencies['VUV'] = array(0,  '', ',');          //  Vanuatu, Vatu
    $currencies['VEF'] = array(2, ',', '.');          //  Venezuela Bolivares Fuertes
    $currencies['VEB'] = array(2, ',', '.');          //  Venezuela, Bolivar
    $currencies['VND'] = array(0,  '', '.');          //  Viet Nam, Dong
    $currencies['ZWD'] = array(2, '.', ' ');          //  Zimbabwe Dollar
    // custom function to generate: ##,##,###.##

    if ($curr == "INR") {
        return formatinr($floatcurr);
    } else {
        return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
    }
}

function formatinr($input)
{
    $dec = "";
    $pos = strpos($input, ".");
    if ($pos === FALSE) {
        //no decimals
    } else {
        //decimals
        $dec   = substr(round(substr($input, $pos), 2), 1);
        $input = substr($input, 0, $pos);
    }
    $num   = substr($input, -3);    // get the last 3 digits
    $input = substr($input, 0, -3); // omit the last 3 digits already stored in $num
    // loop the process - further get digits 2 by 2
    while (strlen($input) > 0) {
        $num   = substr($input, -2) . "," . $num;
        $input = substr($input, 0, -2);
    }
    return $num . $dec;
}

?>