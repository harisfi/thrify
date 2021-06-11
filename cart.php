<?php
include("./koneksi/koneksi.php");
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />

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
            <label for="" class="btn close-btn"
              ><i class="fas fa-times"></i
            ></label>
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

    <?php
    if (!isset($_SESSION['id_ruser'])) {
      echo "<script>alert('Silahkan masuk terlebih dahulu');location.href='./account.php'</script>";
    }
    ?>
    <!-- Cart Items -->
    <div class="container cart">
      <table>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
        <tr>
          <td>
            <div class="cart-info">
              <img src="./images/product1.jpg" alt="" />
              <div>
                <p>Bambi Print Mini Backpack</p>
                <span>Price: $500.00</span>
                <br />
                <a href="#">remove</a>
              </div>
            </div>
          </td>
          <td><input type="number" value="1" min="1" /></td>
          <td>$50.00</td>
        </tr>
      </table>

      <div class="total-price">
        <table>
          <tr>
            <td>Total</td>
            <td>$250</td>
          </tr>
        </table>
        <a href="#" class="checkout btn">Proceed To Checkout</a>
      </div>
    </div>

     <!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>EXTRAS</h3>
          <a href="#">Brands</a>
          <a href="#">Gift Certificates</a>
          <a href="#">Affiliate</a>
          <a href="#">Specials</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a href="#">Order History</a>
          <a href="#">Wish List</a>
          <a href="#">Newsletter</a>
          <a href="#">Returns</a>
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
