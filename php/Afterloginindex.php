<?php
//connect to system php
require "System/system.php";
//session start
session_start();

//fetch product data
$listproduct = $auth->getproduct();

//fetch search category for product 
$listsearch = $auth->searchproduct();

//cek if user have login or not 
  if(!isset($_SESSION["User_id"])){
    header("location: ../index.php");
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

    <link rel="stylesheet" href="../css/Style.css" />

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

    <!-- alphine js -->
      
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <!-- midtrans -->
    <!-- <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="Mid-client-cUXAP7ft154vIEAm"></script> -->
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
        <div class="navbar-right" x-data>
          <ul>
            <li>
              <a href="#" id="btncart" class="btn btn-cart">
                <i
                  class="fa-solid fa-cart-shopping fa-lg"
                  style="color: #000000"
                ></i>
              <span class="quantity-badge" x-show="$store.cart.quantitytotal" x-text="$store.cart.quantitytotal"></span>
            </a>
            </li>
            <li>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-regular fa-circle-user fa-xl"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="Shoppinghistory.php">Shopping History</a></li>
                  <li><a class="dropdown-item" href="Logoutuser.php">Log Out</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <!-- Navbar end -->

      <!-- Cart Start -->
        <div class="cart" id="cart" x-data>
          <div class="containerproduct">
            <template x-for="p in $store.cart.items" :key="p.Product_id">
              <div class="product">
              <img :src="p.Product_image" alt="" width="40px" style="border-radius: 10px;"/>
              <div class="partsproduct">
                <p x-text="p.Product_category"></p>
                <p x-text="p.Product_name"></p>
              </div>
              <div class="quantity">
                <button class="btn" @click="$store.cart.add(p)">+</button>
                <input type="text" :value="p.qty" readonly />
                <button class="btn" @click="$store.cart.min(p)">-</button>
              </div>
              <p x-text="rupiah(p.Product_price * p.qty)"></p>
              <button class="btn" @click="$store.cart.delete(p)">
                <i class="fa-solid fa-trash-can fa-sm"></i>
              </button>
              </div>
            </template>
          </div>
          <!-- form payment -->
          <div class="form">
            <form action="" id="form" >
              <input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
              <input type="hidden" name="total" x-model="$store.cart.totalprice">

              <div class="name">
                <label for="name">Name:</label>
                <input type="text" autocomplete="off" name="name" id="name">
              </div>

              <div class="name">
                <label for="email">Email:</label>
                <input type="text" autocomplete="off" name="email" id="email">
              </div>

              <div class="name">
                <label for="telephone">No.Telephone:</label>
                <input type="number" autocomplete="off" name="telephone" id="telephone">
              </div>
            </div>

            <!-- btn checkout -->
            <div class="checkout">
              <button class="button" type="submit" value="checkout" id="button">Checkout</button>
            </div>
          </form>

            <!-- price -->
            <div class="price">
              <p>Total Price: <span x-text="rupiah($store.cart.totalprice)">/span></p>
            </div>
          <!--  -->
        </div>
      <!-- Cart End -->

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
          <img id="imagehome" src="../image/Home.png" alt="Contoh Kue" width="300px" />
        </div>
      </div>
      <!-- Home end -->

      <!-- Tentang kami start -->
      <div class="aboutus" id="aboutus">
        <div class="leftsec">
          <img id="imageabout" src="../image/tentang kami.png" alt="Contoh Kue" width="300px" />
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
      <div class="ourproduct" id="ourproduct" x-data="products">
        <h1>Our Product</h1>
        <form action="" method="post" class="topproduct">
          <div class="input-group">
            <select class="form-select" id="inputGroupSelect03" @change="loadProducts($event.target.value)">
              <option value="all">All</option>
              <option value="kue basah">Kue Basah</option>
              <option value="kue kering">Kue Kering</option>
            </select>
          </div>
        </form>
        <div class="produk">
          <template x-for="p in items" :key="p.Product_id">
            <div class="menu">
              <img  :src="p.Product_image" alt="" width="200px" />
              <h5 x-text="p.Product_name"></h5>
              <p x-text="p.Product_category"></p>
              <p x-text="rupiah(p.Product_price)"></p>
              <a href="#" @click.prevent="$store.cart.add(p)" name="addtocart" class="btn btn-add">Add</a>
            </div>
          </template>
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
                required
              />
              <label for="name">Name:</label>
            </div>

            <div class="form-floating mb-2">
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="email"
                required
              />
              <label for="email">Email:</label>
            </div>

            <div class="form-floating mb-2">
              <input
                type="text"
                class="form-control"
                id="nomor"
                placeholder="number"
                required
              />
              <label for="nomor">No.Telp:</label>
            </div>

            <div class="form-floating mb-2">
              <textarea
                class="form-control"
                placeholder="Leave The Critic and Suggestions Here"
                id="floatingTextarea"
                required
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
    <script src="../app/app.js"></script>
    <script src="../js/Script.js"></script>
    <!-- Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
