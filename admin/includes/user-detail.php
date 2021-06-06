<?php
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT u.nama, u.tanggal_lahir, u.no_hp, u.email, u.foto, u.verified, u.verified_at, a.alamat1, a.alamat2, a.provinsi, a.kota, a.kecamatan, a.kelurahan, a.kode_pos, r.provider, r.logo, p.no_rek FROM tbl_user u, tbl_alamat_user a, tbl_pembayaran p, tbl_provider r WHERE a.id = u.id_alamat AND p.id = u.id_pembayaran AND r.id = p.id_provider";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:index.php?i=user.php");
  } else {
    $data = mysqli_fetch_row($ret);
  }
} else {
  header("Location:index.php?i=user.php");
}
?>

<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          <a href="index.php?i=user">User</a>
        </div>
        <h2 class="page-title">
          Detail User
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="index.php?i=user" class="btn btn-yellow d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
            Kembali
          </a>
          <a href="index.php?i=user" class="btn btn-yellow d-sm-none btn-icon" aria-label="Kembali">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
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
            <h3 class="card-title">Detail User</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <?php
              if ($data[4] != null) {
              ?>
                <div class="col-12 col-md-4">
                  <img src="./assets/images/users/<?= $data[4] ?>" alt="">
                </div>
              <?php
              }
              ?>
              <div class="col">
                <table class="table table-vcenter table-mobile pb-3">
                  <tbody>
                    <tr>
                      <td data-label="Nama">
                        <p class="h2 mb-0"><?= $data[0] ?></p>
                      </td>
                      <td data-label="Tanggal Lahir">
                        <p class="mb-0"><?= date_format(date_create($data[1]),"j F Y") ?></p>
                      </td>
                      <td data-label="Nomor HP">
                        <p class="mb-0"><?= $data[2] ?></p>
                      </td>
                      <td data-label="Email">
                        <p class="mb-0"><?= $data[3] ?></p>
                      </td>
                      <td data-label="Verified">
                        <p class="mb-0"><span class="badge bg-<?= $data[5] == 1 ? 'success' : 'danger' ?> me-1"></span><?= $data[5] == 1 ? 'True' : 'False' ?></p>
                      </td>
                      <td data-label="Verified at">
                        <p class="mb-0"><?= $data[6] ?></p>
                      </td>
                    </tr>
                    <tr>
                      <td data-label="Alamat 1"><?= $data[7] == null ? '-' : $data[7] ?></td>
                      <td data-label="Alamat 2"><?= $data[8] == null ? '-' : $data[8] ?></td>
                      <td data-label="Provinsi"><?= $data[9] ?></td>
                      <td data-label="Kota/Kabupaten"><?= $data[10] ?></td>
                      <td data-label="Kecamatan/Distrik"><?= $data[11] ?></td>
                      <td data-label="Kelurahan/Desa"><?= $data[12] ?></td>
                      <td data-label="Kode Pos"><?= $data[13] ?></td>
                    </tr>
                    <tr>
                      <td data-label="Provider Pembayaran">
                        <div class="d-flex py-1 align-items-center">
                          <?php
                          if ($data[15] != null) {
                          ?>
                            <span class="payment payment-s me-2" style="background-image: url(./assets/images/providers/<?= $data[15] ?>)"></span>
                          <?php
                          }
                          ?>
                          <?= $data[14] ?>
                        </div>
                      </td>
                      <td data-label="No. Rekening"><?= $data[16] ?></td>
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