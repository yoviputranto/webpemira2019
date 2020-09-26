<?php
error_reporting(0);

include("check.php");

$sql = "SELECT jml_suara as pas1 FROM paslon WHERE no_urut = '1'";
$rslt = mysqli_query($kon, $sql);
$paslon1 = mysqli_fetch_assoc($rslt);

$sql = "SELECT jml_suara as pas2 FROM paslon WHERE no_urut = '2'";
$rslt = mysqli_query($kon, $sql);
$paslon2 = mysqli_fetch_assoc($rslt);

$pemenang = max($paslon1['pas1'], $paslon2['pas2']);
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
    <link rel="icon" type="image/png" href="../favicon.ico" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/Chart.bundle.js"></script>
    <script src="../js/utils.js"></script>
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

        @media all and (max-width: 768px),
        only screen and (-webkit-min-device-pixel-ratio: 2) and (max-width: 1024px),
        only screen and (min--moz-device-pixel-ratio: 2) and (max-width: 1024px),
        only screen and (-o-min-device-pixel-ratio: 2/1) and (max-width: 1024px),
        only screen and (min-device-pixel-ratio: 2) and (max-width: 1024px),
        only screen and (min-resolution: 192dpi) and (max-width: 1024px),
        only screen and (min-resolution: 2dppx) and (max-width: 1024px) {
            h2.res {
                font-size: 20px !important;
            }
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
                        header("Location: logout.php");
                        exit();
                    } else {
                        echo '<li class="active"><a href="">Result</a></li>
                    <li><a href="reset.php">Reset</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="view.php">View</a></li>
';
                    }
                    ?>
                    <li><a class="btn btn-md btn-default btn-block" href="logout.php">Logout</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container-fluid" style="max-width: 600px;">
        <br>
    </div>

    <div class="container-fluid" style="max-width: 1200px;">
        <div class="row">
            <div class="col-md-6">
                <canvas id="chart-hasil-vote"></canvas>
                <!--h4 class="text-center mt-4">Total yang sudah vote : <?php //echo $sdhvote['jml']; 
                                                                        ?></h4-->
                <!--h4 class="text-center">Total yang belum vote : <?php //echo $blmvote['jml']; 
                                                                    ?></h4-->
            </div>

            <div class="col-md-5">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-body" <?php if ($paslon1['pas1'] == $pemenang) {
                                                    echo 'style="background-color: rgb(255, 99, 132);"';
                                                } ?>>
                            <div class="pull-left">
                                <img style="width: 150px;" src="../images/paslon1.png" alt="">
                            </div>
                            <div class="text-center">
                                <h2 class="res">
                                    <b>Raihan & Vandame</b><br>
                                    Jumlah suara:
                                    <?php echo $paslon1['pas1']; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body" <?php if ($paslon2['pas2'] == $pemenang) {
                                                    echo 'style="background-color: #1c7430; color: white;"';
                                                } ?>>
                            <div class="pull-left">
                                <img style="width: 150px" src="../images/paslon2.png" alt="">
                            </div>
                            <div class="text-center">
                                <h2 class="res">
                                    <b>Galih & Adinda</b><br>
                                    Jumlah suara:
                                    <?php echo $paslon2['pas2']; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        <?php

        $x = "SELECT count(nim) as jml FROM pemilih WHERE";

        $k1 = $x . " nim LIKE ('J3A%') AND status = 'sdh'";
        $k2 = $x . " nim LIKE ('J3A%') AND status = 'blm'";
        $k3 = $x . " nim LIKE ('J3A%')";

        $k1 = mysqli_fetch_assoc(mysqli_query($kon, $k1));
        $k2 = mysqli_fetch_assoc(mysqli_query($kon, $k2));
        $k3 = mysqli_fetch_assoc(mysqli_query($kon, $k3));

        $i1 = $x . " nim LIKE ('J3C%') AND status = 'sdh'";
        $i2 = $x . " nim LIKE ('J3C%') AND status = 'blm'";
        $i3 = $x . " nim LIKE ('J3C%')";

        $i1 = mysqli_fetch_assoc(mysqli_query($kon, $i1));
        $i2 = mysqli_fetch_assoc(mysqli_query($kon, $i2));
        $i3 = mysqli_fetch_assoc(mysqli_query($kon, $i3));

        $j1 = $x . " nim LIKE ('J3D%') AND status = 'sdh'";
        $j2 = $x . " nim LIKE ('J3D%') AND status = 'blm'";
        $j3 = $x . " nim LIKE ('J3D%')";

        $j1 = mysqli_fetch_assoc(mysqli_query($kon, $j1));
        $j2 = mysqli_fetch_assoc(mysqli_query($kon, $j2));
        $j3 = mysqli_fetch_assoc(mysqli_query($kon, $j3));



        ?>
        <div class="container-fluid" style="max-width: 900px;">
            <div class="row">
                <div class="col md-6">
                    <div class="table-responsive vertical-align">
                        <table class="table">
                            <thead>
                                <h2 class="res">Total perolehan suara</h2>
                                <tr>
                                    <th>Program Studi</th>
                                    <th>Suara Masuk</th>
                                    <th>Suara Golput</th>
                                    <th>Total Suara</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Komunikasi (KMN)</td>
                                    <td><?php echo $k1['jml']; ?></td>
                                    <td><?php echo $k2['jml']; ?></td>
                                    <td><?php echo $k3['jml']; ?></td>
                                </tr>
                                <tr>
                                    <td>Manajemen Informatika (INF)</td>
                                    <td><?php echo $i1['jml']; ?></td>
                                    <td><?php echo $i2['jml']; ?></td>
                                    <td><?php echo $i3['jml']; ?></td>
                                </tr>
                                <tr>
                                    <td>Teknik Komputer (TEK)</td>
                                    <td><?php echo $j1['jml']; ?></td>
                                    <td><?php echo $j2['jml']; ?></td>
                                    <td><?php echo $j3['jml']; ?></td>
                                </tr>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th><?php echo $k1['jml'] + $i1['jml'] + $j1['jml']; ?></th>
                                    <th><?php echo $k2['jml'] + $i2['jml'] + $j2['jml']; ?></th>
                                    <th><?php echo $k3['jml'] + $i3['jml'] + $j3['jml']; ?></th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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
</body>


<?php
echo
    '<script>
        var config = {
            type: \'pie\',
            data: {
                datasets: [{
                    data: [
                        ' . $paslon1['pas1'] . ',
                        ' . $paslon2['pas2'] . '
                    ],
                    backgroundColor: [
                        window.chartColors.red,
                        \'#1c7430\',
                        window.chartColors.blue
                    ],
                    label: \'Hasil Vote Ketua dan Wakil Ketua MICRO IT COMMUNITY IPB 2019\'
                }],
                labels: [
                    \'Raihan & Vandame\',
                    \'Galih & Adinda\'
                ]
            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            var ctx = document.getElementById(\'chart-hasil-vote\').getContext(\'2d\');
            window.myPie = new Chart(ctx, config);
        };
    </script>'
?>

</html>