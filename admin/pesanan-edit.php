<?php
session_start();
include("../koneksi/koneksi.php");
$pageTitle = "Edit Pesanan";
$pageSeq = 6;
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT id_status FROM tbl_pesanan p";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:pesanan.php");
  } else {
    $data = mysqli_fetch_row($ret);
  }
} else {
  header("Location:pesanan.php");
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
                <a href="pesanan.php">Pesanan</a>
              </div>
              <h2 class="page-title">
                Edit Pesanan
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="pesanan.php" class="btn btn-yellow d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                  </svg>
                  Kembali
                </a>
                <a href="pesanan.php" class="btn btn-yellow d-sm-none btn-icon" aria-label="Kembali">
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
                  <h3 class="card-title">Form Edit Pesanan</h3>
                </div>
                <div class="card-body">
                  <form action="./handlers/pesanan.php" method="POST">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <div class="form-group mb-3">
                      <label class="form-label">Status</label>
                      <div>
                        <select class="form-select" name="status">
                          <?php
                          $query_s = "SELECT id, status FROM tbl_status_pesanan";
                          $ret_s = mysqli_query($koneksi, $query_s);
                          $jum_s = mysqli_num_rows($ret_s);
                          if ($jum_s > 0) {
                            while ($data_s = mysqli_fetch_row($ret_s)) {
                              $id_s = $data_s[0];
                              $status = $data_s[1];
                              $selected = $data[0] == $data_s[0] ? " selected" : "";
                              echo "<option value='$id_s'$selected>$status</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="pesanan" value="edit" class="btn btn-primary">Simpan</button>
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