<?php
include("./koneksi/koneksi.php");
$query_k = "SELECT * FROM tbl_keranjang";
$ret_k = mysqli_query($koneksi, $query_k);
$jum_k = mysqli_num_rows($ret_k);
$batas = 15;
if (!isset($_GET['page'])) {
    $pos = 0;
    $page = 1;
} else {
    $page = $_GET['page'];
    $pos = ($page - 1) * $batas;
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

  <!-- PRODUCTS -->

  <section class="section products">
    <div class="products-layout container">
    <div class="col-1-of-4">
        <div>
          <div class="block-title">
            <h3></h3>
          </div>

          <ul class="block-content">
            <li>
              <label for="">
                <span></span>
                <small></small>
              </label>
            </li>

            <li>
              <label for="">
                <span></span>
                <small></small>
              </label>
            </li>

            <li>
              <label for="">
                <span> </span>
                <small></small>
              </label>
            </li>

            <li>
              <label for="">
                <span></span>
                <small></small>
              </label>
            </li>
          </ul>
        </div>

        <div>
          <div class="block-title">
            <h3></h3>
          </div>

          <ul class="block-content">
            <li>

            <li>
              <label for="">
                <span></span>
                <small></small>
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-3-of-4">
        <form action="">
          <div class="item">
            <label for="cat">Category</label>
            <select name="cat" id="cat">
              <option selected="selected" disabled>--Select--</option>
              <?php
              $query_c = "SELECT k.kategori, count(p.id) FROM tbl_kategori_produk k, tbl_produk p WHERE p.id_kategori = k.id";
              $ret_c = mysqli_query($koneksi, $query_c);
              $jum_c = mysqli_num_rows($ret_c);
              if ($ret_c > 0) {
                while ($data_c = mysqli_fetch_row($ret_c)) {
                  ?>
              <option value="<?= $data_c[0] ?>"><?= $data_c[0].'('.$data_c[1].')' ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="item">
            <label for="brand">Brands</label>
            <select name="brand" id="brand">
              <option selected="selected" disabled>--Select--</option>
              <?php
              $query_b = "SELECT b.brand, count(p.id) FROM tbl_brand_produk b, tbl_produk p WHERE p.id_brand = b.id";
              $ret_b = mysqli_query($koneksi, $query_b);
              $jum_b = mysqli_num_rows($ret_b);
              if ($jum_b > 0) {
                while ($data_b = mysqli_fetch_row($ret_b)) {
                  ?>
              <option value="<?= $data_b[0] ?>"><?= $data_b[0].'('.$data_b[1].')' ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="item">
            <label for="sort">Sort By</label>
            <select name="sort" id="sort">
              <option selected="selected" disabled>--Select--</option>
              <option value="nama">Name</option>
              <option value="harga">Price</option>
              <option value="updated_at">Newness</option>
            </select>
          </div>
          <button type="submit">Apply</button>
        </form>

        <div class="product-layout">
          <?php
          if (isset($_GET['cat'])) {
            $str = str_replace("-", " ", $_GET['cat']);
            $query_gc = "SELECT id FROM tbl_kategori_produk WHERE kategori LIKE '%$str%'";
            $ret_gc = mysqli_query($koneksi, $query_gc);
            $jum_gc = mysqli_num_rows($ret_gc);
            if ($jum_gc > 0) {
              $cat = mysqli_fetch_row($ret_gc)[0];
            } else {
              $cat = null;
            }
          } else {
            $cat = null;
          }

          if (isset($_GET['brand'])) {
            $str = str_replace("-", " ", $_GET['brand']);
            $query_gc = "SELECT id FROM tbl_brand_produk WHERE brand LIKE '%$str%'";
            $ret_gc = mysqli_query($koneksi, $query_gc);
            $jum_gc = mysqli_num_rows($ret_gc);
            if ($jum_gc > 0) {
              $brand = mysqli_fetch_row($ret_gc)[0];
            } else {
              $brand = null;
            }
          } else {
            $brand = null;
          }

          $sort = $_GET['sort'] ?? null;

          $query_p = "SELECT p.id, p.nama, p.harga, (SELECT foto FROM tbl_foto_produk WHERE id_produk = p.id AND selected = 1 ORDER BY updated_at LIMIT 1) FROM tbl_produk p ";
          if (!empty($cat) && !empty($brand)) {
            $query_p .= "WHERE p.id_kategori = '$cat' OR p.id_brand = '$brand' ";
          } else {
            if (!empty($cat)) {
              $query_p .= "WHERE p.id_kategori = '$cat' ";
            } else if (!empty($brand)) {
              $query_p .= "WHERE p.id_brand = '$brand' ";
            }
          }
          if (!empty($sort)) {
            $query_p .= "ORDER BY p.$sort ASC ";
          }
          $query_lim = $query_p . "LIMIT $pos, $batas";
          $ret_p = mysqli_query($koneksi, $query_lim);
          $jum_p = mysqli_num_rows($ret_p);
          if ($jum_p > 0) {
            while ($data_p = mysqli_fetch_row($ret_p)) {
              ?>
          <div class="product">
            <div class="img-container">
              <img src="./admin/assets/images/products/<?= $data_p[3] ?>" alt="" />
              <div class="addCart">
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
            <div class="bottom">
              <a href="product-details.php?id=<?= $data_p[0] ?>"><?= $data_p[1] ?></a>
              <div class="price">
                <span>Rp.<?= number_format($data_p[2], 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
              <?php
            }
          }
          ?>
        </div>

        <!-- PAGINATION -->
        <?php
        $ret_pg = mysqli_query($koneksi, $query_p);
        $jum_dt = mysqli_num_rows($ret_pg);
        $jum_pg = ceil($jum_dt / $batas);
        $catpg = !empty($cat) ? "cat=$cat&" : "";
        $brandpg = !empty($brand) ? "brand=$brand&" : "";
        ?>
        <ul class="pagination">
          <?php
          if ($jum_pg == 1) {
            echo "<span>1</span>";
          } else if ($jum_pg > 1) {
            $prev = $page - 1;
            $next = $page + 1;

            if ($page != 1) {
              echo "<a href='products.php?".$catpg.$brandpg."page=1'><span class='last'>&laquo; First</span></a>";
              echo "<a href='products.php?".$catpg.$brandpg."page=".$prev."'><span class='icon'>&laquo;</span></a>";
            }

            for ($i=1; $i <= $jum_pg; $i++) { 
              echo "<a href='products.php?".$catpg.$brandpg."page=".$i."'><span>".$i."</span></a>";
            }

            if ($page != $jum_pg) {
              echo "<a href='products.php?".$catpg.$brandpg."page=".$next."'><span class='icon'>&raquo;</span></a>";
              echo "<a href='products.php?".$catpg.$brandpg."page=".$jum_pg."'><span class='last'>Last &raquo;</span></a>";
            }
          }
          ?>
        </ul>
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

  <!-- Custom Scripts -->
  <script src="./js/products.js"></script>
  <script src="./js/slider.js"></script>
  <script src="./js/index.js"></script>
</body>

</html>