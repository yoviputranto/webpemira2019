<?php
include('../include/koneksi.inc.php');
session_start();

$user_check = $_SESSION['username'];
$ses_sql = mysqli_query($kon,"SELECT username FROM admin WHERE username='$user_check' ");
$row = mysqli_fetch_assoc($ses_sql);
$login_user = $row['username'];

if (isset($user_check) && (($login_user) && (isset($_COOKIE['username'])) == $user_check)) {
    if ($login_user != "adminpemira") {
        $panitia = "ya";
    } else {
        $panitia = "tidak";
    }
} else {
    setcookie("username", $_SESSION['username'], time()-3600);
    header("Location: logout.php");
}
?>