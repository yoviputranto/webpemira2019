<?php
error_reporting(0);
session_start();
require 'koneksi.inc.php';

$nopilihan = mysqli_real_escape_string($kon, $_POST['nourut']);

if (password_verify($_SESSION['token']."pilihnomorsatu", $nopilihan)) {
    $pilihan = 1;
} elseif (password_verify($_SESSION['token']."pilihnomordua", $nopilihan)) {
    $pilihan = 2;
} else {
    header("Location: ../pilih-paslon.php ");
}
$nim = $_SESSION['nim'];
$sql = "SELECT * FROM pemilih WHERE nim = '$nim'";
$raw = mysqli_query($kon, $sql);

if (mysqli_num_rows($raw) == 1) {
    $results = mysqli_fetch_array($raw);
    if ($results['pilihan'] == 0) {
        $sql = "UPDATE pemilih SET status = 'sdh', pilihan = '$pilihan' WHERE nim = '".$_SESSION['nim']."';";
        mysqli_query($kon, $sql);

        $sql = "UPDATE paslon SET jml_suara = jml_suara + 1 WHERE no_urut = '$pilihan';";
        mysqli_query($kon, $sql);

        /* tambahan */
        $vkey = base64_encode(md5($_SESSION['nim']+$_SESSION['token']+$_POST['nourut']));
        $_SESSION['token'] = $vkey;

        header("Location: ../sudahvote.php?vkey=".$vkey."");
    } else {
        header("Location: ../pilih-paslon.php?error=error::type_1");
    }
} else {
    header("Location: ../pilih-paslon.php?error=error::type_2");
}
?>