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
                <form action="index.php?i=user" method="POST" class="ms-md-2 d-inline-block">
                  <input type="text" name="search" class="form-control form-control-sm" aria-label="Cari user" placeholder="Cari user" value="<?= $search ?>">
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter datatable">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>User</th>
                  <th>Verified</th>
                  <th class="text-center text-md-end">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT id, nama, email, foto, verified FROM tbl_user ";
                if (!empty($search)) {
                  $query .= "WHERE nama LIKE '%$search%' ";
                }
                $query .= "ORDER BY updated_at DESC";
                $query_lim = $query . " LIMIT $pos, $batas";
                $ret = mysqli_query($koneksi, $query_lim);
                $jum = mysqli_num_rows($ret);
                if ($jum > 0) {
                  $no = $pos + 1;
                  while ($data = mysqli_fetch_row($ret)) {
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
                      <td data-label="No."><span class="text-muted"><?= $no++ ?></span></td>
                      <td data-label="User">
                        <div class="d-flex align-items-center py-1">
                          <span class="avatar me-2" <?= $foto_user != null ? "style='background-image: url(./assets/images/users/$foto_user);'" : "" ?>><?= $foto_user == null ? $inisial : '' ?></span>
                          <a href="index.php?i=user-detail&id=<?= $id_user ?>" class="flex-fill text-reset">
                            <div class="font-weight-medium">
                              <?= $nama_user ?>
                            </div>
                            <div class="text-muted">
                              <?= $email_user ?>
                            </div>
                          </a>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-<?= $user_verified == 1 ? 'success' : 'danger' ?> me-1"></span>
                        <?= $user_verified == 1 ? 'True' : 'False' ?>
                      </td>
                      <td data-label="Action">
                        <div class="btn-list justify-content-md-end flex-nowrap">
                          <a href="index.php?i=user-detail&id=<?= $id_user ?>" class="btn btn-outline-success">
                            Detail
                          </a>
                          <a href="index.php?i=user-edit&id=<?= $id_user ?>" class="btn btn-outline-primary">
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
          <?php include("./chunks/pagination.php") ?>
        </div>
      </div>
    </div>
  </div>
</div>