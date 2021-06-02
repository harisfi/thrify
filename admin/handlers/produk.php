<?php
session_start();
include("../../koneksi/koneksi.php");
include("../classes/Utils.php");
if (!empty($_POST['produk'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['produk'] == "tambah" && !empty($_FILES)) {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $desc = mysqli_real_escape_string($koneksi, $_POST['desc']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
        $brand = mysqli_real_escape_string($koneksi, $_POST['brand']);
        $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
        $diskon = mysqli_real_escape_string($koneksi, $_POST['diskon']);
        $jum_foto = count($_FILES['foto']['name']);
        if (!empty($nama) && !empty($desc) && !empty($harga) && !empty($brand) && !empty($kategori) && $jum_foto > 0) {
            $query_p = "INSERT INTO tbl_produk VALUES (NULL, '$nama', '$desc', '$harga', '1', '$brand', '$kategori', $diskon, current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin', NULL, NULL, NULL)";
            $ret_p = mysqli_query($koneksi, $query_p);
            $jum_p = mysqli_affected_rows($koneksi);
            if ($jum_p > 0) {
                $last_id = mysqli_insert_id($koneksi);
                for ($i=0; $i < $jum_foto; $i++) { 
                    $source = $_FILES['foto']['tmp_name'][$i];
                    $filename = $_FILES['foto']['name'][$i];
                    $ext = Utils::fileExtension($filename);
                    $newname = time().'-'.uniqid().'.'.$ext;
                    $dest = '../assets/images/products/'.$newname;
                    if (move_uploaded_file($source, $dest)) {
                        $query_f = "INSERT INTO tbl_foto_produk VALUES (NULL, '$last_id', '$newname', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin', NULL, NULL, NULL)";
                        $ret_f = mysqli_query($koneksi, $query_f);
                        $jum_f = mysqli_affected_rows($koneksi);
                        if ($jum_f <= 0) {
                            header("Location:../produk-tambah.php?m=d-4");
                        }
                    } else {
                        header("Location:../produk-tambah.php?m=d-3");
                    }
                }
                header("Location:../produk.php?m=s-1");
            } else {
                echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                echo $query_p;
                // header("Location:../produk-tambah.php?m=d-2");
            }
        } else {
            header("Location:../produk-tambah.php?m=d-1");
        }
    } elseif ($_POST['produk'] == "edit") {
        # code...
    } else {
        header("Location:../produk.php");
    }
} else {
    header("Location:../produk.php");
}
?>