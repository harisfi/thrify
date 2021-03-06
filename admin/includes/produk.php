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
          <a href="index.php?i=produk-tambah" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <line x1="12" y1="5" x2="12" y2="19" />
              <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah Produk
          </a>
          <a href="index.php?i=produk-tambah" class="btn btn-primary d-sm-none btn-icon" aria-label="Tambah Produk">
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
              <div class="text-muted">
                Search:
                <form action="index.php?i=produk" method="POST" class="ms-md-2 d-inline-block">
                  <input type="text" name="search" class="form-control form-control-sm" aria-label="Cari produk" placeholder="Cari produk" value="<?= $search ?>">
                </form>
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
                $query = "SELECT p.id, p.nama, p.harga, p.stok, b.brand, k.kategori, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id AND selected = 1 ORDER BY updated_at LIMIT 1) FROM tbl_produk p, tbl_brand_produk b, tbl_kategori_produk k WHERE b.id = p.id_brand AND k.id = p.id_kategori ";
                if (!empty($search)) {
                  $query .= "AND p.nama LIKE '%$search%' ";
                }
                $query .= "ORDER BY p.updated_at DESC";
                $query_lim = $query . " LIMIT $pos, $batas";
                $ret = mysqli_query($koneksi, $query_lim);
                $jum = mysqli_num_rows($ret);
                if ($jum > 0) {
                  $no = $pos + 1;
                  while ($data = mysqli_fetch_row($ret)) {
                    $id_produk = $data[0];
                    $nama_produk = $data[1];
                    $harga_produk = number_format($data[2], 0, ',', '.');
                    $stok_produk = $data[3];
                    $brand_produk = $data[4];
                    $kategori_produk = $data[5];
                    $foto_produk = $data[6];

                    $inisial = explode(" ", $nama_produk);
                    if (sizeof($inisial) > 1) {
                      $inisial = $inisial[0][0] . $inisial[1][0];
                    } else {
                      $inisial = $inisial[0][0];
                    }
                ?>
                    <tr>
                      <td data-label="No."><span class="text-muted"><?= $no++ ?></span></td>
                      <td data-label="Produk">
                        <div class="d-flex align-items-center py-1">
                          <span class="avatar avatar-xl me-2" <?= $foto_produk != null ? "style='background-image: url(./assets/images/products/$foto_produk);'" : "" ?>><?= $foto_produk == null ? $inisial : '' ?></span>
                          <a href="index.php?i=produk-detail&id=<?= $id_produk ?>" class="flex-fill text-reset">
                            <div class="text-muted small"><?= $kategori_produk ?></div>
                            <div class="font-weight-medium"><?= $nama_produk ?></div>
                            <div class="text-muted small">Rp.<?= $harga_produk ?></div>
                          </a>
                        </div>
                      </td>
                      <td data-label="QTY"><?= $stok_produk ?></td>
                      <td data-label="Action">
                        <div class="btn-list justify-content-md-end flex-nowrap">
                          <a href="index.php?i=produk-detail&id=<?= $id_produk ?>" class="btn btn-outline-success">
                            Detail
                          </a>
                          <a href="index.php?i=produk-edit&id=<?= $id_produk ?>" class="btn btn-outline-primary">
                            Edit
                          </a>
                          <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?= $nama_produk ?>?'))window.location.href = './handlers/produk.php?hapus=<?= $id_produk ?>'" class="btn btn-outline-danger">
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