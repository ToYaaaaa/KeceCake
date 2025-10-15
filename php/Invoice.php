<?php
  require "System/system.php";

  //get db
  $db = $auth->connectDb();

 //ambil id dari url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //ambil dta orders
    $stmtorders = $db->prepare("SELECT * FROM orders WHERE Order_id = :id");
    $stmtorders->bindParam(":id", $id, PDO::PARAM_INT);
    $stmtorders->execute();
    $orders = $stmtorders->fetch(PDO::FETCH_ASSOC);

    //ambil dta orders
    $stmtitemorders = $db->prepare("SELECT * FROM order_items WHERE Order_id = :id");
    $stmtitemorders->bindParam(":id", $id, PDO::PARAM_INT);
    $stmtitemorders->execute();
    $orderitem = $stmtitemorders->fetchAll(PDO::FETCH_ASSOC);
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

    <link rel="stylesheet" href="../css/Invoice.css" />
    <link rel="stylesheet" href="../css/Responsive/invoice.css">

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
  </head>
  <body>
    <!-- Navbar start -->
    <div class="navbar">
      <!-- left sec -->
      <a href="Afterloginindex.php">
        <div class="navbar-left"><span>Kece</span>Cake</div>
      </a>
      <!-- middle sec -->
      <div id="navlist" class="navbar-middle">
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
          <li>
            <a href="Shoppinghistory.php" class="btn-signup signup"
              ><i class="fa-regular fa-circle-user fa-xl"></i
            ></a>
          </li>
          <li>
            <div id="menu" class="menu"><i class="fa-solid fa-bars fa-2xl"></i><span></span></div>
          </li>
        </ul>
      </div>
    </div>
    <!-- Navbar end -->

    <!-- receipt start -->
    <div class="containerr">
      <div class="receipt">
        <div class="leftsec">
          <a href="Shoppinghistory.php"
            ><i
              class="fa-solid fa-circle-left fa-2xl"
              style="color: #000000"
            ></i
          ></a>
          <div class="containerproduct">
            <!--  -->
          <?php foreach($orderitem as $item): ?>
            <div class="product">
              <img src="<?= $item["Product_image"]?>" alt="" width="80px" />
              <div class="partsproduct">
                <p><?= $item["Product_category"]?></p>
                <p><?= $item["Product_name"]?></p>
              </div>
              <p>RP <?= number_format($item["Price"], 0, ",", ".")?></p>
              <div class="quantity">
                <h5>Total Item:</h5>
                <input type="text" value="<?= $item["Quantity"]?>" readonly />
              </div>
            </div>
          <?php endforeach; ?>
          <!--  -->
          </div>
        </div>

        <div class="rightsec">
          <h2>Receipt</h2>
          <div class="top">
            <img src="../image/icon_invoice.png" alt="" width="150px" />
            <h5>Payment <span><?= $orders["Order_status"]?></span></h5>
            <h5>Order Id: <?= $orders["Order_id"]?></h5>
          </div>
          <div class="status">
            <p>Status: <span><?= $orders["Order_status"]?></span></p>
            <p>Payment Time: <span><?= $orders["Transaction_time"]?></span></p>
            <p>Payment Method: <span><?= $orders["Payment_type"]?></span></p>
          </div>
          <div class="price">
            <p>Total Price: RP <span><?= number_format($orders["Total_price"], 0, ",", ".")?></span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- cart end -->

    <!-- Javascript -->
    <script src="../js/hamburger.js"></script>
    <!-- Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
