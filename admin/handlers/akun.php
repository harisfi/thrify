<?php
session_start();
include("../../koneksi/koneksi.php");
include("../classes/Utils.php");
if (isset($_POST['akun'])) {
    $nama_admin = $_SESSION['nama_admin'];
    if ($_POST['akun'] == "edit") {
        $id = mysqli_real_escape_string($koneksi, $_POST['id']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $pass1 = mysqli_real_escape_string($koneksi, $_POST['pass1']);
        $pass2 = mysqli_real_escape_string($koneksi, $_POST['pass2']);
        if (!empty($id) && !empty($nama) && !empty($username)) {
            $query_u = "SELECT id FROM tbl_admin WHERE username = '$username'";
            $ret_u = mysqli_query($koneksi, $query_u);
            $jum_u = mysqli_num_rows($ret_u);
            if ($jum_u > 1) {
                header("Location:../akun-edit.php?m=d-2");
            } else if ($jum_u == 1) {
                $data_u = mysqli_fetch_row($ret_u);
                if ($data_u[0] == $id) {
                    goto cek_pass;
                } else {
                    header("Location:../akun-edit.php?m=d-2");
                    die;
                }
            } else {
                goto cek_pass;
            }

            cek_pass:
            if (!empty($pass1) || !empty($pass2)) {
                if (!empty($pass1) && !empty($pass2)) {
                    $query_p = "SELECT password FROM tbl_admin WHERE id = '$id'";
                    $ret_p = mysqli_query($koneksi, $query_p);
                    $data_p = mysqli_fetch_row($ret_p);
                    if (password_verify($pass2, $data_p[0])) {
                        goto up;
                    } else {
                        header("Location:../akun-edit.php?m=d-4");
                        die;
                    }
                } else {
                    header("Location:../akun-edit.php?m=d-3");
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
                    $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', foto = '$newname', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
                } else {
                    $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
                }
            } else {
                $query = "UPDATE tbl_admin SET nama = '$nama', username = '$username', updated_at = current_timestamp(), updated_by = '$nama_admin' WHERE id = '$id'";
            }
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_affected_rows($koneksi);
            if ($jum > 0) {
                header("Location:../akun.php?id=$id&m=s-1");
            } else {
                header("Location:../akun-edit.php?id=$id&m=d-5");
            }
        } else {
            header("Location:../akun-edit.php?m=d-1");
        }
    } else {
        header("Location:../akun.php");
    }
} else {
    header("Location:../akun.php");
}
