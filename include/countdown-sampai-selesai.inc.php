<?php
//You must call the function session_start() before
//you attempt to work with sessions in PHP!

session_start();

require 'countdown.inc.php';
$_SESSION['waktu'] = countdown("selesai");

$hari = (int)($_SESSION['waktu'] / 86400);
$detik = $_SESSION['waktu'] - 86400 * $hari;
$jam = (int)($detik / 3600); $detik -= 3600 * $jam;
$menit = (int)($detik / 60); $detik -= 60 * $menit;

if ($jam < 10) {
    $jam = '0'.$jam;
}
if ($menit < 10) {
    $menit = '0'.$menit;
}
if ($detik < 10) {
    $detik = '0'.$detik;
}
//Print out the countdown.