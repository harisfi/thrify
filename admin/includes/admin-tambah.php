<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          <a href="index.php?i=admin">Admin</a>
        </div>
        <h2 class="page-title">
          Tambah Admin
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="index.php?i=admin" class="btn btn-warning d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <rect x="4" y="4" width="16" height="16" rx="2" />
              <path d="M10 10l4 4m0 -4l-4 4" />
            </svg>
            Batal
          </a>
          <a href="index.php?i=admin" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
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
              echo View::createAlert($alert[0], "Maaf, semua data harus diisi!");
              break;
            case 2:
              echo View::createAlert($alert[0], "Maaf, username sudah digunakan!");
              break;
            case 3:
              echo View::createAlert($alert[0], "Gagal menambahkan admin!");
              break;
            default:
              break;
          }
        }
        ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Admin</h3>
          </div>
          <div class="card-body">
            <form action="./handlers/admin.php" method="POST" enctype="multipart/form-data">
              <div class="form-group mb-3 ">
                <label class="form-label required">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama admin" required>
              </div>
              <div class="form-group mb-3 ">
                <label class="form-label required">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username admin" required pattern="[a-z][a-z0-9-_.]{4,20}" minlength="4">
              </div>
              <div class="form-group mb-3 ">
                <label class="form-label required">Password</label>
                <input type="password" name="pass" class="form-control" placeholder="Masukkan password admin" required minlength="8">
              </div>
              <div class="form-group mb-3 ">
                <label class="form-label required">Foto</label>
                <input type="file" name="foto" class="form-control" required>
              </div>
              <div class="form-group mb-3 ">
                <label class="form-label required">Role</label>
                <select class="form-select" name="tipe" required>
                  <option value="1" selected>Admin</option>
                  <option value="2">Superadmin</option>
                </select>
              </div>
              <div class="form-footer">
                <button type="submit" name="admin" value="tambah" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>