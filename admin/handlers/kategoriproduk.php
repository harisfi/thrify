<?php
session_start();
include("../../koneksi/koneksi.php");
if (isset($_POST['kategori'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['kategori'] == "tambah") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        if (!empty($nama)) {
            $query = "INSERT INTO tbl_kategori_produk VALUES(NULL, '$nama', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../kategoriproduk.php?m=s-1");
            } else {
                header("Location:../kategoriproduk-tambah.php?m=d-2");
            }
        } else {
            header("Location:../kategoriproduk-tambah.php?m=d-1");
        }
    } else if ($_POST['kategori'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        if (!empty($nama)) {
            $query = "UPDATE tbl_kategori_produk SET kategori = '$nama', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../kategoriproduk.php?m=s-2");
            } else {
                header("Location:../kategoriproduk-edit.php?m=d-2");
            }
        } else {
            header("Location:../kategoriproduk-edit.php?m=d-1");
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query = "DELETE FROM tbl_kategori_produk WHERE id = '$id'";
    $ret = mysqli_query($koneksi, $query);
    $jum = mysqli_affected_rows($koneksi);
    if ($jum > 0) {
        header("Location:../kategoriproduk.php?m=s-3");
    } else {
        header("Location:../kategoriproduk.php?m=d-4");
    }
    
}
?>