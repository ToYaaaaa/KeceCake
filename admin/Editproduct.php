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

    <link rel="stylesheet" href="../css/Admin/Editproduct.css" />

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
      <a href="Listakunuser.html">
        <div class="navbar-left"><span>Kece</span>Cake</div>
      </a>
      <!-- middle sec -->
      <div class="navbar-middle">
        <ul>
          <a href="Listakunuser.html"><li>list User Account</li></a>
          <a href="Listproduct.html"><li>List Product</li></a>
          <a href="Listriwayat.html"><li>User Shopping History</li></a>
          <a href="Reportsale.html"><li>Report Sale</li></a>
        </ul>
      </div>
    </div>
    <!-- Navbar end -->

    <!-- Add product start -->
    <div class="containerr">
      <div class="addproduct">
        <div class="top">
          <a href="Listproduct.html"
            ><i
              class="fa-solid fa-circle-left fa-2xl"
              style="color: #000000"
            ></i
          ></a>
          <h2>Add Product</h2>
        </div>
        <div class="formadd">
          <div class="input-group mb-3">
            <label class="input-group-text dropdown" for="inputGroupSelect01"
              >Category</label
            >
            <select class="form-select" id="inputGroupSelect01">
              <option selected>Choose...</option>
              <option value="1">Kue Kering</option>
              <option value="2">Kue Basah</option>
            </select>
          </div>

          <div class="form-floating mb-2">
            <input
              type="text"
              class="form-control"
              id="Productname"
              placeholder="Product Name"
            />
            <label for="Productname" class="label">Product Name:</label>
          </div>

          <div class="form-floating mb-2" class="label">
            <input
              type="text"
              class="form-control"
              id="imageproduct"
              placeholder="Image product"
            />
            <label for="imageproduct" class="label">Image Product:</label>
          </div>

          <div class="form-floating mb-2">
            <input
              type="text"
              class="form-control"
              id="price"
              placeholder="price"
            />
            <label for="price" class="label">Price:</label>
          </div>
        </div>
        <div class="addbtn">
          <button class="btn btn-primary">Add Product</button>
        </div>
      </div>
    </div>
    <!-- Add product end -->

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
