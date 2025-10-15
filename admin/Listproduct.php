<?php
// ambil file system
require "../php/System/system.php";

//pakai function show product
$listproduct = $auth->getproduct();

//pakai function edit product
$auth->editproduct();

//pakai function insert product untuk delete
$auth->insertproduct();

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

    <link rel="stylesheet" href="../css/Admin/listproduct.css" />

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
      <a href="Listuseraccount.php">
        <div class="navbar-left"><span>Kece</span>Cake</div>
      </a>
      <!-- middle sec -->
      <div class="navbar-middle">
        <ul>
          <a href="Listuseraccount.php"><li>list User Account</li></a>
          <a href="Listproduct.php"><li>List Product</li></a>
          <a href="Listhistory.php"><li>User Shopping History</li></a>
          <a href="Reportsale.php"><li>Report Sale</li></a>
        </ul>
      </div>
    </div>
    <!-- Navbar end -->

    <!-- List Product start -->
    <div class="containerr">
      <div class="containerproduct">
        <div class="top">
          <h2>List Product</h2>
          <a class="btn btn-primary" href="Addproduct.php">Add Product</a>
        </div>

        <div class="listproduct">
          <?php foreach($listproduct as $hasillistproduct): ?>
          <div class="product">
            <div class="image">
              <img src="<?= $hasillistproduct["Product_image"]?>" alt="" width="80px" />
            </div>
            <div class="cakename">
              <p><?= $hasillistproduct["Product_name"]?></p>
            </div>
            <div class="price">
              <p>Price: RP <span><?= number_format($hasillistproduct["Product_price"], 0, ",", ".")?></span></p>
            </div>
            <div class="button">
              <form action="" method="get">
                <a href="editproduct.php?id=<?= $hasillistproduct["Product_id"] ?>" class="btn btn-primary">Edit</a>
              </form>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $hasillistproduct["Product_id"] ?>">
                <button class="btn" name="deleteproduct">
                  <i class="fa-solid fa-trash-can fa-xl"></i>
                </button>
              </form>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- List Product end -->

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
