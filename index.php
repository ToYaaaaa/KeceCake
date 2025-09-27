<?php
//connect to system php
require "php/System/system.php";
//session start
session_start();

//fetch product data
$listproduct = $auth->getproduct();

//fetch search category for product
$listsearch = $auth->searchproduct();

//cek if user have login or not 
  if(isset($_SESSION["User_id"])){
    header("location: php/Afterloginindex.php");
    exit;
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Title -->
    <title>KeceCake</title>

    <!-- Bootstrap/css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="css/Style.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sacramento&display=swap"
      rel="stylesheet"
    />

    <!-- Favicon -->
    <link rel="shortcut icon" href="image/favicon.png" type="image/x-icon" />

    <!-- Icon -->
    <script
      src="https://kit.fontawesome.com/2fbd2eb978.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="containerr">
      <!-- Navbar start -->
      <div class="navbar">
        <!-- left sec -->
        <a href="#">
          <div class="navbar-left"><span>Kece</span>Cake</div>
        </a>
        <!-- middle sec -->
        <div class="navbar-middle">
          <ul>
            <a href="#"><li>Home</li></a>
            <a href="#aboutus"><li>About Us</li></a>
            <a href="#ourproduct"><li>Our Product</li></a>
            <a href="#Contactus"><li>Contact Us</li></a>
          </ul>
        </div>
        <!-- right sec -->
        <div class="navbar-right">
          <ul>
            <li>
              <a href="/php/Cart.html" class="btn btn-cart disabled">
                <i
                  class="fa-solid fa-cart-shopping fa-lg"
                  style="color: #000000"
                ></i
              ></a>
            </li>
            <li>
              <a href="php/Login.php" class="btn btn-primary btn-signup"
                >Sign Up</a
              >
            </li>
          </ul>
        </div>
      </div>
      <!-- Navbar end -->

      <!-- Home start -->
      <div class="home" id="home">
        <div class="leftsec">
          <h1>
            Authentic Taste,<br />
            From The Archipelago
          </h1>
          <p>Discover Traditional Cakes for Your Special Moments.</p>
          <a href="#ourproduct">Our Product</a>
        </div>
        <div class="rightsec">
          <img src="image/Home.png" alt="Contoh Kue" width="200px" />
        </div>
      </div>
      <!-- Home end -->

      <!-- Tentang kami start -->
      <div class="aboutus" id="aboutus">
        <div class="leftsec">
          <img src="image/tentang kami.png" alt="Contoh Kue" width="200px" />
        </div>
        <div class="rightsec">
          <h1>About Us</h1>
          <p>
            We have been providing quality traditional cakes for your special
            events since 1880. We use premium ingredients and strictly select
            our cakes to ensure the quality of our traditional cakes.
          </p>
        </div>
      </div>
      <!-- Tentang kami end -->

      <!-- Produk kami start -->
      <div class="ourproduct" id="ourproduct">
        <h1>Our Product</h1>
        <form action="" method="post" class="topproduct">
          <div class="input-group">
            <button name="search" class="btn btn-outline-secondary" type="submit">Search</button>
            <select name="searchcategory" class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
              <option disabled selected>Category</option>
              <option value="kue kering">Kue Kering</option>
              <option value="kue basah">Kue Basah</option>
            </select>
          </div>
        </form>
        <div class="produk">
        <?php if(!isset($_POST["search"])): ?>
          <?php foreach($listproduct as $hasillistproduct): ?>
            <div class="menu">
              <img src="<?= $hasillistproduct["Product_image"] ?>" alt="" width="200px" />
              <h5><?= $hasillistproduct["Product_name"] ?></h5>
              <p><?= $hasillistproduct["Product_category"] ?></p>
              <p><?= $hasillistproduct["Product_price"] ?></p>
              <button type="submit" name="addtocart" class="btn btn-add disabled">Add</button>
            </div>
          <?php endforeach; ?>

          <?php elseif(isset($_POST["search"])):?>
            <?php foreach($listsearch as $hasillistsearch): ?>
              <div class="menu">
                <img src="<?= $hasillistsearch["Product_image"] ?>" alt="" width="200px" />
                <h5><?= $hasillistsearch["Product_name"] ?></h5>
                <p><?= $hasillistsearch["Product_category"] ?></p>
                <p><?= $hasillistsearch["Product_price"] ?></p>
                <button type="submit" name="addtocart" class="btn btn-add disabled">Add</button>
              </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
      </div>
      <!-- Produk kami end -->

      <!-- Kontak kami start -->
      <div class="Contactus" id="Contactus">
        <h1>Contact Us</h1>
        <h5>Criticis and suggestions are very useful for our shop😊</h5>
        <div class="formsection">
          <div class="leftsection">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1133.0586228458737!2d107.11065396802759!3d-6.255283789619446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6985ae9e9d0dff%3A0xcc3561e2fcc0845e!2sMilenia%20Square%20Metland%20Cibitung!5e1!3m2!1sid!2sid!4v1756192860009!5m2!1sid!2sid"
              width="300"
              height="250"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>

          <div class="rightsection">
            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Name"
              />
              <label for="name">Name:</label>
            </div>

            <div class="form-floating mb-2">
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="email"
              />
              <label for="email">Email:</label>
            </div>

            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="nomor"
                placeholder="number"
              />
              <label for="nomor">No.Telp:</label>
            </div>

            <div class="form-floating mb-2">
              <textarea
                class="form-control"
                placeholder="Leave The Critic and Suggestions Here"
                id="floatingTextarea"
              ></textarea>
              <label for="floatingTextarea">Message:</label>
            </div>
            <button type="button" class="btn btn-add">Send</button>
          </div>
        </div>
      </div>
      <!-- Kontak kami end -->

      <!-- Footer Start -->
      <div class="footer">
        <div class="top">
          <a href=""><i class="fa-brands fa-square-instagram fa-2xl"></i></a>
          <a href=""><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
          <a href=""><i class="fa-brands fa-square-x-twitter fa-2xl"></i></a>
        </div>

        <div class="bottom">
          <p>Created By <strong>Fariz Abdulfatah Sellomo</strong> &copy;2025</p>
        </div>
      </div>
      <!-- Footer end -->
    </div>

    <!-- Javascript -->
    <script src="js/Script.js"></script>
    <!-- Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
