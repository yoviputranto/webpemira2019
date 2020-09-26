<?php
error_reporting(0);
session_start();
require 'koneksi.inc.php';

$nim = $_SESSION['nim'];
$token = mysqli_real_escape_string($kon, $_POST['token']);

$sql = "SELECT * FROM pemilih WHERE nim = '$nim' AND token = '$token'";
$rslt = mysqli_query($kon, $sql);

if ($row = mysqli_fetch_assoc($rslt)) {
    $_SESSION['token'] = $token;
    if ($_SESSION['token'] != '') {
        header("Location: ../pilih-paslon.php");
    } else {
        header("Location: ../login.php?error=token_salah");
    }
} else {
    header("Location: ../login.php?error=token_salah");
}
?>