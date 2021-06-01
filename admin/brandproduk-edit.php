<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Edit Brand Produk";
$pageSeq = 1;
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT brand FROM tbl_brand_produk WHERE id = '$id'";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:brandproduk.php");
  } else {
    $data = mysqli_fetch_row($ret);
  }
} else {
  header("Location:brandproduk.php");
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
                Data Master / <a href="brandproduk.php">Brand Produk</a>
              </div>
              <h2 class="page-title">
                Edit Brand Produk
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="brandproduk.php" class="btn btn-warning d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="16" height="16" rx="2" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
                  </svg>
                  Batal
                </a>
                <a href="brandproduk.php" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
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
                        echo View::createAlert($alert[0], "Nama brand produk harus diisi!");
                        break;
                    case 2:
                        echo View::createAlert($alert[0], "Gagal mengedit brand produk!");
                        break;
                    default:
                        break;
                  }
                }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Form Edit Brand Produk</h3>
                </div>
                <div class="card-body">
                  <form action="./handlers/brandproduk.php" method="POST">
                    <input name="id" value="<?= $id ?>" hidden>
                    <div class="form-group mb-3 ">
                      <label class="form-label required">Nama Brand Produk</label>
                      <div>
                        <input type="text" name="nama" value="<?= $data[0] ?>" class="form-control" placeholder="Masukkan nama brand produk" value="Carlson Limited" required>
                      </div>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="brand" value="edit" class="btn btn-primary">Simpan</button>
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