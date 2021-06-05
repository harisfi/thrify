<?php
session_start();
include("../koneksi/koneksi.php");
$pageTitle = "Detail Produk";
$pageSeq = 7;
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT * FROM tbl_produk WHERE id = '$id'";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:produk.php");
  } else {
    $data = mysqli_fetch_row($ret);
    $query_f = "SELECT foto FROM tbl_foto_produk WHERE id_produk = '$id' AND selected = 1";
    $ret_f = mysqli_query($koneksi, $query_f);
    $jum_f = mysqli_num_rows($ret_f);
  }
} else {
  header("Location:produk.php");
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
                <a href="produk.php">Produk</a>
              </div>
              <h2 class="page-title">
                Detail Produk
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="produk.php" class="btn btn-yellow d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                  </svg>
                  Kembali
                </a>
                <a href="produk.php" class="btn btn-yellow d-sm-none btn-icon" aria-label="Kembali">
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
          <div class="card card-lg">
            <div class="card-body">
              <table class="table table-vcenter table-mobile pb-3">
                <tbody>
                  <tr>
                    <?php if ($jum_f > 0) { ?>
                      <td data-label="Foto Produk">
                        <div class="row g-3">
                          <?php
                          while ($data_f = mysqli_fetch_row($ret_f)) {
                          ?>
                            <div class="col-6 col-sm-3 col-md-2">
                              <img class="border" src="./assets/images/products/<?= $data_f[0] ?>" alt="">
                            </div>
                          <?php } ?>
                        </div>
                      </td>
                    <?php } ?>
                    <td data-label="Nama Produk">
                      <h1 class="mb-0"><?= $data[1] ?></h1>
                    </td>
                    <td data-label="Harga">
                      <p class="h2 mb-0">Rp. <?= number_format($data[3], 0, ',', '.') ?></p>
                    </td>
                    <td data-label="Deskripsi">
                      <p class="mb-0"><?= $data[2] ?></p>
                    </td>
                    <?php
                    $id_brand = $data[5];
                    $query_b = "SELECT brand FROM tbl_brand_produk WHERE id = '$id_brand'";
                    $ret_b = mysqli_query($koneksi, $query_b);
                    $jum_b = mysqli_num_rows($ret_b);
                    if ($jum_b > 0) {
                      $data_b = mysqli_fetch_row($ret_b);
                    } else {
                      $data_b[0] = "-";
                    }
                    ?>
                    <td data-label="Brand">
                      <p class="mb-0"><?= $data_b[0] ?></p>
                    </td>
                    <?php
                    $id_kategori = $data[6];
                    $query_k = "SELECT kategori FROM tbl_kategori_produk WHERE id = '$id_kategori'";
                    $ret_k = mysqli_query($koneksi, $query_k);
                    $jum_k = mysqli_num_rows($ret_k);
                    if ($jum_k > 0) {
                      $data_k = mysqli_fetch_row($ret_k);
                    } else {
                      $data_k[0] = "-";
                    }
                    ?>
                    <td data-label="Kategori">
                      <p class="mb-0"><?= $data_k[0] ?></p>
                    </td>
                    <?php
                    $id_diskon = $data[7];
                    $query_d = "SELECT nama, persen, aktif FROM tbl_diskon_produk WHERE id = '$id_diskon'";
                    $ret_d = mysqli_query($koneksi, $query_d);
                    $jum_d = mysqli_num_rows($ret_d);
                    if ($jum_d > 0) {
                      $data_d = mysqli_fetch_row($ret_d);
                    } else {
                      $data_d = array_fill(0, 3, "-");
                    }
                    ?>
                    <td data-label="Diskon">
                      <span class="badge bg-<?= ($data_d[0] == "-" || $data_d[2] == null || $data_d[2] == 0) ? 'danger' : 'success' ?> me-1"></span>
                      <?= $data_d[0] == "-" ? "-" : ($data_d[0] . " - " . $data_d[1] . "%") ?>
                    </td>
                    <td data-label="Stok">
                      <p class="mb-0"><?= $data[4] ?></p>
                    </td>
                    <?php
                    $inisial = explode(" ", $data[9]);
                    if (sizeof($inisial) > 1) {
                      $inisial = $inisial[0][0] . $inisial[1][0];
                    } else {
                      $inisial = $inisial[0][0];
                    }
                    ?>
                    <td data-label="Uploader">
                      <div class="d-flex align-items-center py-1">
                        <span class="avatar me-2"><?= $inisial ?></span>
                        <div class="flex-fill">
                          <p class="font-weight-medium text-dark mb-0"><?= $data[9] ?></p>
                          <p class="text-muted small mb-0"><?= $data[8] ?></p>
                        </div>
                      </div>
                    </td>
                    <?php
                    $inisial = explode(" ", $data[11]);
                    if (sizeof($inisial) > 1) {
                      $inisial = $inisial[0][0] . $inisial[1][0];
                    } else {
                      $inisial = $inisial[0][0];
                    }
                    ?>
                    <td data-label="Last Modified">
                      <div class="d-flex align-items-center py-1">
                        <span class="avatar me-2"><?= $inisial ?></span>
                        <div class="flex-fill">
                          <p class="font-weight-medium text-dark mb-0"><?= $data[11] ?></p>
                          <p class="text-muted small mb-0"><?= $data[10] ?></p>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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