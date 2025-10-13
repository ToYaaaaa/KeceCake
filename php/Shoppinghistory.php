<?php
require "System/system.php";

//ambil list order
$listorder = $auth->getorders();

//ambil delete function for orders
$auth->deleteorder();

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

    <link rel="stylesheet" href="../css/Shoppinghistory.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sacramento&display=swap"
      rel="stylesheet"
    />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../image/favicon.png" type="image/x-icon" />

    <!-- Icon -->
    <script
      src="https://kit.fontawesome.com/2fbd2eb978.js"
      crossorigin="anonymous"
    ></script>

    <!-- alpine -->
     <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
  </head>
  <body>
    <!-- Navbar start -->
    <div class="navbar">
      <!-- left sec -->
      <a href="Afterloginindex.php">
        <div class="navbar-left"><span>Kece</span>Cake</div>
      </a>
      <!-- middle sec -->
      <div class="navbar-middle">
        <ul>
          <a href="Afterloginindex.php#"><li>Home</li></a>
          <a href="Afterloginindex.php#aboutus"><li>About Us</li></a>
          <a href="Afterloginindex.php#ourproduct"><li>Our Product</li></a>
          <a href="Afterloginindex.php#contactus"><li>Contact Us</li></a>
        </ul>
      </div>
      <!-- right sec -->
      <div class="navbar-right">
        <ul>
          </li>
          <li>
            <a href="#" class="btn-signup"
              ><i class="fa-regular fa-circle-user fa-xl"></i
            ></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Navbar end -->

    <!-- History shopping start -->
    <div class="containerr">
      <div class="historyshopping">
        <h2>Shopping History</h2>
        <div class="containerproduct">
          <!--  -->
        <?php foreach($listorder as $hasillistorder): ?>
          <div class="product">
            <div class="status">
              <p><?= $hasillistorder["Order_status"]?></p>
            </div>
            <div class="Datecheckout">
              <p><?= $hasillistorder["Transaction_time"]?></p>
            </div>
            <div class="price">
              <p>Total Price: RP.<span><?= $hasillistorder["Total_price"]?></span></p>
            </div>
            <div class="button">
              <form action="" method="get">
                <a href="Invoice.php?id=<?= $hasillistorder["Order_id"] ?>" class="btn btn-primary">Details</a>
              </form>
              <form action="" method="post">
                <input type="hidden" name="order_id" value="<?= $hasillistorder["Order_id"] ?>">
                <button class="btn" name="deleteorders">
                  <i class="fa-solid fa-trash-can fa-xl"></i>
                </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
          <!--  -->
        </div>
      </div>
    </div>
    <!-- History shopping end -->

    <!-- Javascript -->
    <script src="../app/app.js"></script>
    <!-- Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
