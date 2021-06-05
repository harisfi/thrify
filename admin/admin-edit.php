<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Edit Admin";
$pageSeq = 9;
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT nama, username, tipe FROM tbl_admin WHERE id = '$id'";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum > 0) {
    $data = mysqli_fetch_row($ret);
  } else {
    header("Location:./admin.php");
  }
} else {
  header("Location:./admin.php");
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
                  <a href="admin.php">Admin</a>
                </div>
                <h2 class="page-title">
                  Edit Admin
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="admin.php" class="btn btn-warning d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="2" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
                    Batal
                  </a>
                  <a href="admin.php" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
                    <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
	                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="2" /><path d="M10 10l4 4m0 -4l-4 4" /></svg>
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
                    echo View::createAlert($alert[0], "Maaf, tidak boleh ada data yang kosong!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Maaf, username sudah digunakan!");
                    break;
                  case 3:
                    echo View::createAlert($alert[0], "Gagal mengedit admin!");
                    break;
                  default:
                    break;
                }
              }
              ?>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Form Edit Admin</h3>
                  </div>
                  <div class="card-body">
                    <form action="./handlers/admin.php" method="POST" enctype="multipart/form-data">
                      <input type="text" name="id" value="<?= $id ?>" hidden>
                      <div class="form-group mb-3 ">
                        <label class="form-label required">Nama</label>
                        <div >
                          <input type="text" name="nama" value="<?= $data[0] ?>" class="form-control" placeholder="Masukkan nama admin" required>
                        </div>
                      </div>
                      <div class="form-group mb-3 ">
                        <label class="form-label required">Username</label>
                        <div >
                          <input type="text" name="username" value="<?= $data[1] ?>" class="form-control" placeholder="Masukkan username admin" required pattern="[a-z][a-z0-9-_.]{4,20}" minlength="4">
                        </div>
                      </div>
                      <div class="form-group mb-3 ">
                        <label class="form-label">Foto</label>
                        <div >
                          <input type="file" name="foto" class="form-control">
                        </div>
                      </div>
                      <div class="form-group mb-3 ">
                        <label class="form-label required">Role</label>
                        <div >
                          <select class="form-select" name="tipe" required>
                            <option value="1" <?= $data[2] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= $data[2] === 'superadmin' ? 'selected' : '' ?>>Superadmin</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-footer">
                        <button type="submit" name="admin" value="edit" class="btn btn-primary">Simpan</button>
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