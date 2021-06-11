<?php
include("./koneksi/koneksi.php");
if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($koneksi, $_GET['id']);
  $query = "SELECT p.nama, p.deskripsi, p.harga, k.kategori FROM tbl_produk p, tbl_kategori_produk k WHERE p.id = '$id' AND k.id = p.id_kategori";
  $ret = mysqli_query($koneksi, $query);
  $jum = mysqli_num_rows($ret);
  if ($jum > 0) {
    $data = mysqli_fetch_row($ret);
  } else {
    header("Location:products.php");
  }
} else {
  header("Location:products.php");
}
if (isset($_SESSION['id_ruser'])) {
  $query_k = "SELECT * FROM tbl_keranjang";
  $ret_k = mysqli_query($koneksi, $query_k);
  $jum_k = mysqli_num_rows($ret_k);
} else {
  $jum_k = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/Logo.jpg" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./styles.css" />
  <title>Thrify | Ecommerce Website</title>
</head>

<body>

  <!-- Navigation -->
  <nav class="nav">
    <div class="wrapper container">
      <div class="logo">
        <a href=".">
          <img src="./admin/assets/images/logo-white.svg" width="110" height="32" alt="Thrify" style="filter: invert(1);">
        </a>
      </div>
      <ul class="nav-list">
        <div class="top">
          <label for="" class="btn close-btn"><i class="fas fa-times"></i></label>
        </div>
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="account.php">Account</a></li>
        <li>
          <!-- icons -->
        <li class="icons">
          <span>
            <a href="cart.php" style="padding: 0;">
              <img src="./images/shoppingBag.svg" alt="" />
              <small class="count d-flex"><?= $jum_k ?></small>
            </a>
          </span>
        </li>
      </ul>
      <label for="" class="btn open-btn"><i class="fas fa-bars"></i></label>
    </div>
  </nav>

  <!-- Product Details -->
  <section class="section product-detail">
    <div class="details container">
      <div class="left">
        <?php
        $query_f = "SELECT * FROM tbl_foto_produk WHERE id_produk = '$id' AND selected = 1";
        $ret_f = mysqli_query($koneksi, $query_f);
        $jum_f = mysqli_num_rows($ret_f);
        if ($jum_f > 0) {
          $i = 0;
          while ($data_f = mysqli_fetch_row($ret_f)) {
            if ($i == 0) {
        ?>
              <div class="main">
                <img src="./admin/assets/images/products/<?= $data_f[2] ?>" alt="" />
              </div>
              <div class="thumbnails">
              <?php
            } else {
              ?>
                <div class="thumbnail">
                  <img src="./admin/assets/images/products/<?= $data_f[2] ?>" alt="" />
                </div>
          <?php
            }
          }
        }
          ?>
              </div>
      </div>
      <div class="right">
        <span>Home/<?= $data[3] ?></span>
        <h1><?= $data[0] ?></h1>
        <div class="price">Rp.<?= number_format($data[2], 0, ',', '.') ?></div>

        <form class="form">
          <input type="text" value="<?= $id ?>" hidden />
          <?php
          if (!isset($_SESSION['id_ruser'])) {
            ?>
            <a href="javascript:alert('Silahkan masuk terlebih dahulu');location.href='./account.php'" class='addCart'>Add To Cart</a>
            <?php
          } else {
            echo "<a href='cart.php?add='".$id."' class='addCart'>Add To Cart</a>";
          }
          ?>
        </form>
        <h3>Product Detail</h3>
        <p>
          <?= $data[1] ?>
        </p>
      </div>
    </div>
  </section>

  <!-- Related Products -->

  <section class="section related-products">
    <div class="title">
      <h2>Related Products</h2>
      <span>Select from the premium product brands and save plenty money</span>
    </div>
    <div class="product-layout container">
      <?php
      $query_r = "SELECT p.id, p.nama, p.harga, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id AND selected = 1 ORDER BY updated_at LIMIT 1) FROM tbl_produk p ORDER BY p.updated_by ASC LIMIT 4";
      $ret_r = mysqli_query($koneksi, $query_r);
      $jum_r = mysqli_num_rows($ret_r);
      if ($jum_r > 0) {
        while ($data_r = mysqli_fetch_row($ret_r)) {
      ?>
          <div class="product">
            <div class="img-container">
              <img src="./admin/assets/images/products/<?= $data_r[3] ?>" alt="" />
              <div class="addCart">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
            <div class="bottom">
              <a href="product-details.php?id=<?= $data_r[0] ?>"><?= $data_r[1] ?></a>
              <div class="price">
                <span>Rp.<?= number_format($data_r[2], 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Contact Us</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a href="#">Order History</a>
        </div>
        <div class="footer-center">
          <h3>CONTACT US</h3>
          <div>
            <span>
              Perum Chandra Kartika, Kab Pasuruan, Jawa Timur, Indonesia
          </div>
          <div>
            <span>
              <i class="far fa-envelope"></i>
            </span>
            Thrify@gmail.com
          </div>
          <div>
            <span>
              <i class="fas fa-phone"></i>
            </span>
            082-143-456-789
          </div>
          <div class="payment-methods">
            <img src="./images/payment.png" alt="">
          </div>
        </div>
      </div>
    </div>
    </div>
  </footer>
  <!-- End Footer -->

  <!-- Custom Scripts -->
  <script src="./js/products.js"></script>
  <script src="./js/slider.js"></script>
  <script src="./js/index.js"></script>
</body>

</html>