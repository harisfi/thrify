<?php
session_start();
include("../../koneksi/koneksi.php");
if (isset($_POST['pesanan'])) {
    if ($_POST['pesanan'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $status = mysqli_real_escape_string($koneksi, $_POST['status']);
        if (!empty($id) && !empty($status)) {
            $query = "UPDATE tbl_pesanan SET id_status = '$status' WHERE id = '$id'";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../pesanan.php?m=s-1");
            } else {
                header("Location:../pesanan.php?m=d-2");
            }
        } else {
            header("Location:../pesanan.php?m=d-2");
        }
    } else {
        header("Location:../pesanan.php?m=d-2");
    }
} else {
    header("Location:../pesanan.php?m=d-2");
}
?>