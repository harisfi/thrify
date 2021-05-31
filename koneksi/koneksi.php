<?php
$eHost = getenv("DB_HOST");
$eUser = getenv("DB_USER");
$ePass = getenv("DB_PASS");
$eName = getenv("DB_NAME");

if (!empty($eHost) && !empty($eUser) && !empty($ePass) && !empty($eName)) {
    $koneksi = mysqli_connect($eHost, $eUser, $ePass, $eName);
} else {
    $koneksi = mysqli_connect("localhost", "root", "", "db_thrify");
}

// cek koneksi
if (!$koneksi){
    die("Error koneksi: " . mysqli_connect_errno());
}