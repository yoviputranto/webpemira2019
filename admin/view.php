<?php
error_reporting(0);
include("check.php");
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
                        echo '<li><a href="search.php">Search</a></li>
                    <li class="active"><a href="#">View</a></li>
';
                    } else {
                        echo '<li><a href="result.php">Result</a></li>
                    <li><a href="reset.php">Reset</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li class="active"><a href="#">View</a></li>
';
                    }
                    ?>
                    <li><a class="btn btn-md btn-default btn-block" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid" style="max-width: 600px;">
        <h2>Daftar Pemilih</h2>
        <p><font color="red">Merah</font>: sudah vote | <font color="green">Hijau</font>: belum vote</p>

        <div class="modal fade" id="copied" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Yay</h4>
                    </div>
                    <div class="modal-body">
                        <center><font color="green"><p>Copied to clipboard</p></font></center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
                        
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th class="text-center">No</th>
					<th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Token</th>
                </tr>
                <?php
                include "../include/koneksi.inc.php";
                // Cek apakah terdapat data page pada URL
                $page = (isset($_GET['page']))? $_GET['page'] : 1;
                // Jumlah data per halamannya
                $limit = 20;
                // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
                $limit_start = ($page - 1) * $limit;		
                // Buat query untuk menampilkan data siswa sesuai limit yang ditentukan
                $sql = mysqli_query($kon, "SELECT * FROM pemilih LIMIT ".$limit_start.",".$limit);
                $no = $limit_start + 1; // Untuk penomoran tabel
                while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $no; ?></td>
                    <td class="align-middle"><?php if ($data['status'] == "sdh") {$warna = "red"; } else { $warna = "green"; }
                        //echo "<span class=\"label label-".$warna."\">".$data['nim']."</span>\n";
                        echo "<font id=\"".$no."\" color=\"".$warna."\">".$data['nim']."</font>\n"; ?>
                        <a class="btn btn-default btn-xs" onclick="copyToClipboard('#<?php echo $no; ?>')">
                            <i class="fa fa-files-o"></i>
                        </a>
                    </td>
                    <td class="align-middle"><?php echo $data['nama']; ?></td>
                    <td class="align-middle"><?php if ($data['email'] != "") { echo "<code><i class=\"fa fa-check\"></i></code>"; } else { echo "<code><i class=\"fa fa-close\"></i></code>"; } ?></td>
                    <td class="align-middle"><?php if ($data['token'] != "") { echo "<code><i class=\"fa fa-check\"></i></code>"; } else { echo "<code><i class=\"fa fa-close\"></i></code>"; } ?></td>
                </tr><!-- &#10004 &#10006 -->
                <?php
                    // Tambah 1 setiap kali looping
                    $no++;
                }
                ?>
            </table>
		</div>

        <!-- Pagination -->
        <div class="text-center">
            <ul class="pagination">

                <!-- Link First & Previous -->
                <?php
                // Jika page adalah page ke 1, maka disable link PREV
                if ($page == 1) {
                ?>
				<li class="disabled"><a class="btn btn-sm disabled" href="#">&laquo;</a></li>
				<li class="disabled"><a class="btn btn-sm disabled" href="#">&lsaquo;</a></li>
                <?php
                // Jika page bukan page ke 1
                } else {
                    $link_prev = ($page > 1)? $page - 1 : 1;
                ?>
				<li><a class="btn btn-sm" href="view.php?page=1">&laquo;</a></li>
				<li><a class="btn btn-sm" href="view.php?page=<?php echo $link_prev; ?>">&lsaquo;</a></li>
                <?php
                }
                ?>

				<!-- Link Angka -->
                <?php
                // Buat query untuk menghitung semua jumlah data
                $sql2 = mysqli_query($kon, "SELECT COUNT(*) AS jumlah FROM pemilih");
                $get_jumlah = mysqli_fetch_array($sql2);
                // Hitung jumlah halamannya
                $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);
                // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                $jumlah_number = 3;
                // Untuk awal link number
                $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                // Untuk akhir link number
                $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;

                for ($i = $start_number; $i <= $end_number; $i++) {
                    $link_active = ($page == $i)? 'class="active"' : '';
                ?>
				<li <?php echo $link_active; ?>><a class="btn btn-primary btn-sm" href="view.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
                }
                ?>

				<!-- Link Next & Last -->
                <?php
                // Jika page sama dengan jumlah page, maka disable link NEXT nya
                // Artinya page tersebut adalah page terakhir 
                if ($page == $jumlah_page) { // Jika page terakhir
                ?>
				<li class="disabled"><a class="btn btn-sm disabled" href="#">&rsaquo;</a></li>
				<li class="disabled"><a class="btn btn-sm disabled" href="#">&raquo;</a></li>
                <?php
                } else { // Jika Bukan page terakhir
                    $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                ?>
				<li><a class="btn btn-sm" href="view.php?page=<?php echo $link_next; ?>">&rsaquo;</a></li>
				<li><a class="btn btn-sm" href="view.php?page=<?php echo $jumlah_page; ?>">&raquo;</a></li>
                <?php
                }
                ?>

            </ul>
        </div>

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
</body>
</html>