<?php
session_start();
include("../../koneksi/koneksi.php");
if (isset($_POST['brand'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['brand'] == "tambah") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        if (!empty($nama)) {
            $query = "INSERT INTO tbl_brand_produk VALUES(NULL, '$nama', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin', NULL, NULL, NULL)";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../brandproduk.php?m=s-1");
            } else {
                header("Location:../brandproduk-tambah.php?m=d-2");
            }
        } else {
            header("Location:../brandproduk-tambah.php?m=d-1");
        }
    } else if ($_POST['brand'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        if (!empty($nama)) {
            $query = "UPDATE tbl_brand_produk SET brand = '$nama', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../brandproduk.php?m=s-2");
            } else {
                header("Location:../brandproduk-edit.php?m=d-2");
            }
        } else {
            header("Location:../brandproduk-edit.php?m=d-1");
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query = "DELETE FROM tbl_brand_produk WHERE id = '$id'";
    $ret = mysqli_query($koneksi, $query);
    $jum = mysqli_affected_rows($koneksi);
    if ($jum > 0) {
        header("Location:../brandproduk.php?m=s-3");
    } else {
        header("Location:../brandproduk.php?m=d-4");
    }
    
}
?>