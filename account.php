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

  <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/hero.png" width="100%">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>

                        <form id="LoginForm">
                            <input type="text" placeholder="Username">
                            <input type="passowrd" placeholder="Passowrd">
                            <button type="submit" class="btn">Login</button>
                            <a href="">Forgot passowrd</a>
                        </form>

                        <form id="RegForm">
                            <input type="text" placeholder="Username">
                            <input type="email" placeholder="Email">
                            <input type="passowrd" placeholder="Passowrd">
                            <button type="submit" class="btn">Register</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

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
<script>
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");

        function register() {
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        }

        function login() {
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }
    </script>
</body>
</html>

