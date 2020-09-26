<?php
session_start();

if (isset($_GET['vkey']) && $_GET['vkey'] = $_SESSION['token']) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal(
        "Vote Berhasil!",
        "Terima kasih telah menggunakan hak suara Anda!",
        "success")';
    echo '}, 100);</script>';
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Vote Sukses!</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.ico"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CPoppins:400,500">
    <link rel="stylesheet" href="common-css/ionicons.css">
    <link rel="stylesheet" href="common-css/jquery.classycountdown.css" />
    <link rel="stylesheet" href="03-comming-soon/css/styles.css">
    <link rel="stylesheet" href="03-comming-soon/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>
    <div class="main-area center-text" style="background-image:url(images/bg-01.jpg);">
        <div class="display-table">
            <div class="display-table-cell">
                <h1 class="title font-white"><b>Terima kasih</b></h1>
                <p class="desc font-white">Semoga pasangan calon yang terpilih nanti amanah dalam menjalankan tugasnya.</p>
                <a class="notify-btn" href="index.php"><b>Kembali ke beranda</b></a>
            </div><!-- display-table -->
        </div><!-- display-table-cell -->
    </div><!-- main-area -->
</body>
</html>
<?php
session_destroy();
?>