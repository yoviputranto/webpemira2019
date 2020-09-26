<?php

function countdown($end){
    include 'koneksi.inc.php';

//Set the countdown
    $sql = "SELECT TIMESTAMPDIFF(SECOND, NOW(), $end) AS durasi FROM waktu";
    $waktu = mysqli_query($kon, $sql);

    if($row = mysqli_fetch_assoc($waktu)){
        $_SESSION['countdown'] = $row['durasi'];
    }
//Store the timestamp of when the countdown began.
    $_SESSION['time_started'] = time();


//Get the current timestamp.
    $now = time();

//Calculate how many seconds have passed since
//the countdown began.
    $timeSince = $now - $_SESSION['time_started'];

//How many seconds are remaining?
    $remainingSeconds = $_SESSION['countdown'] - $timeSince;

    return $remainingSeconds;
}