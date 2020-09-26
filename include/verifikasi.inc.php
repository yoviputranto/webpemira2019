<?php
error_reporting(0);
session_start();
require 'koneksi.inc.php';
require 'kirim-email.inc.php';

$nim = mysqli_real_escape_string($kon, $_POST['nim']);
$email = mysqli_real_escape_string($kon, $_POST['email']);
$sql = "SELECT * FROM pemilih WHERE nim = '$nim' AND email = '$email'";
$rslt = mysqli_query($kon, $sql);

$response = $_POST["g-recaptcha-response"];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => '6Lcgna0UAAAAAPwZX0lAdSGjTwkA8VBtyT6KOBJb',
    'response' => $_POST["g-recaptcha-response"]
);
$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data),
        'header' => 'Content-Type: application/x-www-form-urlencoded'
    )
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify); //$captcha_success->success == true | == false

if ($captcha_success->success == false) {
    header("Location: ../?error=captcha");
    exit();
} else if ($captcha_success->success == true) {

    if (mysqli_num_rows($rslt) == 1) {

        $row = mysqli_fetch_assoc($rslt);
        if (($row['status'] == 'sdh') or ($row['pilihan'] != 0)) {
            header("Location: ../?error=sudahmemilih");
            exit();
        } else {
            $_SESSION['nim'] = $nim;

            $namaPendek = explode(" ",$row['nama']);
            
            if (count($namaPendek) >= 2) {
                $nama = $namaPendek[0]." ".$namaPendek[1];
            } else {
                $nama = $namaPendek[0];
            }

            kirimEmail($nim, $row['email'], $nama);
        
            //$sql = "UPDATE pemilih SET token = 'PEMIRA-abcde' WHERE nim = '$nim'";
            //mysqli_query($kon, $sql);
        
            echo "<script>window.location.assign('../login.php')</script>";
        }
    
    } else {
        //echo '<script>alert("NIM salah atau tidak terdaftar di MICRO IT IPB!");</script>';
        header("Location: ../?error=nim_invalid");
        exit();
    }
    //header("Location: ../index.php");
}

?>