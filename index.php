<?php
    require 'include/countdown-sampai-selesai.inc.php';
    
    require 'include/koneksi.inc.php';
    
    if(isset($_SESSION['nim'])){
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verifikasi NIM Pemira MICRO IT IPB 2019</title>
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
    
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    function enableBtn(){
        document.getElementById("btn_pemira").disabled = false;
    }
    </script>
</head>
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
        <h3 class="text-center mb-3 timer"></h3>
            <form name="pemira" class="login100-form validate-form" action="include/verifikasi.inc.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <span class="login100-form-logo">
                    <img src="favicon.ico" style="width: 100px">
                </span>
                <span class="login100-form-title p-b-10 p-t-27"><!-- 34 27 -->
                    <?php
                        $sql = "SELECT count(nim) as jml FROM pemilih WHERE status = 'sdh'";
                        $rslt = mysqli_query($kon, $sql);
                        $sdhvote = mysqli_fetch_assoc($rslt);

                        $sql = "SELECT count(nim) as jml FROM pemilih WHERE status = 'blm'";
                        $rslt = mysqli_query($kon, $sql);
                        $blmvote = mysqli_fetch_assoc($rslt);

                        $total = $sdhvote['jml']+$blmvote['jml'];
                        if (($sdhvote['jml'] == $total) or ($_SESSION['waktu'] < 0)) {
                            echo "VOTE DITUTUP";
                            $pesan0 = '
                            <hr>
                            Terima kasih telah berpartisipasi.
                            Semoga pasangan calon yang terpilih nanti amanah dalam menjalankan tugasnya.
                            ';
                            $pesan = '
                            <script type="text/javascript">
                            document.getElementById("form_nim").style.display = "none";
                            document.getElementById("form_email").style.display = "none";
                            document.getElementById("form_btn").style.display = "none";
                            document.getElementById("form_grecaptcha").style.display = "none";
                            </script> ';
                        } else {
                            echo "VERIFIKASI NIM";
                            $pesan0 = '';
                            $pesan = '';
                        }

                    ?>
                </span>
                <!--h3 class="text-center mb-4" style="font-size: 10pt; color: white"><?php //echo $sdhvote['jml']; ?> dari <?php //echo $total; ?> orang telah menggunakan hak suaranya</h3-->
                <span class="login100-form-title2 p-b-10"><!-- 34 -->
                    Jumlah suara yang masuk: <?php echo $sdhvote['jml']; ?> / <?php echo $total; ?>
                    <?php echo $pesan0; ?>
                </span>
                <div class="wrap-input100 validate-input" data-validate="Masukkan NIM" id="form_nim">
                    <input class="input100" type="text" name="nim" style="text-transform:uppercase" maxlength="9" placeholder="J3XXXXXXX">
                    <span class="focus-input100" data-placeholder="&#xf200;"></span>
                </div>
                <!-- Email -->
                <div class="wrap-input100 validate-input" data-validate="Masukkan E-mail" id="form_email">
                    <input class="input100" type="email" name="email" placeholder="mail@domain">
                    <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                </div>
                
                <div class="g-recaptcha" style="margin: 0 auto; width: 300px;"  data-sitekey="6Lcgna0UAAAAAPqpV65K4w-0TH-IJpRaR6oJ04Cz" data-callback="enableBtn" id="form_grecaptcha"></div>
                <br>
                <div class="container-login100-form-btn" id="form_btn">
                    <button class="login100-form-btn" id="btn_pemira" disabled>Submit</button><!-- try disabled-->
                </div>
                <?php echo $pesan; ?>
                <!--h3 class="text-center mt-4" style="font-size: 12pt; color: white"></h3-->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'nim_invalid') {
                        $errorMsg = 'NIM/Email salah atau tidak terdaftar.\nSilakan periksa kembali.';
                    } elseif ($_GET['error'] == 'data_salah') {
                        $errorMsg = 'Data salah.\nSilakan periksa kembali.';
                    } elseif ($_GET['error'] == 'sudahmemilih') {
                        $errorMsg = 'Hak suaramu hanya bisa digunakan satu kali.';
                    } elseif ($_GET['error'] == 'verifikasi') {
                        $errorMsg = 'Kamu harus verifikasi NIM terlebih dahulu.';
                    } elseif ($_GET['error'] == 'error_email_1') {
                        $errorMsg = 'E-mail tidak dapat ditambahkan.';
                    } elseif ($_GET['error'] == 'error_email_2') {
                        $errorMsg = 'E-mail telah digunakan.';
                    } elseif ($_GET['error'] == 'error_email_3') {
                        $errorMsg = 'E-mail valid tapi belum dibuat.';
                    } elseif ($_GET['error'] == 'error_email_4') {
                        $errorMsg = 'E-mail tidak valid.';
                    } elseif ($_GET['error'] == 'error_email_5') {
                        $errorMsg = 'Pastikan kamu menggunakan e-mail google.';
                    } elseif ($_GET['error'] == 'captcha') {
                        $errorMsg = 'Captcha belum disubmit!';
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

<script src="js/countdown.js"></script>

</body>
</html>