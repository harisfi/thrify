<?php
include("./koneksi/koneksi.php");
$query_k = "SELECT * FROM tbl_keranjang";
$ret_k = mysqli_query($koneksi, $query_k);
$jum_k = mysqli_num_rows($ret_k);
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
  <!-- Glidejs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css">

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./styles.css" />
  <title>Thrify | Ecommerce Website</title>
</head>

<body>

  <!-- Navigation -->
  <nav class="nav">
    <div class="wrapper container">
      <div class="logo"><a href="">THRIFY</a></div>
      <ul class="nav-list">
        <div class="top">
          <label for="" class="btn close-btn"><i class="fas fa-times"></i></label>
        </div>
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="account.php">Account</a></li>
        </li>
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
  <div class="hero">
    <div class="left">
      <h1>THRIFY</h1>
      <span>A Store Of Happiness</span>
      <small>Get All Your Second Stuff with Good Quality Here! </small>
      <a href="products.php">View Collection </a>
    </div>
    <div class="right">
      <img src="./images/hero.png" alt="" />
    </div>
  </div>

  <!-- Promotion -->

  <section class="section promotion">
    <div class="title">
      <h2>Shop Collections</h2>
      <span>Select from the premium product and save plenty money</span>
    </div>

    <div class="promotion-layout container">
    <div class="promotion-item">
        <img src="./images/promo1.jpg" alt="" />
        <div class="promotion-content">
          <h3>FOR MEN</h3>
          <a href="products.php?cat=for-men">SHOP NOW</a>
        </div>
      </div>

      <div class="promotion-item">
        <img src="./images/promo2.jpg" alt="" />
        <div class="promotion-content">
          <h3>CASUAL SHOES</h3>
          <a href="products.php?cat=shoes">SHOP NOW</a>
        </div>
      </div>

      <div class="promotion-item">
        <img src="./images/promo3.jpg" alt="" />
        <div class="promotion-content">
          <h3>FOR WOMEN</h3>
          <a href="products.php?cat=for-women">SHOP NOW</a>
        </div>
      </div>

      <div class="promotion-item">
        <img src="./images/promo4.jpg" alt="" />
        <div class="promotion-content">
          <h3>LEATHER BELTS</h3>
          <a href="products.php?cat=belts">SHOP NOW</a>
        </div>
      </div>

      <div class="promotion-item">
        <img src="./images/promo5.jpg" alt="" />
        <div class="promotion-content">
          <h3>DESIGNER BAGS</h3>
          <a href="products.php?cat=bags">SHOP NOW</a>
        </div>
      </div>

      <div class="promotion-item">
        <img src="./images/promo6.jpg" alt="" />
        <div class="promotion-content">
          <h3>WATCHES</h3>
          <a href="products.php?cat=watches">SHOP NOW</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Products -->
  <section class="section products">
    <div class="title">
      <h2>New Products</h2>
      <span>Select from the premium product brands and save plenty money</span>
    </div>
    <div class="product-layout">
      <?php
      $query_p2 = "SELECT p.id, p.nama, p.harga, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id AND selected = 1 ORDER BY updated_at LIMIT 1) FROM tbl_produk p ORDER BY updated_at DESC LIMIT 8";
      $ret_p2 = mysqli_query($koneksi, $query_p2);
      $jum_q2 = mysqli_num_rows($ret_p2);
      if ($jum_q2 > 0) {
        while ($data_q2 = mysqli_fetch_row($ret_p2)) {
          ?>
      <div class="product">
        <div class="img-container">
          <img src="./admin/assets/images/products/<?= $data_q2[3] ?>" alt="" />
          <div class="addCart">
            <i class="fas fa-shopping-cart"></i>
          </div>
        </div>
        <div class="bottom">
          <a href="product-details.php?id=<?= $data_q2[0] ?>"><?= $data_q2[1] ?></a>
          <div class="price">
            <span>Rp.<?= number_format($data_q2[2], 0, ',', '.') ?></span>
          </div>
        </div>
      </div>
          <?php
        }
      }
      ?>
    </div>
  </section>

  <!-- ADVERT -->
  <section class="section advert">
    <div class="advert-layout container">
      <div class="item ">
        <img src="./images/promo7.jpg" alt="">
        <div class="content left">
          <span>Exclusive Sales</span>
          <h3>Spring Collections</h3>
          <a href="products.php?cat=spring-collections">View Collection</a>
        </div>
      </div>
      <div class="item">
        <img src="./images/promo8.jpg" alt="">
        <div class="content  right">
          <span>New Trending</span>
          <h3>Designer Bags</h3>
          <a href="products.php?cat=bags">Shop Now </a>
        </div>
      </div>
    </div>
  </section>

  <!-- BRANDS -->
  <section class="section brands">
    <div class="title">
      <h2>Shop by Brand</h2>
      <span>Select from the premium product brands and save plenty money</span>
    </div>

    <div class="brand-layout container">
      <div class="glide" id="glide1">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li class="glide__slide">
              <img src="./images/brand1.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand2.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand3.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand4.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand5.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand6.png" alt="">
            </li>
            <li class="glide__slide">
              <img src="./images/brand7.png" alt="">
            </li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="about.html">About Us</a>
          <a href="contact.html">Contact Us</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="account.html">My Account</a>
          <a href="account.html#history">Order History</a>
        </div>
        <div class="footer-center">
          <h3>CONTACT US</h3>
          <div>
            <span>
              <i class="fas fa-map-marker-alt"></i>
            </span>
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

  <!-- Glidejs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>

  <!-- Custom Scripts -->
  <script src="./js/products.js"></script>
  <script src="./js/slider.js"></script>
  <script src="./js/index.js"></script>
</body>

</html>