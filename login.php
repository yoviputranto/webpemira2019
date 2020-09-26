<?php
session_start();
require 'include/koneksi.inc.php';

if (!isset($_SESSION['nim'])) {
    header("Location: index.php?error=verifikasi");
    exit();
}

$nim = mysqli_real_escape_string($kon, $_SESSION['nim']);
$sql = "SELECT * FROM pemilih WHERE nim = '$nim'";

$rslt = mysqli_query($kon, $sql);
if($row = mysqli_fetch_assoc($rslt)){
    if ($row['status'] == 'sdh') {
        header("Location: ../?error=sudahmemilih");
        exit();
    }
    
    $namaArr = explode(" ",$row['nama']);
    
    if (count($namaArr) >= 2) {
        $nama = $namaArr[0]." ".$namaArr[1];
    } else {
        $nama = $namaArr[0];
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Pemilih Pemira MICRO IT IPB 2019</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" action="include/login.inc.php" method="post" autocomplete="off">
				<span class="login100-form-logo">
					<img src="favicon.ico" style="width: 100px">
				</span>
                <span class="login100-form-title p-b-10 p-t-27"><!-- 34 27 -->
					MASUKKAN TOKEN
				</span>
                <h3 class="text-center mb-2" style="font-size: 10pt; color: white">Hai <?php echo $nama."! <br>"; ?>Silakan cek kotak inbox/spam pada e-mail untuk mendapatkan token</h3><!-- mb-4 12pt -->
                <!--h3 class="text-center mb-2" style="font-size: 10pt; color: white">E-mail: <?php //echo sensorEmail($_SESSION['email']); ?></h3-->
                <fieldset disabled>
                    <div class="wrap-input100 validate-input" data-validate = "Masukkan NIM">
                        <input class="input100" type="text" name="nim" placeholder="NIM" value="<?php echo strtoupper($_SESSION['nim']); ?>">
                        <span class="focus-input100" data-placeholder="&#xf200;"></span>
                    </div>
                </fieldset>
                <div class="wrap-input100 validate-input" data-validate="Masukkan Token">
                    <input class="input100" type="text" name="token" maxlength="12" placeholder="Token">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">Submit</button>
                </div>
                <!--h3 class="text-center mt-4" style="font-size: 12pt; color: white"></h3-->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'token_salah') {
                        $errorMsg = 'Token yang kamu masukkan salah.';
                    } elseif ($_GET['error'] == 'belum') {
                        $errorMsg = 'Silakan masukkan token terlebih dahulu.';
                    } else {
                        $errorMsg = 'undefined';
                    }
                    if ($errorMsg != 'undefined') {
                        echo '<script type="text/javascript">';
                        echo 'setTimeout(function () { swal(
                            "Error!",
                            "'.$errorMsg.'",
                            "error")';
                        echo '}, 1000);</script>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>

<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<script src="vendor/animsition/js/animsition.min.js"></script>

<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="vendor/select2/select2.min.js"></script>

<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>

<script src="vendor/countdowntime/countdowntime.js"></script>

<script src="js/main.js"></script>

</body>
</html>