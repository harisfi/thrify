<?php
session_start();
include("../../koneksi/koneksi.php");
print_r($_POST);
if (isset($_POST['user']) && $_POST['user'] == "edit") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_a = mysqli_real_escape_string($koneksi, $_POST['id_a']);
    $id_p = mysqli_real_escape_string($koneksi, $_POST['id_p']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $alamat1 = mysqli_real_escape_string($koneksi, $_POST['alamat1']);
    $alamat2 = mysqli_real_escape_string($koneksi, $_POST['alamat2']);
    $prov = mysqli_real_escape_string($koneksi, $_POST['prov']);
    $kota = mysqli_real_escape_string($koneksi, $_POST['kota']);
    $kec = mysqli_real_escape_string($koneksi, $_POST['kec']);
    $kel = mysqli_real_escape_string($koneksi, $_POST['kel']);
    $kd_pos = mysqli_real_escape_string($koneksi, $_POST['kd_pos']);
    $provider = mysqli_real_escape_string($koneksi, $_POST['provider']);
    $no_rek = mysqli_real_escape_string($koneksi, $_POST['no_rek']);
    if (!empty($id) && !empty($id_a) && !empty($id_p) && !empty($nama) && !empty($tgl_lahir) && !empty($no_hp) && !empty($email) && !empty($status) && !empty($prov) && !empty($kota) && !empty($kec) && !empty($kel) && !empty($kd_pos) && !empty($provider) && !empty($no_rek)) {
        $status = $status == "on" ? "1" : "0";

        $query_u = "UPDATE tbl_user SET nama = '$nama', tanggal_lahir = '$tgl_lahir', no_hp = '$no_hp', email = '$email', verified = '$status', updated_at = current_timestamp() WHERE id = '$id'";
        $ret_u = mysqli_query($koneksi, $query_u);
        $jum_u = mysqli_affected_rows($koneksi);
        if ($jum_u > 0) {
            $query_a = "UPDATE tbl_alamat_user SET alamat1 = '$alamat1', alamat2 = '$alamat2', provinsi = '$prov', kota = '$kota', kecamatan = '$kec', kelurahan = '$kel', kode_pos = '$kd_pos', updated_at = current_timestamp() WHERE id = '$id_a'";
            $ret_a = mysqli_query($koneksi, $query_a);
            $jum_a = mysqli_affected_rows($koneksi);
            if ($jum_a > 0) {
                $query_p = "UPDATE tbl_pembayaran SET id_provider = '$provider', no_rek = '$no_rek', updated_at = current_timestamp() WHERE id = '$id_p'";
                $ret_p = mysqli_query($koneksi, $query_p);
                $jum_p = mysqli_affected_rows($koneksi);
                if ($jum_p > 0) {
                    header("Location:../index.php?i=user&m=s-1");
                } else {
                    header("Location:../index.php?i=user-edit&id=$id&m=d-4");
                }
            } else {
                header("Location:../index.php?i=user-edit&id=$id&m=d-3");
            }
        } else {
            header("Location:../index.php?i=user-edit&id=$id&m=d-2");
        }
    } else {
        header("Location:../index.php?i=user-edit&id=$id&m=d-1");
    }
}
?>