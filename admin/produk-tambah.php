<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Tambah Produk";
$pageSeq = 7;
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
                <a href="produk.php">Produk</a>
              </div>
              <h2 class="page-title">
                Tambah Produk
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="produk.php" class="btn btn-warning d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="16" height="16" rx="2" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
                  </svg>
                  Batal
                </a>
                <a href="produk.php" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
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
                    echo View::createAlert($alert[0], "Semua data produk harus diisi!");
                    break;
                  case 2:
                  case 3:
                  case 4:
                    echo View::createAlert($alert[0], "Gagal menambah data produk!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Tambah Produk</h3>
                </div>
                <div class="card-body">
                  <form action="./handlers/produk.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3 ">
                      <label class="form-label required">Nama Produk</label>
                      <div>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama produk" required>
                      </div>
                    </div>
                    <div class="form-group mb-3 ">
                      <label class="form-label required">Deskripsi Produk</label>
                      <div>
                        <textarea type="text" name="desc" class="form-control" placeholder="Masukkan deskripsi produk" required></textarea>
                      </div>
                    </div>
                    <div class="row g-2">
                      <div class="col-6">
                        <div class="form-group mb-3 ">
                          <label class="form-label required">Harga Produk</label>
                          <div>
                            <input type="number" name="harga" class="form-control" placeholder="Masukkan harga produk" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group mb-3 ">
                          <label class="form-label required">Brand Produk</label>
                          <div>
                            <select class="form-select" name="brand" required>
                              <?php
                              $query_b = "SELECT id, brand FROM tbl_brand_produk";
                              $ret_b = mysqli_query($koneksi, $query_b);
                              $jum_b = mysqli_num_rows($ret_b);
                              if ($jum_b > 0) {
                                while ($data_b = mysqli_fetch_row($ret_b)) {
                                  $id_b = $data_b[0];
                                  $nama_b = $data_b[1];
                                  echo "<option value='$id_b'>$nama_b</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group mb-3 ">
                          <label class="form-label required">Kategori Produk</label>
                          <div>
                            <select class="form-select" name="kategori" required>
                              <?php
                              $query_k = "SELECT id, kategori FROM tbl_kategori_produk";
                              $ret_k = mysqli_query($koneksi, $query_k);
                              $jum_k = mysqli_num_rows($ret_k);
                              if ($jum_k > 0) {
                                while ($data_k = mysqli_fetch_row($ret_k)) {
                                  $id_k = $data_k[0];
                                  $nama_k = $data_k[1];
                                  echo "<option value='$id_k'>$nama_k</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group mb-3 ">
                          <label class="form-label">Diskon Produk</label>
                          <div>
                            <select class="form-select" name="diskon">
                              <option value="NULL">Tidak Ada</option>
                              <?php
                              $query_d = "SELECT id, nama, persen FROM tbl_diskon_produk";
                              $ret_d = mysqli_query($koneksi, $query_d);
                              $jum_d = mysqli_num_rows($ret_d);
                              if ($jum_d > 0) {
                                while ($data_d = mysqli_fetch_row($ret_d)) {
                                  $id_d = $data_d[0];
                                  $nama_d = $data_d[1];
                                  $persen_d = $data_d[2];
                                  echo "<option value='$id_d'>$persen_d% - $nama_d</option>";
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label required">Foto Produk</label>
                      <div>
                        <input type="file" name="foto[]" class="form-control" multiple required>
                      </div>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="produk" value="tambah" class="btn btn-primary">Simpan</button>
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