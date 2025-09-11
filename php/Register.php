


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

    <link rel="stylesheet" href="../css/Register.css" />

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
    <!-- register start -->
    <div class="containerr">
      <div class="register">
        <a href="Afterloginindex.html" class="backbutton"
          ><i class="fa-solid fa-circle-left fa-2xl" style="color: #000000"></i
        ></a>
        <h1>register</h1>
        <div class="form">
          <div class="form-floating mb-2">
            <input
              type="text"
              class="form-control"
              id="username"
              placeholder="username"
            />
            <label for="username">Username:</label>
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
              type="password"
              class="form-control"
              id="password"
              placeholder="password"
            />
            <label for="password">Password:</label>
          </div>
        </div>
        <div class="text">
          <p>Have an Account ? Click <a href="Login.php">Here</a></p>
        </div>
        <button class="btn btn-primary">Login</button>
      </div>
    </div>
    <!-- register end -->

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
