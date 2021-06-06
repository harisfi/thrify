<?php
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT nama, username, foto, tipe FROM tbl_admin WHERE id = '$id'";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum > 0) {
    $data = mysqli_fetch_row($ret);
    $foto_admin = $data[2];
    $inisial = explode(" ", $data[0]);
    if (sizeof($inisial) > 1) {
      $inisial = $inisial[0][0] . $inisial[1][0];
    } else {
      $inisial = $inisial[0][0];
    }
  } else {
    header("Location:./index.php?i=admin");
  }
} else {
  header("Location:./index.php?i=admin");
}
?>

<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          <a href="index.php?i=admin">Admin</a>
        </div>
        <h2 class="page-title">
          Detail Admin
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="index.php?i=admin" class="btn btn-yellow d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
            Kembali
          </a>
          <a href="index.php?i=admin" class="btn btn-yellow d-sm-none btn-icon" aria-label="Kembali">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Detail Admin</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                <span class="avatar avatar-xl me-2" <?= $foto_admin != null ? "style='background-image: url(./assets/images/admins/$foto_admin);'" : "" ?>><?= $foto_admin == null ? $inisial : '' ?></span>
              </div>
              <div class="col">
                <table class="table table-vcenter table-mobile pb-3">
                  <tbody>
                    <tr>
                      <td data-label="Nama">
                        <p class="h2 mb-0"><?= $data[0] ?></p>
                      </td>
                      <td data-label="Username">
                        <p class="mb-0">@<?= $data[1] ?></p>
                      </td>
                      <td data-label="Tipe">
                        <p class="mb-0"><?= ucfirst($data[3]) ?></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>