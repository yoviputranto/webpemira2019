<?php
error_reporting(0);
include("check.php");
//error_reporting(0);
//require '../include/koneksi.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Admin Panel">
    <meta name="author" content="muhammad_naufal@apps.ipb.ac.id">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="../favicon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>
    <style>
        .panel-heading [data-toggle="collapse"]:after {
            font-family: 'FontAwesome';
            content: "\f078"; /* "play" icon */
            float: right;
            margin-right: 10px;
            /*color: #F58723;*/
            font-size: 18px;
            line-height: 22px;
            /* rotate "play" icon from > (right arrow) to down arrow */
            -webkit-transform: rotate(-180deg);
            -moz-transform: rotate(-180deg);
            -ms-transform: rotate(-180deg);
            -o-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        .panel-heading [data-toggle="collapse"].collapsed:after {
            /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
            /*color: #454444;*/
        }
    </style>
    <style type="text/css">
        /* vietnamese */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hJFQNcOM.woff2) format('woff2');
        unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }
        /* latin-ext */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hJVQNcOM.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }
        /* latin */
        @font-face {
        font-family: 'Quicksand';
        font-style: normal;
        font-weight: 400;
        src: local('Quicksand Regular'), local('Quicksand-Regular'), url(../fonts/quicksand/v9/6xKtdSZaM9iE8KbpRA_hK1QN.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }
    </style>
    <style type="text/css">
        body {
            font-family: 'Quicksand', sans-serif;
        }
        code {
            font-size: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./#"><i class="fa fa-home"></i> Home</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($panitia == "ya") {
                        echo '<li><a href="search.php">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    } else {
                        echo '<li><a href="result.php">Result</a></li>
                    <li><a href="reset.php">Reset</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    }
                    ?>
                    <li><a class="btn btn-md btn-default btn-block" href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container-fluid" style="max-width: 600px;">
        <h2>Selamat Datang!</h2>
        <p>Harap baca FAQ dibawah ya</p>

        <div class="panel-group" id="accordion" style="min-width: 350px;">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#i1" href="#">
                        Info suara pemilih
                        </a>
                    </h4>
                </div>
                <div id="i1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php
                            $j3a = "J3A";
                            $sql_j3a_1 = "SELECT count(nim) as jml FROM pemilih WHERE (`nim` LIKE '%".$j3a."%')";
                            $sql_j3a_2 = $sql_j3a_1." AND status = 'sdh'";
                            $q_j3a_1 = mysqli_query($kon, $sql_j3a_1);
                            $q_j3a_2 = mysqli_query($kon, $sql_j3a_2);
                            $res_j3a_1 = mysqli_fetch_assoc($q_j3a_1);
                            $res_j3a_2 = mysqli_fetch_assoc($q_j3a_2);
                            echo "KMN: ".$res_j3a_2['jml']."/".$res_j3a_1['jml'];
                            echo " (".round((($res_j3a_2['jml']/$res_j3a_1['jml'])*100/100),2)."%)";
                            echo "<br>";
                            $j3c = "J3C";
                            $sql_j3c_1 = "SELECT count(nim) as jml FROM pemilih WHERE (`nim` LIKE '%".$j3c."%')";
                            $sql_j3c_2 = $sql_j3c_1." AND status = 'sdh'";
                            $q_j3c_1 = mysqli_query($kon, $sql_j3c_1);
                            $q_j3c_2 = mysqli_query($kon, $sql_j3c_2);
                            $res_j3c_1 = mysqli_fetch_assoc($q_j3c_1);
                            $res_j3c_2 = mysqli_fetch_assoc($q_j3c_2);
                            echo "INF: ".$res_j3c_2['jml']."/".$res_j3c_1['jml'];
                            echo " (".round((($res_j3c_2['jml']/$res_j3c_1['jml'])*100/100),2)."%)";
                            echo "<br>";
                            $j3d = "J3D";
                            $sql_j3d_1 = "SELECT count(nim) as jml FROM pemilih WHERE (`nim` LIKE '%".$j3d."%')";
                            $sql_j3d_2 = $sql_j3d_1." AND status = 'sdh'";
                            $q_j3d_1 = mysqli_query($kon, $sql_j3d_1);
                            $q_j3d_2 = mysqli_query($kon, $sql_j3d_2);
                            $res_j3d_1 = mysqli_fetch_assoc($q_j3d_1);
                            $res_j3d_2 = mysqli_fetch_assoc($q_j3d_2);
                            echo "TEK: ".$res_j3d_2['jml']."/".$res_j3d_1['jml'];
                            echo " (".round((($res_j3d_2['jml']/$res_j3d_1['jml'])*100/100),2)."%)";
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q1" href="#">
                        Bagaimana cara melakukan <i>voting</i>?
                        </a>
                    </h4>
                </div>
                <div id="q1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Masukkan NIM dan Email di <a href="../index.php" target="_blank">halaman utama pemira</a>. Pastikan captcha juga diisi.</li>
                            <li>Cek email untuk mendapatkan token.</li>
                            <li>Masukkan token pada halaman verifikasi token.</li>
                            <li>Pilih pasangan calon.</li>
                            <li>Selesai.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q2" href="#">
                        Token tidak terkirim?
                        </a>
                    </h4>
                </div>
                <div id="q2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Pemilih mendapatkan token jika telah melakukan verifikasi NIM dan E-mail.</li>
                            <li>Silakan cek kotak inbox maupun spam pada e-mail yang digunakan.</li>
                            <li>Pastikan juga status token telah berubah dari <code><i class='fa fa-close'></i></code> menjadi <code><i class='fa fa-check'></i></code>. Status token dapat dicek melalui halaman <a href="search.php">search</a>.</li>
                        </ol>
                        <p>
                            Apabila status token sudah <code><i class='fa fa-check'></i></code> dan tetap tidak terkirim, harap hubungi Admin.
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#q3" href="#">
                        NIM/Email salah atau tidak terdaftar</i>?
                        </a>
                    </h4>
                </div>
                <div id="q3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>
                            Cek kembali penulisan NIM/Email. NIM mahasiswa/i Sekolah Vokasi memiliki prefix <code>J3</code> dan diikuti dengan 7 karakter tambahan. Untuk email, pastikan gunakan email yang valid.
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#qcontact" href="#">
                        Contact
                        </a>
                    </h4>
                </div>
                <div id="qcontact" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>
                            <a href="http://line.me/ti/p/~menahankencing" target="_blank">LINE</a>
                        </p>
                    </div>
                </div>
            </div>

            <!--div class="panel panel-danger">
                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#x">
                    <h4 class="panel-title">
                        <a href="#" class="ing"></a></h4>
                </div>
                <div id="x" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                        <p>
                        </p>
                    </div>
                </div>
            </div-->

        </div><!-- panel-group -->
    </div>
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; 2019 &middot; HIMAVO MICRO IT</p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>
    <!--script type="text/javascript">
    $(window).load(
        function() {
            $('#myModal').modal('show');
        }
    );
    </script-->
</body>
</html>