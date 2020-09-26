<?php
error_reporting(0);
include("check.php");

require '../include/koneksi.inc.php';
require '../include/generate-token.php';

$block = '
    <script type="text/javascript">
    document.getElementById("tabel").style.display = "none";
    //document.getElementById("tabel").classList.add("hidden");
    </script> ';

if (!$kon) {        
    $cekstatus = "Koneksi gagal.";
} else {
    if (!isset($_POST['nim'])) {
        $cekstatus = "Pilih dan Masukkan Data";
    } else {
        $nim = $_POST['nim'];
        $opsi = $_POST['opsi'];

        $min_length = 7;
        if (strlen($nim) >= $min_length) {
            $nim = htmlspecialchars($nim);
            $nim = mysqli_real_escape_string($kon, $nim);
            $res = mysqli_query($kon,"SELECT * FROM pemilih WHERE (`nim` LIKE '%".$nim."%')");
            if (mysqli_num_rows($res) == 1) {
                $data = mysqli_fetch_array($res);
                $nim = $data['nim'];
                $token = "PEMIRA-".getToken(5);
                mysqli_query($kon, "UPDATE pemilih SET $opsi = '$token' WHERE nim = '$nim'");
                $cekstatus = "Data telah direset";

                $block = "";
            } else {
                $cekstatus = "Data tidak ada";
            }
        } else {
            $cekstatus = "Data yang dimasukkan salah";
        }
    }
}
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
    <script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
    function confirmDelete() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        swal({
            title: "Konfirmasi",
            text: "Data akan direset. Apakah kamu yakin?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, reset",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                /*
                swal({
                    title: '',
                    text: '',
                    icon: 'success'
                });
                */
                form.submit();
            } else {
                swal("Cancelled", "Reset dibatalkan", "success");
            }
        });
    //return False;
    }
    function validateForm() {
        var x = document.forms["reset"]["opsi"].value;
        var y = document.forms["reset"]["nim"].value;
        if ((x && y) == "") {
            //setTimeout(function () { swal("Error!","Isi datanya dulu bang","error")}, 100);
            return false;
        } else {
            confirmDelete();
        }
    } 
    </script>
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
                <a class="navbar-brand" href="./home.php"><i class="fa fa-home"></i> Home</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($panitia == "ya") {
                        echo '<li class="active"><a href="#">Reset</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    } else {
                        echo '<li><a href="result.php">Result</a></li>
                    <li class="active"><a href="#">Reset</a></li>
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
        <h2><?php echo $cekstatus; ?></h2>
        <p>Pilih data dan input NIM</p>

        <div class="panel panel-default">
            <form method="post" action="" id="reset">
            <div class="panel-body">
                <div class="form-group">
                    <select class="form-control" name="opsi" required>
                        <option value="" selected disabled>-- Pilih data --</option>
                        <option value="token">Token</option>
                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">J3</span>
                    <input type="text" size="30" name="nim" id="nim" class="form-control" placeholder="" style="text-transform:uppercase" minlength="7" maxlength="9" oninvalid="this.setCustomValidity('Tolong masukkan NIM')" oninput="setCustomValidity('')" autocomplete="off" required>
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit" onclick="return validateForm()"><i class="fa fa-refresh"></i> Reset</button>
                    </span>
                </div>
            </div>
            </form>
        </div>
        <br>
        <table class="table" id="tabel"><?php echo $block; ?>
            <tr>
                <th>NIM</th>
                <td><?php echo $nim; ?></td>
            </tr>
            <tr>
                <th>Token</th>
                <td>
                    <code id="token"><?php echo $token; ?></code>
                    <a class="btn btn-default btn-xs" onclick="copyToClipboard('#token')">
                        <i class="fa fa-files-o"></i>
                    </a>
                </td>
            </tr>
        </table>
	</div><!-- /.container -->
	
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