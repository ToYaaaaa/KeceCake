<?php
  require "../php/System/system.php";
  session_start();

  //cek if user have login or not 
  if(!isset($_SESSION["Admin_id"])){
    header("location: Loginadmin.php");
    exit;
  }

  //pakai function get user
  $listuser = $auth->getuser();

  //pakai function delete user
  $auth->deleteuser();
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

    <link rel="stylesheet" href="../css/Admin/Listuseraccount.css" />

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

    <!-- List User Account start -->
    <div class="containerr">
      <div class="listuseraccount">
        <h2>List User Account</h2>
        <div class="listuser">
          <!--  -->
        <?php foreach($listuser as $hasillistuser): ?>
          <div class="user">
            <div class="username">
              <p><?= $hasillistuser["Username"]?></p>
            </div>
            <div class="password">
              <p><?= $hasillistuser["Password"]?></p>
            </div>
            <div class="button">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $hasillistuser["User_id"]?>">
                <button type="submit" name="deleteuser" class="btn">
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
    <!-- List User Account end -->

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
