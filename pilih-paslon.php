<?php
session_start();
require 'include/koneksi.inc.php';

if (!isset($_SESSION['nim'])) {
    header("Location: index.php?error=verifikasi");
    exit();
}
if (!isset($_SESSION['token'])) {
    header("Location: login.php?error=belum");
    exit();
}
$sql = "SELECT * FROM paslon;";
$rslt = mysqli_query($kon, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pilih Paslon Ketua dan Wakil Ketua MICRO IT IPB 2019</title>
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
	<link rel="stylesheet" type="text/css" href="css/util-paslon.css">
	<link rel="stylesheet" type="text/css" href="css/main-paslon.css">
	<link rel="stylesheet" type="text/css" href="css/style-paslon.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <script>
    function konfirmasi() {
        event.preventDefault();
        var form = event.target.form;
        swal({
            title: "Konfirmasi",
            text: "Apakah kamu yakin?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                form.submit();
            }
        });
    //return False;
    }
    </script>
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');
    .card{
        font-family: 'Poppins', sans-serif;
    }
    </style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<section class="wrapper">
            <div class="container-fostrap">
                <div>
                    <img src="favicon.ico" class="fostrap-logo"/>
                    <h1 class="heading">
                        Pilih Pasangan Calon Ketua dan Wakil Ketua<br><br>
                    </h1>
                </div>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-16 col-sm-6">
                                <div class="card">
                                    <a class="img-card" href="#">
                                        <img src="images/paslon1.png" />
                                    </a>
                                    <div class="card-content">
                                        <h4 class="card-title text-center">
                                            Raihan & Vandame
                                        </h4>
                                        <p class="card-body">
                                            <span style="font-weight: bold;">Visi</span>
                                            <br>"Menjadikan Himavo Micro IT sebagai wadah melatih softskill prodi TEK, INF, KMN untuk menghadapi industri 4.0."
                                            <br>
                                            <br>
                                            <span style="font-weight: bold;">Misi</span>
                                            <br>
                                            <br>1. Membuat program kerja antara divisi guna meningkatkan hardskill dan softskill antar anggota Himavo Micro IT.
                                            <br>2. Mempererat hubungan tali silahturahmi antara anggota dan alumni Micro IT guna menciptakan relasi yang baik.
                                            <br>3. Memperkenalkan Himavo Micro IT Sekolah Vokasi tidak hanya dilingkungan Sekolah Vokasi, namun juga pada diluar kampus.
                                        </p>
                                    </div>
                                    <div class="card-read-more">
                                        <form action="include/pilih.inc.php" method="post">
                                            <input type="hidden" name="nourut" value="<?php echo password_hash($_SESSION['token']."pilihnomorsatu", PASSWORD_DEFAULT); ?>" id="nourut">
                                            <button class="btn btn-block btn-primary" type="submit" onclick="return konfirmasi()">PILIH PASLON 1</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="card">
                                    <a class="img-card" href="#">
                                        <img src="images/paslon2.png" />
                                    </a>
                                    <div class="card-content">
                                        <h4 class="card-title text-center">
                                            Galih & Adinda
                                        </h4>
                                        <p class="card-body">
                                            <span style="font-weight: bold;">Visi</span>
                                            <br>"Menjadikan Himavo Micro IT Community Sekolah Vokasi IPB sebagai wadah untuk mengekspresikan aspirasi yang inovatif, kreatif, solutif dan responsif serta menjunjung tinggi nilai kekeluargaan dan kebersamaan."
                                            <br>
                                            <br>
                                            <span style="font-weight: bold;">Misi</span>
                                            <br>
                                            <br>1. Mewujudkan aspirasi yang inofatif, kreatif, solutif dan responsif.
                                            <br>2. Membangun komunikasi interpersonal dan fungsional Micro IT Community.
                                            <br>3. Mengoptimalisasikan fungsi dari setiap divisi jurnalistik, multimedia, webmaster, software hardware and networking.
                                            <br>4. Membentuk dan mengembangkan program kerja yang inofatif dan bermanfaat di bidang teknologi informasi.
                                            <br>5. Menciptakan output yang bermanfaat bagi masyarakat di lingkungan sekolah vokasi maupun sekitarnya.
                                        </p>
                                    </div>
                                    <div class="card-read-more">
                                        <form action="include/pilih.inc.php" method="post">
                                            <input type="hidden" name="nourut" value="<?php echo password_hash($_SESSION['token']."pilihnomordua", PASSWORD_DEFAULT); ?>">
                                            <button class="btn btn-block btn-primary" type="submit" onclick="return konfirmasi()">PILIH PASLON 2</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- container -->
                </div><!-- content -->
                
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'error::type_1') {
                        $errorMsg = 'error::type_1';
                    } elseif ($_GET['error'] == 'error::type_2') {
                        $errorMsg = 'error::type_2';
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
            </div><!-- container-fostrap -->
            </section>
        </div><!-- container-login100 -->
    </div><!-- limiter -->
	
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