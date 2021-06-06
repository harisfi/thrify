<?php
session_start();
include("../../koneksi/koneksi.php");
include("../classes/Utils.php");
if (isset($_POST['admin'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['admin'] == "tambah") {
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $pass = mysqli_real_escape_string($koneksi, $_POST['pass']);
        $tipe = mysqli_real_escape_string($koneksi, $_POST['tipe']);

        if (!empty($nama) && !empty($username) && !empty($pass) && !empty($tipe) && isset($_FILES['foto'])) {
            $query_u = "SELECT id FROM tbl_admin WHERE username = '$username'";
            $ret_u = mysqli_query($koneksi, $query_u);
            $jum_u = mysqli_num_rows($ret_u);
            if ($jum_u > 0) {
                header("Location:../index.php?i=admin-tambah&m=d-2");
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $tipe = $tipe == 2 ? 'superadmin' : 'admin';

                $source = $_FILES['foto']['tmp_name'];
                $filename = $_FILES['foto']['name'];
                $ext = Utils::fileExtension($filename);
                $newname = time().'-'.uniqid().'.'.$ext;
                $dest = '../assets/images/admins/'.$newname;

                if (move_uploaded_file($source, $dest)) {
                    $query = "INSERT INTO tbl_admin VALUES (NULL, '$nama', '$username', '$pass', '$newname', '$tipe', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
                } else {
                    $query = "INSERT INTO tbl_admin VALUES (NULL, '$nama', '$username', '$pass', NULL, '$tipe', current_timestamp(), '$nama_admin', current_timestamp(), '$nama_admin')";
                }
                $ret = mysqli_query($koneksi, $query);
                $jum = mysqli_affected_rows($koneksi);
                if ($jum > 0) {
                    header("Location:../index.php?i=admin&m=s-1");
                } else {
                    header("Location:../index.php?i=admin-tambah&m=d-3");
                }
            }
        } else {
            header("Location:../index.php?i=admin-tambah&m=d-1");
        }
    } else if ($_POST['admin'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $tipe = mysqli_real_escape_string($koneksi, $_POST['tipe']);

        if (!empty($id) && !empty($nama) && !empty($username) && !empty($tipe)) {
            $tipe = $tipe == 2 ? 'superadmin' : 'admin';

            $query_u = "SELECT id FROM tbl_admin WHERE username = '$username'";
            $ret_u = mysqli_query($koneksi, $query_u);
            $jum_u = mysqli_num_rows($ret_u);

            if ($jum_u > 0) {
                $data_u = mysqli_fetch_row($ret_u);
                if ($data_u[0] == $id) {
                    goto up;
                } else {
                    header("Location:../index.php?i=admin-edit&id=$id&m=d-2");
                    die;
                }
            }

            up:
            if (isset($_FILES['foto'])) {
                $source = $_FILES['foto']['tmp_name'];
                $filename = $_FILES['foto']['name'];
                $ext = Utils::fileExtension($filename);
                $newname = time().'-'.uniqid().'.'.$ext;
                $dest = '../assets/images/admins/'.$newname;

                if (move_uploaded_file($source, $dest)) {
                    $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', tipe = '$tipe', foto = '$newname', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
                } else {
                    $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', tipe = '$tipe', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
                }
            } else {
                $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', tipe = '$tipe', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            }
            
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../index.php?i=admin&id=$id&m=s-2");
            } else {
                header("Location:../index.php?i=admin-edit&id=$id&m=d-3");
            }
        } else {
            header("Location:../index.php?i=admin-edit&id=$id&m=d-1");
        }
    } else {
        header("Location:../index.php?i=admin");
    }
} else {
    header("Location:../index.php?i=admin");
}

if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    $query_d = "DELETE FROM tbl_admin WHERE id = '$id'";
    $ret_d = mysqli_query($koneksi, $query_d);
    $jum_d = mysqli_affected_rows($koneksi);
    if ($jum_d > 0) {
        header("Location:../index.php?i=admin&m=s-3");
    } else {
        header("Location:../index.php?i=admin&m=d-4");
    }
} else {
    header("Location:../index.php?i=admin");
}
?>