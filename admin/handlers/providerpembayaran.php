<?php
session_start();
include("../../koneksi/koneksi.php");
include("../classes/Utils.php");
if (isset($_POST['provider'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['provider'] == "tambah") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $no_rek = mysqli_real_escape_string($koneksi, $_POST['no_rek']);
        if (!empty($nama) && !empty($no_rek) && isset($_FILES['logo'])) {
            $source = $_FILES['logo']['tmp_name'];
            $filename = $_FILES['logo']['name'];
            $ext = Utils::fileExtension($filename);
            $newname = time().'-'.uniqid().'.'.$ext;
            $dest = '../assets/images/providers/'.$newname;
            if (move_uploaded_file($source, $dest)) {
                $query = "INSERT INTO tbl_provider VALUES (NULL, '$nama', '$no_rek', '$newname', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
            } else {
                $query = "INSERT INTO tbl_provider VALUES (NULL, '$nama', '$no_rek', NULL, current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
            }
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../index.php?i=providerzpembayaran&m=s-1");
            } else {
                header("Location:../index.php?i=providerzpembayaran-tambah&m=d-2");
            }
        } else {
            header("Location:../index.php?i=providerzpembayaran-tambah&m=d-1");
        }
    } else if ($_POST['provider'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $no_rek = mysqli_real_escape_string($koneksi, $_POST['no_rek']);
        if (!empty($nama) && !empty($no_rek) || !empty($_FILES['logo'])) {
            $source = $_FILES['logo']['tmp_name'];
            $filename = $_FILES['logo']['name'];
            $ext = Utils::fileExtension($filename);
            $newname = time().'-'.uniqid().'.'.$ext;
            $dest = '../assets/images/providers/'.$newname;
            if (move_uploaded_file($source, $dest)) {
                $query = "UPDATE tbl_provider SET provider = '$nama', no_rek = '$no_rek', logo = '$newname', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            } else {
                $query = "UPDATE tbl_provider SET provider = '$nama', no_rek = '$no_rek', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            }
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../index.php?i=providerzpembayaran&m=s-2");
            } else {
                header("Location:../index.php?i=providerzpembayaran-edit&id=$id&m=d-2");
            }
        } else {
            header("Location:../index.php?i=providerzpembayaran-edit&id=$id&m=d-1");
        }
    }
} elseif (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query = "DELETE FROM tbl_provider WHERE id = '$id'";
    $ret = mysqli_query($koneksi, $query);
    $jum = mysqli_affected_rows($koneksi);
    if ($jum > 0) {
        header("Location:../index.php?i=providerzpembayaran&m=s-3");
    } else {
        header("Location:../index.php?i=providerzpembayaran&m=d-4");
    }
    
}
?>