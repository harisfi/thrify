<?php
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT p.trx_id, u.nama, a.alamat1, a.alamat2, a.provinsi, a.kota, a.kecamatan, a.kelurahan, a.kode_pos, p.created_at, s.status, r.provider, p.bukti_pembayaran, u.id, u.foto FROM tbl_pesanan p, tbl_user u, tbl_alamat_user a, tbl_status_pesanan s, tbl_pembayaran b, tbl_provider r WHERE u.id = p.id_user AND a.id = u.id_alamat AND s.id = p.id_status AND b.id = u.id_pembayaran AND r.id = b.id_provider";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum <= 0) {
    header("Location:index.php?i=pesanan");
  } else {
    $data = mysqli_fetch_row($ret);
    $inisial = explode(" ", $data[1]);
    if (sizeof($inisial) > 1) {
      $inisial = $inisial[0][0] . $inisial[1][0];
    } else {
      $inisial = $inisial[0][0];
    }
  }
} else {
  header("Location:index.php?i=pesanan");
}
?>

<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <div class="page-pretitle">
          <a href="index.php?i=pesanan">Pesanan</a>
        </div>
        <h2 class="page-title">
          Detail Pesanan
        </h2>
      </div>
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a href="index.php?i=pesanan" class="btn btn-yellow d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
            Kembali
          </a>
          <a href="index.php?i=pesanan" class="btn btn-yellow d-sm-none btn-icon" aria-label="Kembali">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-back-up -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="card card-lg">
      <div class="card-body">
        <table class="table table-vcenter table-mobile pb-3">
          <tbody>
            <tr>
              <td data-label="TRX ID">
                <h1><?= $data[0] ?></h1>
              </td>
              <td data-label="User">
                <div class="d-flex align-items-center py-1">
                  <span class="avatar me-2" <?= $data[14] != null ? "style='background-image: url(./assets/images/users/$data[14]);'" : "" ?>><?= $data[14] == null ? $inisial : '' ?></span>
                  <a href="index.php?i=user-detail&id=<?= $data[13] ?>" class="h3 text-dark mb-0"><?= $data[1] ?></a>
                </div>
              </td>
              <td data-label="Alamat"><?= $data[7] . ', ' . $data[6] . ', ' . $data[5] . ', ' . $data[4] . ', ' . $data[8] . ' <br>(' . $data[2] . ' / ' . $data[3] . ')' ?></td>
              <td data-label="Tanggal Pemesanan"><?= date_format(date_create($data[9]), "j F Y") ?></td>
              <td data-label="Status"><?= $data[10] ?></td>
              <td data-label="Provider Pembayaran"><?= $data[11] ?></td>
              <td data-label="Bukti Pembayaran">
                <?php
                if (!empty($data[12])) {
                ?>
                  <img src="./assets/images/payments/<?= $data[12] ?>" alt="bukti_pembayaran" class="shadow">
                <?php
                } else {
                  echo "-";
                }
                ?>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="table table-transparent table-responsive">
          <thead>
            <tr>
              <th class="text-center" style="width: 1%"></th>
              <th>Produk</th>
              <th class="text-center" style="width: 1%">Qty</th>
              <th class="text-end" style="width: 1%">Unit</th>
              <th class="text-end" style="width: 1%">Diskon</th>
              <th class="text-end" style="width: 1%">Subtotal</th>
            </tr>
          </thead>
          <?php
          $query_i = "SELECT p.nama, k.kategori, p.harga, i.qty, i.id_produk, p.id_diskon, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id ORDER BY updated_at LIMIT 1) FROM tbl_item_pesanan i, tbl_produk p, tbl_kategori_produk k WHERE p.id = i.id_produk AND k.id = p.id_kategori";
          $ret_i = mysqli_query($koneksi, $query_i);
          $jum_i = mysqli_num_rows($ret_i);
          if ($jum_i > 0) {
            $no = 0;
            $total = 0;
            while ($data_i = mysqli_fetch_row($ret_i)) {
              $no++;
              $id_diskon = $data_i[5];
              $foto_produk = $data_i[6];
              if (!empty($id_diskon)) {
                $query_d = "SELECT persen FROM tbl_diskon_produk WHERE id = '$id_diskon' AND aktif = 1";
                $ret_d = mysqli_query($koneksi, $query_d);
                $jum_d = mysqli_num_rows($ret_d);
                if ($jum_d > 0) {
                  $data_d = mysqli_fetch_row($ret_d);
                  $persen = $data_d[0];
                } else {
                  $persen = 0;
                }
              } else {
                $persen = 0;
              }
          ?>
              <tr>
                <td class="text-center"><?= $no ?></td>
                <td>
                  <div class="d-flex align-items-center py-1">
                    <span class="avatar me-1" style="background-image: url(./assets/images/products/<?= $foto_produk ?>);"></span>
                    <a href="index.php?i=produk-detail&id=<?= $data_i[4] ?>" class="flex-fill">
                      <p class="strong text-dark mb-1"><?= $data_i[0] ?></p>
                      <div class="text-muted"><?= $data_i[1] ?></div>
                    </a>
                  </div>
                </td>
                <td class="text-center"><?= $data_i[3] ?></td>
                <td class="text-end">Rp.&nbsp;<?= number_format($data_i[2], 0, ',', '.') ?></td>
                <td class="text-end"><?= $persen ?>%</td>
                <?php
                $subtotal = $data_i[2] - ($persen * $data_i[2] / 100);
                $total += $subtotal;
                ?>
                <td class="text-end">Rp.&nbsp;<?= number_format($subtotal, 0, ',', '.') ?></td>
              </tr>
          <?php }
          } ?>
          <tr>
            <td colspan="5" class="strong text-end">Total</td>
            <td class="text-end">Rp.&nbsp;<?= number_format($total, 0, ',', '.') ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>