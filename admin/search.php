<?php
error_reporting(0);
include("check.php");

include_once '../include/verifikasi-email.inc.php';

function emailValidator($email){
    $vmail = new verifyEmail();
    $vmail->setStreamTimeoutWait(20);
    //$vmail->Debug= TRUE;
    //$vmail->Debugoutput= 'html';
    $vmail->setEmailFrom('qiezaqie16@gmail.com');
    if ($vmail->check($email)) {
        return "<b><font color=\"green\">valid</font></b> & <b><font color=\"green\">exist</font></b>";
    } elseif (verifyEmail::validate($email)) {
        return "<b><font color=\"green\">valid</font></b> & <b><font color=\"red\">not exist</font></b>";
    } else {
        return "<b><font color=\"red\">not valid</font></b>";
    }
}

function sensorEmail($email) {
    $em   = explode("@",$email);
    $name = implode(array_slice($em, 0, count($em)-1), '@');
    $len  = floor(strlen($name)/2);
    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}
    
$block = '
    <script type="text/javascript">
    document.getElementById("tabel").style.display = "none";
    //document.getElementById("tabel").classList.add("hidden");
    </script> ';

if (!$kon) {
    $cekstatus = "Koneksi gagal.";
} else {
    if (!isset($_POST['nim'])) {
        $cekstatus = "Masukkan NIM";
        $nim = ""; $nama = ""; $email = ""; $status = ""; $token = "";
    } else {
        $query = $_POST['nim'];
        //$query = "J3".$query."";
        $min_length = 7;
        if (strlen($query) >= $min_length) {
            $query = htmlspecialchars($query);
            $query = mysqli_real_escape_string($kon, $query);
            $sqlnya = "SELECT * FROM pemilih WHERE (`nim` LIKE '%".$query."%')";
            //$sqlnya = "SELECT * FROM pemilih WHERE (`nim` = '".$query."')";
            $raw_results = mysqli_query($kon, $sqlnya);
            //$raw_results = mysql_query("SELECT * FROM pemilih WHERE (`nim` LIKE '%".$query."%') OR (`nama` LIKE '%".$query."%')") or die(mysql_error());
            if (mysqli_num_rows($raw_results) > 0) {
                while ($results = mysqli_fetch_array($raw_results)) {
                    $cekstatus = "Data ditemukan";
                    $nama = "
                        <th>Nama</th>
                        <td>".$results['nama']."</td>
                        ";
                    if ($results['status'] == "sdh") {
                        $nim = "
                            <th>NIM</th>
                            <td><font color=\"red\">".$results['nim']."</font></td>
                            ";
                    } else {
                        $nim = "
                            <th>NIM</th>
                            <td><font color=\"green\">".$results['nim']."</font></td>
                            ";
                    }
                    if ($results['email'] == "") {
                        $email = "
                            <th>Email</th>
                            <td><code><i class='fa fa-check'></i></code></td>
                            <!--td><code>&#10006 not set</code></td-->
                            ";
                    } else {
                        if ($panitia == "ya") {
                        $email = "
                            <th>Email</th>
                            <td>".sensorEmail($results['email'])."
                            </td><!-- &#10004 -->
                            ";
                        } else {
                        $email = "
                            <th>Email</th>
                            <td>".$results['email']."
                            </td><!-- &#10004 -->
                            ";
                        }
                    }
                    if ($results['token'] !== "") {
                        if ($panitia == "ya") {
                        $token = "
                            <th>Token</th>
                            <td><code><i class='fa fa-check'></i></code></td>
                            ";
                        } else {
                        $token = "
                            <th>Token</th>
                            <td><code>".$results['token']."</code></td>
                            ";
                        }
                    } else {
                        $token = "
                            <th>Token</th>
                            <td><code><i class='fa fa-close'></i></code></td>
                            ";
                    }
                    $block = "";
                }
            } else {
                $cekstatus = "Data tidak ditemukan.";
                $nim = ""; $nama = ""; $email = ""; $status = ""; $token = "";
            }
        } else {
            //echo "Minimum ".$min_length;
            $cekstatus = "Data yang dimasukkan salah.";
            $nim = ""; $nama = ""; $email = ""; $status = ""; $token = "";
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
    <script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
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
                        echo '<li class="active"><a href="">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    } else {
                        echo '<li><a href="result.php">Result</a></li>
                    <li><a href="reset.php">Reset</a></li>
                    <li class="active"><a href="#">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    }
                    ?>
                    <li><a class="btn btn-md btn-default btn-block" href="logout.php">Logout</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!--div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cara cari data</h4>
                </div-->
                <div class="modal-body">
                    <p>Prefix "<b>J3</b>" bersifat optional.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Paham kan?</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="max-width: 600px;">
        <h2><?php echo $cekstatus; ?></h2>
        <p>Prefix "<b>J3</b>" bersifat opsional.<br>
        Contoh: <code><b>J3</b>D118999</code> atau <code>D118999</code></p>
        <form method="post" action="">
            <div class="input-group">
                <span class="input-group-addon">J3</span>
                <input type="text" size="30" name="nim" id="nim" class="form-control" placeholder="" style="text-transform:uppercase" oninvalid="this.setCustomValidity('Tolong masukkan NIM')" oninput="setCustomValidity('')" minlength="7" maxlength="9" autocomplete="off" required>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit"><i class="fa fa-search"></i> Search</button>
                </span>
            </div>
        </form>
        <br>
        <table class="table" id="tabel"><?php echo $block; ?>
            <tr>
                <?php echo $nim; ?>
            </tr>
            <tr>
                <?php echo $nama; ?>
            </tr>
            <tr>
                <?php echo $email; ?>
            </tr>
            <tr>
                <?php echo $token; ?>
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