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

    <link rel="stylesheet" href="../css/Cart.css" />

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
      <div class="navbar-middle">
        <ul>
          <a href="Afterloginindex.php#"><li>Home</li></a>
          <a href="Afterloginindex.php#aboutus"><li>About Us</li></a>
          <a href="Afterloginindex.php#ourproduct"><li>Our Product</li></a>
          <a href="Afterloginindex.php#Contactus"><li>Contact Us</li></a>
        </ul>
      </div>
      <!-- right sec -->
      <div class="navbar-right">
        <ul>
          <li>
            <a href="#" class="btn btn-cart">
              <i
                class="fa-solid fa-cart-shopping fa-lg"
                style="color: #000000"
              ></i
            ></a>
          </li>
          <li>
            <a href="Shoppinghistory.php" class="btn-signup"
              ><i class="fa-regular fa-circle-user fa-xl"></i
            ></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Navbar end -->

    <!-- cart start -->
    <div class="containerr">
      <div class="cart">
        <div class="leftsec">
          <h2>Cart</h2>
          <!--  -->
          <div class="containerproduct">
            <div class="product">
              <img src="../image/dadar-gulung.png" alt="" width="80px" />
              <div class="partsproduct">
                <p>Kue Kering</p>
                <p>Dadar Gulung</p>
              </div>
              <div class="quantity">
                <button class="btn">+</button>
                <input type="text" value="1" readonly />
                <button class="btn">-</button>
              </div>
              <p>RP 3.500</p>
              <button class="btn">
                <i class="fa-solid fa-trash-can fa-xl"></i>
              </button>
            </div>
          </div>
          <!--  -->
        </div>
        <div class="rightsec">
          <h2>Payment</h2>
          <div class="form">
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
          </div>
          <div class="price">
            <p>Total Price: <span>RP 1.000.000</span></p>
          </div>
          <div class="checkout">
            <button class="btn btn-primary">Checkout</button>
          </div>
        </div>
      </div>
    </div>
    <!-- cart end -->

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
