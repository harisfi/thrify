<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Detail User";
$pageSeq = 8;
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT u.nama, u.tanggal_lahir, u.no_hp, u.email, u.verified, a.alamat1, a.alamat2, a.provinsi, a.kota, a.kecamatan, a.kelurahan, a.kode_pos, r.provider, p.no_rek, u.id_alamat, u.id_pembayaran FROM tbl_user u, tbl_alamat_user a, tbl_pembayaran p, tbl_provider r WHERE a.id = u.id_alamat AND p.id = u.id_pembayaran AND r.id = p.id_provider";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:user.php");
  } else {
    $data = mysqli_fetch_row($ret);
  }
} else {
  header("Location:user.php");
}
?>
<!doctype html>
<html lang="en">
<?php include("./chunks/head.php") ?>

<body class="antialiased">
  <div class="wrapper">
    <?php include("./chunks/sidebar.php") ?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- Page title -->
        <div class="page-header d-print-none">
          <div class="row align-items-center">
            <div class="col">
              <div class="page-pretitle">
                <a href="user.php">User</a>
              </div>
              <h2 class="page-title">
                Edit User
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="user.php" class="btn btn-warning d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="16" height="16" rx="2" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
                  </svg>
                  Batal
                </a>
                <a href="user.php" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
                  <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="16" height="16" rx="2" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
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
            <?php
              if (isset($_GET['m'])) {
                $alert = explode("-", $_GET['m']);
                switch ($alert[1]) {
                  case 1:
                    echo View::createAlert($alert[0], "Tidak boleh ada data yang kosong!");
                    break;
                  case 2:
                  case 3:
                  case 4:
                    echo View::createAlert($alert[0], "Gagal mengedit user!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Edit User</h3>
                </div>
                <div class="card-body">
                  <form action="./handlers/user.php" method="POST">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <input type="text" name="id_a" value="<?= $data[14] ?>" hidden>
                    <input type="text" name="id_p" value="<?= $data[15] ?>" hidden>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Nama</label>
                      <div>
                        <input type="text" name="nama" value="<?= $data[0] ?>" class="form-control" placeholder="Masukkan nama user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Tanggal Lahir</label>
                      <div>
                        <input type="text" name="tgl_lahir" value="<?= $data[1] ?>" class="form-control" data-mask="0000-00-00" data-mask-visible="true" placeholder="0000-00-00" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Nomor HP</label>
                      <div>
                        <input type="number" name="no_hp" value="<?= $data[2] ?>" class="form-control" placeholder="Masukkan nomor hp user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Email</label>
                      <div>
                        <input type="email" name="email" value="<?= $data[3] ?>" class="form-control" placeholder="Masukkan email user">
                      </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-check form-switch">
                        <input type="checkbox" name="status" class="form-check-input" <?= $data[4] == 1 ? 'checked' : '' ?>>
                        <span class="form-check-label">Verified</span>
                      </label>
                    </div>
                    <hr>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Alamat 1</label>
                      <div>
                        <input type="text" name="alamat1" value="<?= $data[5] ?>" class="form-control" placeholder="Masukkan alamat 1 user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Alamat 2</label>
                      <div>
                        <input type="text" name="alamat2" value="<?= $data[6] ?>" class="form-control" placeholder="Masukkan alamat 2 user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Provinsi</label>
                      <div>
                        <input type="text" name="prov" value="<?= $data[7] ?>" class="form-control" placeholder="Masukkan provinsi user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Kota/Kabupaten</label>
                      <div>
                        <input type="text" name="kota" value="<?= $data[8] ?>" class="form-control" placeholder="Masukkan kota/kabupaten user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Kecamatan/Distrik</label>
                      <div>
                        <input type="text" name="kec" value="<?= $data[9] ?>" class="form-control" placeholder="Masukkan kecamatan/kistrik user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Kelurahan/Desa</label>
                      <div>
                        <input type="text" name="kel" value="<?= $data[10] ?>" class="form-control" placeholder="Masukkan kelurahan/desa user">
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Kode Pos</label>
                      <div>
                        <input type="text" name="kd_pos" value="<?= $data[11] ?>" class="form-control" placeholder="Masukkan kode pos user">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3 ">
                      <label class="form-label">Provider Pembayaran User</label>
                      <div>
                        <select class="form-select" name="provider">
                          <?php
                          $query_p = "SELECT id, provider FROM tbl_provider";
                          $ret_p = mysqli_query($koneksi, $query_p);
                          $jum_p = mysqli_num_rows($ret_p);
                          if ($jum_p > 0) {
                            while ($data_p = mysqli_fetch_row($ret_p)) {
                              $id_p = $data_p[0];
                              $nama_p = $data_p[1];
                              echo "<option value='$id_p'>$nama_p</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label">No. Rekening</label>
                      <div>
                        <input type="text" name="no_rek" value="<?= $data[13] ?>" class="form-control" placeholder="Masukkan no. rekening user">
                      </div>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="user" value="edit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include("./chunks/footer.php") ?>
    </div>
  </div>
  <!-- Libs JS -->
  <!-- Tabler Core -->
  <script src="./dist/js/tabler.min.js"></script>
</body>

</html>