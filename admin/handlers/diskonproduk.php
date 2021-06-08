<?php
session_start();
include("../../koneksi/koneksi.php");
if (isset($_POST['diskon'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['diskon'] == "tambah") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
        $status = isset($_POST['status']) ? mysqli_real_escape_string($koneksi, $_POST['status']) : NULL;
        if (!empty($nama) && !empty($jumlah)) {
            $status = !empty($status) ? 1 : 0;
            $query = "INSERT INTO tbl_diskon_produk VALUES(NULL, '$nama', '$jumlah', '$status', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../index.php?i=diskonzproduk&m=s-1");
            } else {
                header("Location:../index.php?i=diskonzproduk-tambah&m=d-2");
            }
        } else {
            header("Location:../index.php?i=diskonzproduk-tambah&m=d-1");
        }
    } else if ($_POST['diskon'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = isset($_POST['nama']) ? mysqli_real_escape_string($koneksi, $_POST['nama']) : NULL;
        $jumlah = isset($_POST['jumlah']) ? mysqli_real_escape_string($koneksi, $_POST['jumlah']) : NULL;
        $status = isset($_POST['status']) ? mysqli_real_escape_string($koneksi, $_POST['status']) : NULL;
        if (!empty($nama) && !empty($jumlah) || !empty($status)) {
            $status = $status == "on" ? 1 : 0;
            $query = "UPDATE tbl_diskon_produk SET nama = '$nama', persen = '$jumlah', aktif = '$status', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../index.php?i=diskonzproduk&m=s-2");
            } else {
                header("Location:../index.php?i=diskonzproduk-edit&id=$id&m=d-2");
            }
        } else {
            header("Location:../index.php?i=diskonzproduk-edit&id=$id&m=d-1");
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query = "DELETE FROM tbl_diskon_produk WHERE id = '$id'";
    $ret = mysqli_query($koneksi, $query);
    $jum = mysqli_affected_rows($koneksi);
    if ($jum > 0) {
        header("Location:../index.php?i=diskonzproduk&m=s-3");
    } else {
        header("Location:../index.php?i=diskonzproduk&m=d-4");
    }
}
?>