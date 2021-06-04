<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Admin";
$pageSeq = 9;
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
                Admin
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="admin-tambah.php" class="btn btn-primary d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                  </svg>
                  Tambah Admin
                </a>
                <a href="admin-tambah.php" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Admin">
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
                    echo View::createAlert($alert[0], "Berhasil menambah admin!");
                    break;
                  case 2:
                    echo View::createAlert($alert[0], "Berhasil mengedit admin!");
                    break;
                  case 3:
                    echo View::createAlert($alert[0], "Berhasil menghapus admin!");
                    break;
                  case 4:
                    echo View::createAlert($alert[0], "Gagal menghapus admin!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Admin</h3>
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
                        <th>Admin</th>
                        <th>Role</th>
                        <th class="text-center text-md-end">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT id, nama, username, tipe, foto FROM tbl_admin WHERE deleted IS NULL OR deleted = 0";
                      $ret = mysqli_query($koneksi, $query);
                      $jum = mysqli_num_rows($ret);
                      if ($jum > 0) {
                        $no = 0;
                        while ($data = mysqli_fetch_row($ret)) {
                          $no++;
                          $foto_admin = $data[4];
                          $inisial = explode(" ", $data[1]);
                          if (sizeof($inisial) > 1) {
                            $inisial = $inisial[0][0] . $inisial[1][0];
                          } else {
                            $inisial = $inisial[0][0];
                          }
                      ?>
                          <tr>
                            <td data-label="No."><span class="text-muted"><?= $no ?></span></td>
                            <td data-label="Admin">
                              <div class="d-flex align-items-center py-1">
                                <span class="avatar me-2" <?= $foto_admin != null ? "style='background-image: url(./assets/images/admins/$foto_admin);'" : "" ?>><?= $foto_admin == null ? $inisial : '' ?></span>
                                <a href="./admin-detail.php?id=<?= $data[0] ?>" class="flex-fill text-reset">
                                  <div class="font-weight-medium">
                                    <?= $data[1] ?>
                                  </div>
                                  <div class="text-muted">
                                    <p class="mb-0">@<?= $data[2] ?></p>
                                  </div>
                                </a>
                              </div>
                            </td>
                            <td>
                              <span class="badge bg-<?= strtolower($data[3]) == 'admin' ? 'yellow' : 'red' ?> me-1"></span>
                              <?= ucfirst($data[3]) ?>
                            </td>
                            <td data-label="Action">
                              <div class="btn-list justify-content-md-end flex-nowrap">
                                <a href="admin-detail.php?id=<?= $data[0] ?>" class="btn btn-outline-success">
                                  Detail
                                </a>
                                <a href="admin-edit.php?id=<?= $data[0] ?>" class="btn btn-outline-primary">
                                  Edit
                                </a>
                                <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?= $data[1] ?>?'))window.location.href = './handlers/admin.php?hapus=<?= $data[0] ?>'" class="btn btn-outline-danger">
                                  Hapus
                                </a>
                              </div>
                            </td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
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