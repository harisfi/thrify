<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Kategori Produk";
$pageSeq = 2;
if (isset($_GET['search'])) {
  $search = $_GET['search'];
} else {
  $search = NULL;
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
                Data Master
              </div>
              <h2 class="page-title">
                Kategori Produk
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="kategoriproduk-tambah.php" class="btn btn-primary d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                  </svg>
                  Tambah Kategori Produk
                </a>
                <a href="kategoriproduk-tambah.php" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Kategori Produk">
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
                    echo View::createAlert($alert[0], "Berhasil menambah kategori produk!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Berhasil mengedit kategori produk!");
                    break;
                  case 3:
                    echo View::createAlert($alert[0], "Berhasil menghapus kategori produk!");
                    break;
                  case 4:
                    echo View::createAlert($alert[0], "Gagal menghapus kategori produk!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Kategori Produk</h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Search:
                      <form method="GET" class="ms-md-2 d-inline-block">
                        <input type="text" name="search" class="form-control form-control-sm" aria-label="Cari kategori" placeholder="Cari kategori" value="<?= $search ?>">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter datatable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>kategori Produk</th>
                        <th class="text-center text-md-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $query = "SELECT id, kategori FROM tbl_kategori_produk ";
                        if (!empty($search)) {
                          $query .= "WHERE kategori LIKE '%$search%' ";
                        }
                        $query .= "ORDER BY updated_at DESC";
                        $ret = mysqli_query($koneksi, $query);
                        $jum = mysqli_num_rows($ret);
                        if ($jum > 0) {
                          $no = 0;
                          while ($data = mysqli_fetch_row($ret)) {
                            $no++;
                            $id_kategori = $data[0];
                            $nama_kategori = $data[1];
                      ?>
                      <tr>
                        <td data-label="No."><span class="text-muted"><?= $no ?></span></td>
                        <td data-label="Kategori Produk"><a href="kategoriproduk-edit.php?id=<?= $id_kategori ?>" class="text-reset" tabindex="-1"><?= $nama_kategori ?></a></td>
                        <td data-label="Action">
                          <div class="btn-list justify-content-md-end flex-nowrap">
                            <a href="kategoriproduk-edit.php?id=<?= $id_kategori ?>" class="btn btn-outline-primary">
                              Edit
                            </a>
                            <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?= $nama_kategori ?>?'))window.location.href = './handlers/kategoriproduk.php?hapus=<?= $id_kategori ?>'" class="btn btn-outline-danger">
                              Hapus
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php }} ?>
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