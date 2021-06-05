<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Users";
$pageSeq = 8;
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
                User
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
                    echo View::createAlert($alert[0], "Berhasil mengedit user!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Berhasil menghapus user!");
                    break;
                  case 3:
                    echo View::createAlert($alert[0], "Gagal menghapus user!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data User</h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Search:
                      <div class="ms-md-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search Admin">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table card-table table-vcenter datatable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>User</th>
                        <th>Total Pembelian</th>
                        <th>Verified</th>
                        <th class="text-center text-md-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT id, nama, email, foto, verified FROM tbl_user";
                      $ret = mysqli_query($koneksi, $query);
                      $jum = mysqli_num_rows($ret);
                      if ($jum > 0) {
                        $no = 0;
                        while ($data = mysqli_fetch_row($ret)) {
                          $no++;
                          $id_user = $data[0];
                          $nama_user = $data[1];
                          $email_user = $data[2];
                          $foto_user = $data[3];
                          $user_verified = $data[4];
                          $inisial = explode(" ", $nama_user);
                          if (sizeof($inisial) > 1) {
                            $inisial = $inisial[0][0] . $inisial[1][0];
                          } else {
                            $inisial = $inisial[0][0];
                          }
                      ?>
                          <tr>
                            <td data-label="No."><span class="text-muted"><?= $no ?></span></td>
                            <td data-label="User">
                              <div class="d-flex align-items-center py-1">
                                <span class="avatar me-2" <?= $foto_user != null ? "style='background-image: url(./assets/images/users/$foto_user);'" : "" ?>><?= $foto_user == null ? $inisial : '' ?></span>
                                <div class="flex-fill">
                                  <div class="font-weight-medium">
                                    <?= $nama_user ?>
                                  </div>
                                  <div class="text-muted">
                                    <?= $email_user ?>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              Rp. 123.456
                            </td>
                            <td>
                              <span class="badge bg-<?= $user_verified == 1 ? 'success' : 'danger' ?> me-1"></span>
                              <?= $user_verified == 1 ? 'True' : 'False' ?>
                            </td>
                            <td data-label="Action">
                              <div class="btn-list justify-content-md-end flex-nowrap">
                                <a href="user-detail.php?id=<?= $id_user ?>" class="btn btn-outline-success">
                                  Detail
                                </a>
                                <a href="user-edit.php?id=<?= $id_user ?>" class="btn btn-outline-primary">
                                  Edit
                                </a>
                                <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?= $nama_user ?>?'))window.location.href = './handlers/user.php?hapus=<?= $id_user ?>'" class="btn btn-outline-danger">
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