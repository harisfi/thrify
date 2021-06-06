<?php
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT nama, deskripsi, harga, id_brand, id_kategori, id_diskon FROM tbl_produk WHERE id = '$id'";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum > 0) {
    $data = mysqli_fetch_row($ret);
  } else {
    header("Location:produk.php");
  }
} else {
  header("Location:produk.php");
}
?>

<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          <a href="index.php?i=produk">Produk</a>
        </div>
        <h2 class="page-title">
          Edit Produk
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="index.php?i=produk" class="btn btn-warning d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/square-x -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <rect x="4" y="4" width="16" height="16" rx="2" />
              <path d="M10 10l4 4m0 -4l-4 4" />
            </svg>
            Batal
          </a>
          <a href="index.php?i=produk" class="btn btn-warning d-sm-none btn-icon" aria-label="Batal">
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
              echo View::createAlert($alert[0], "Maaf, tidak boleh ada data yang kosong!");
              break;
            case 2:
              echo View::createAlert($alert[0], "Gagal mengedit produk!");
              break;
            case 3:
            case 4:
              echo View::createAlert($alert[0], "Gagal mengupload foto produk!");
              break;
            default:
              break;
          }
        }
        ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Form Edit Produk</h3>
          </div>
          <div class="card-body">
            <form action="./handlers/produk.php" method="POST" enctype="multipart/form-data">
              <input type="text" name="id" value="<?= $id ?>" hidden>
              <div class="form-group mb-3 ">
                <label class="form-label">Nama Produk</label>
                <div>
                  <input type="text" name="nama" value="<?= $data[0] ?>" class="form-control" placeholder="Masukkan nama produk">
                </div>
              </div>
              <div class="form-group mb-3 ">
                <label class="form-label">Deskripsi Produk</label>
                <div>
                  <textarea type="text" name="desc" class="form-control" placeholder="Masukkan deskripsi produk"><?= $data[1] ?></textarea>
                </div>
              </div>
              <div class="row g-2">
                <div class="col-6">
                  <div class="form-group mb-3 ">
                    <label class="form-label">Harga Produk</label>
                    <div>
                      <input type="number" name="harga" value="<?= $data[2] ?>" class="form-control" placeholder="Masukkan harga produk">
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group mb-3 ">
                    <label class="form-label">Brand Produk</label>
                    <div>
                      <select class="form-select" name="brand">
                        <?php
                        $query_b = "SELECT id, brand FROM tbl_brand_produk";
                        $ret_b = mysqli_query($koneksi, $query_b);
                        $jum_b = mysqli_num_rows($ret_b);
                        if ($jum_b > 0) {
                          while ($data_b = mysqli_fetch_row($ret_b)) {
                            $id_b = $data_b[0];
                            $brand = $data_b[1];
                            $select_b = $data[3] == $id_b ? " selected" : "";
                            echo "<option value='$id_b'$select_b>$brand</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group mb-3 ">
                    <label class="form-label">Kategori Produk</label>
                    <div>
                      <select class="form-select" name="kategori">
                        <?php
                        $query_k = "SELECT id, kategori FROM tbl_kategori_produk";
                        $ret_k = mysqli_query($koneksi, $query_k);
                        $jum_k = mysqli_num_rows($ret_k);
                        if ($jum_k > 0) {
                          while ($data_k = mysqli_fetch_row($ret_k)) {
                            $id_k = $data_k[0];
                            $kategori = $data_k[1];
                            $select_k = $data[4] == $id_k ? " selected" : "";
                            echo "<option value='$id_k'$select_k>$kategori</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group mb-3 ">
                    <label class="form-label">Diskon Produk</label>
                    <div>
                      <select class="form-select" name="diskon">
                        <?php
                        $query_d = "SELECT id, persen, nama FROM tbl_diskon_produk WHERE aktif = 1 ORDER BY persen ASC";
                        $ret_d = mysqli_query($koneksi, $query_d);
                        $jum_d = mysqli_num_rows($ret_d);
                        if ($jum_d > 0) {
                          while ($data_d = mysqli_fetch_row($ret_d)) {
                            $id_d = $data_d[0];
                            $diskon = $data_d[1] . " " . $data_d[2];
                            $select_d = $data[5] == $id_d ? " selected" : "";
                            echo "<option value='$id_d'$select_d>$diskon</option>";
                          }
                        }
                        ?>
                        <option value="0" <?= empty($data[5]) ? 'selected' : '' ?>>Tidak ada</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Foto Produk</label>
                <div class="mb-3">
                  <input type="file" name="foto[]" class="form-control" multiple>
                </div>
                <div class="row g-2">
                  <?php
                  $query_f = "SELECT id, foto, selected FROM tbl_foto_produk WHERE id_produk = '$id'";
                  $ret_f = mysqli_query($koneksi, $query_f);
                  $jum_f = mysqli_num_rows($ret_f);
                  if ($jum_f > 0) {
                    while ($data_f = mysqli_fetch_row($ret_f)) {
                  ?>
                      <div class="col-6 col-sm-3 col-md-2">
                        <label class="form-imagecheck mb-2">
                          <input name="fotos[]" type="checkbox" value="<?= $data_f[0] ?>" class="form-imagecheck-input" <?= $data_f[2] == 1 ? 'checked' : '' ?> />
                          <span class="form-imagecheck-figure">
                            <img src="./assets/images/products/<?= $data_f[1] ?>" alt="" class="form-imagecheck-image">
                          </span>
                        </label>
                      </div>
                  <?php }
                  } ?>
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" name="produk" value="edit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>