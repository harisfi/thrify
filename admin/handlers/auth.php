<?php
if (empty($_SESSION['id_admin']) || empty($_SESSION['nama_admin']) || empty($_SESSION['tipe_admin']) || empty($_SESSION['foto_admin']) || empty($_SESSION['uname_admin'])) {
    signout($incl);
} else {
    if (($incl == "admin" || $incl == "admin-tambah" || $incl == "admin-edit" || $incl == "admin-detail") && strtolower($_SESSION['tipe_admin']) == "admin" || $incl == "login") {
        header("Location:index.php");
    }
}

if (strtolower($incl) == "signout") {
    signout($incl);
}

function signout($x) {
    session_unset();
    session_destroy();
    if ($x != "login") {
        header("Location:index.php?i=login");
    }
}
?>