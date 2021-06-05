<?php
include("../../koneksi/koneksi.php");
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    if (!empty($user)) {
        if (!empty($pass)) {
            $query = "SELECT id, nama, password, tipe, foto, username FROM tbl_admin WHERE username = '$user'";
            $ret = mysqli_query($koneksi, $query);
            $jum = mysqli_num_rows($ret);
            if ($jum > 0) {
                $data = mysqli_fetch_row($ret);
                if (password_verify($pass, $data[2])) {
                    session_start();
                    $_SESSION['id_admin'] = $data[0];
                    $_SESSION['nama_admin'] = $data[1];
                    $_SESSION['tipe_admin'] = $data[3];
                    $_SESSION['foto_admin'] = $data[4];
                    $_SESSION['uname_admin'] = $data[5];
                    header("Location:../index.php");
                } else {
                    header("Location:../login.php?error=D-3");
                }
            } else {
                header("Location:../login.php?error=D-3");
            }
        } else {
            header("Location:../login.php?error=D-2");
        }
    } else {
        header("Location:../login.php?error=D-1");
    }
    
}
?>