<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Pesanan";
$pageSeq = 6;
if (isset($_GET['search'])) {
  $search = $_GET['search'];
} else {
  $search = NULL;
}

$batas = 8;
if (!isset($_GET['page'])) {
  $pos = 0;
  $page = 1;
} else {
  $page = $_GET['page'];
  $pos = ($page - 1) * $batas;
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
                Overview
              </div>
              <h2 class="page-title">
                Pesanan
              </h2>
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
                    echo View::createAlert($alert[0], "Berhasil mengedit status pesanan!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Gagal mengedit status pesanan!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pesanan</h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Search:
                      <form method="GET" class="ms-md-2 d-inline-block">
                        <input type="text" name="search" class="form-control form-control-sm" aria-label="Cari pesanan" placeholder="Cari pesanan" value="<?= $search ?>">
                      </form>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter datatable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>TRX ID</th>
                        <th>Nama User</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th class="text-center text-md-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT p.id, p.trx_id, u.nama, p.created_at, s.status, p.id_user FROM tbl_pesanan p, tbl_user u, tbl_status_pesanan s WHERE u.id = p.id_user AND s.id = p.id_status ";
                      if (!empty($search)) {
                        $query .= "AND (p.trx_id LIKE '%$search%' OR u.nama LIKE '%$search%') ";
                      }
                      $query .= "ORDER BY p.updated_at DESC";
                      $query_lim = $query . " LIMIT $pos, $batas";
                      $ret = mysqli_query($koneksi, $query_lim);
                      $jum = mysqli_num_rows($ret);
                      if ($jum > 0) {
                        $no = $pos + 1;
                        $total = 0;
                        while ($data = mysqli_fetch_row($ret)) {
                          $query_i = "SELECT p.harga, p.id_diskon FROM tbl_item_pesanan i, tbl_produk p WHERE i.id_pesanan = 1 AND p.id = i.id_produk";
                          $ret_i = mysqli_query($koneksi, $query_i);
                          $jum_i = mysqli_num_rows($ret_i);
                          $total = 0;
                          if ($jum_i > 0) {
                            while ($data_i = mysqli_fetch_row($ret_i)) {
                              $id_diskon = $data_i[1];

                              $query_d = "SELECT persen FROM tbl_diskon_produk WHERE id = '$id_diskon' AND aktif = 1";
                              $ret_d = mysqli_query($koneksi, $query_d);
                              $jum_d = mysqli_num_rows($ret_d);
                              if ($jum_d > 0) {
                                $data_d = mysqli_fetch_row($ret_d);
                                $persen = $data_d[0];
                              } else {
                                $persen = 0;
                              }
                              $subtotal = $data_i[0] - ($persen * $data_i[0] / 100);
                              $total += $subtotal;
                            }
                          }
                      ?>
                          <tr>
                            <td data-label="No."><span class="text-muted"><?= $no++ ?></span></td>
                            <!-- TVY[id user][id pesanan][unix time] -->
                            <td data-label="TRX ID"><a href="pesanan-detail.php?id=<?= $data[0] ?>" class="text-reset" tabindex="-1"><?= $data[1] ?></a></td>
                            <td data-label="Nama User"><a href="user-detail.php?id=<?= $data[5] ?>" class="text-reset" tabindex="-1"><?= $data[2] ?></td>
                            <td data-label="Created"><?= date_format(date_create($data[3]), "j F Y") ?></td>
                            <td data-label="Status"><?= $data[4] ?></td>
                            <td data-label="Total Harga">Rp.&nbsp;<?= number_format($total, 0, ',', '.') ?></td>
                            <td data-label="Action">
                              <div class="btn-list justify-content-md-end flex-nowrap">
                                <a href="pesanan-detail.php?id=<?= $data[0] ?>" class="btn btn-outline-success">
                                  Detail
                                </a>
                                <a href="pesanan-edit.php?id=<?= $data[0] ?>" class="btn btn-outline-primary">
                                  Edit
                                </a>
                              </div>
                            </td>
                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <?php include("./chunks/pagination.php") ?>
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