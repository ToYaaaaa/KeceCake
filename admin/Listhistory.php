<?php
require "../php/System/system.php";

//pakai function get orders

$listorder = $auth->getorders();

//pakai function edit orders
$auth->editorders();


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

    <link rel="stylesheet" href="../css/Admin/Listhistory.css" />

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

    <!-- List History start -->
    <div class="containerr">
      <div class="containerhistory">
        <h2>List History</h2>
        <div class="listhistory">
          <?php foreach($listorder as $hasillistorder): ?>
          <div class="history">
            <div class="status">
              <p><?= $hasillistorder["Customer_name"]?></p>
            </div>
            <div class="datecheckout">
              <p><?= $hasillistorder["Transaction_time"]?></p>
            </div>
            <div class="price">
              <p>Total Price: <span>RP <?= number_format($hasillistorder["Total_price"], 0, ",", ".")?></span></p>
            </div>
            <div class="button">
                  <form action="" method="post">
                <!-- pakai id dari tabel (auto increment) -->
                <input type="hidden" name="id" value="<?= $hasillistorder["id"]?>">
                <div class="input-group">
                  <select
                    class="form-select"
                    id="inputGroupSelect04"
                    aria-label="Example select with button addon"
                    name="category"
                  >
                    <option disabled selected><?= $hasillistorder["Order_status"]?></option>
                    <option value="settlement">Settlement</option>
                    <option value="pending">Pending</option>
                  </select>
                  <!-- kasih name="editstatus" biar ke-detect di PHP -->
                  <button class="btn btn-outline-secondary" type="submit" name="editstatus">
                    Save
                  </button>
                </div>
              </form>
              </div>
          </div>
          <?php endforeach;?>
          <!--  -->
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
