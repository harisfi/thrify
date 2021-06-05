<?php
session_start();

$now = basename($_SERVER['PHP_SELF']);

if (empty($_SESSION['id_admin']) || empty($_SESSION['nama_admin']) || empty($_SESSION['tipe_admin']) || empty($_SESSION['foto_admin']) || empty($_SESSION['uname_admin'])) {
    signout($now);
} else {
    if (($now == "admin.php" || $now == "admin-tambah.php" || $now == "admin-edit.php" || $now == "admin-detail.php") && strtolower($_SESSION['tipe_admin']) == "admin" || $now == "login.php") {
        header("Location:index.php");
    }
}

function signout($now) {
    session_unset();
    session_destroy();
    if ($now != "login.php") {
        header("Location:login.php");
    }
}
?>