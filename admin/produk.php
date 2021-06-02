<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Produk";
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
                Overview
              </div>
              <h2 class="page-title">
                Produk
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="produk-tambah.php" class="btn btn-primary d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                  </svg>
                  Tambah Produk
                </a>
                <a href="produk-tambah.php" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Produk">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
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
                    echo View::createAlert($alert[0], "Berhasil menambah produk!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Berhasil mengedit produk!");
                    break;
                  case 3:
                    echo View::createAlert($alert[0], "Berhasil menghapus produk!");
                    break;
                  case 4:
                    echo View::createAlert($alert[0], "Gagal menghapus produk!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Produk</h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="ms-auto text-muted">
                      Search:
                      <div class="ms-md-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search product">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter table-mobile-md datatable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th class="text-center text-md-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT p.id, p.nama, p.harga, p.stok, b.brand, k.kategori, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id AND (deleted IS NULL OR deleted = 0) ORDER BY updated_at LIMIT 1) FROM tbl_produk p, tbl_brand_produk b, tbl_kategori_produk k WHERE b.id = p.id_brand AND k.id = p.id_kategori AND (p.deleted IS NULL OR p.deleted = 0) AND (b.deleted IS NULL OR b.deleted = 0) AND (k.deleted IS NULL OR k.deleted = 0)";
                      $ret = mysqli_query($koneksi, $query);
                      $jum = mysqli_num_rows($ret);
                      if ($jum > 0) {
                        $no = 0;
                        while ($data = mysqli_fetch_row($ret)) {
                          $no++;
                          $id_produk = $data[0];
                          $nama_produk = $data[1];
                          $harga_produk = number_format($data[2] , 0, ',', '.');
                          $stok_produk = $data[3];
                          $brand_produk = $data[4];
                          $kategori_produk = $data[5];
                          $foto_produk = $data[6];
                      ?>
                          <tr>
                            <td data-label="No."><span class="text-muted"><?= $no ?></span></td>
                            <td data-label="Produk">
                              <div class="d-flex align-items-center py-1">
                                <span class="avatar avatar-xl me-2" style="background-image: url(./assets/images/products/<?= $foto_produk ?>);"></span>
                                <div class="flex-fill">
                                  <div class="text-muted small"><?= $kategori_produk ?></div>
                                  <a href="produk-detail.php?id=<?= $id_produk ?>" class="font-weight-medium text-dark"><?= $nama_produk ?></a>
                                  <div class="d-flex my-1">
                                    <i class="fa-star fa-sm text-yellow fas active"></i>
                                    <i class="fa-star fa-sm text-yellow fas active"></i>
                                    <i class="fa-star fa-sm text-yellow fas active"></i>
                                    <i class="fa-star fa-sm text-yellow fas active"></i>
                                    <i class="fa-star fa-sm text-yellow far"></i>
                                  </div>
                                  <div class="text-muted small">Rp.<?= $harga_produk ?></div>
                                </div>
                              </div>
                            </td>
                            <td data-label="QTY"><?= $stok_produk ?></td>
                            <td data-label="Action">
                              <div class="btn-list justify-content-md-end flex-nowrap">
                                <a href="produk-detail.php?id=<?= $id_produk ?>" class="btn btn-outline-success">
                                  Detail
                                </a>
                                <a href="produk-edit.php?id=<?= $id_produk ?>" class="btn btn-outline-primary">
                                  Edit
                                </a>
                                <a href="#" class="btn btn-outline-danger">
                                  Hapus
                                </a>
                              </div>
                            </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                  <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                  <ul class="pagination m-0 ms-auto">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <polyline points="15 6 9 12 15 18" />
                        </svg>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <polyline points="9 6 15 12 9 18" />
                        </svg>
                      </a>
                    </li>
                  </ul>
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