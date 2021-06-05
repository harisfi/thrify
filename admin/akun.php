<?php
session_start();
include("../koneksi/koneksi.php");
include("./classes/View.php");
$pageTitle = "Akun";
$pageSeq = 10;

$foto_admin = $_SESSION['foto_admin'];
$inisial = explode(" ", $_SESSION['nama_admin']);
if (sizeof($inisial) > 1) {
  $inisial = $inisial[0][0] . $inisial[1][0];
} else {
  $inisial = $inisial[0][0];
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
                Akun
              </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">
                <a href="akun-edit.php" class="btn btn-primary d-none d-sm-inline-block">
                  <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                  </svg>
                  Edit Akun
                </a>
                <a href="akun-edit.php" class="btn btn-primary d-sm-none btn-icon" aria-label="Edit Akun">
                  <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
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
                    echo View::createAlert($alert[0], "Berhasil mengedit akun!");
                    break;
                  default:
                    break;
                }
              }
              ?>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Akun</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-auto">
                      <span class="avatar avatar-xl me-2" <?= $foto_admin != null ? "style='background-image: url(./assets/images/admins/$foto_admin);'" : "" ?>><?= $foto_admin == null ? $inisial : '' ?></span>
                    </div>
                    <div class="col">
                      <table class="table table-vcenter table-mobile pb-3">
                        <tbody>
                          <tr>
                            <td data-label="Nama">
                              <p class="h2 mb-0"><?= $_SESSION['nama_admin'] ?></p>
                            </td>
                            <td data-label="Username">
                              <p class="mb-0">@<?= $_SESSION['uname_admin'] ?></p>
                            </td>
                            <td data-label="Tipe">
                              <p class="mb-0"><?= ucfirst($_SESSION['tipe_admin']) ?></p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
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