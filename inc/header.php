<?php
// session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sunday Bakery</title>
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400&display=swap" rel="stylesheet">
  <script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>

  <script type="text/javascript" src="jquery/jquery-3.6.1.min.js"></script>

</head>

<body>

  <!--Navbar-->
  <nav class="navbar navbar-expand-lg bg">
    <div id="nav" class="container-fluid">
      <a class="navbar-brand" href="index.php"><img class="logo1" src="img/logo3.png"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a style="color: #ff8000;" class="nav-link active" aria-current="page" href="index.php">HOME</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="about.php">ABOUT US</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">MENU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">EVENT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">YOUR CART</a>
          </li>
        </ul>
        <!---  Nơi này là chỗ search -->
        <div class="nav-function">
          <form class="nav-search" role="search" action="Search.php" method="GET">
            <a href="#">
              <input name="Search" placeholder="Search..." type="text">
              <i id="search-btn" class="material-icons">search</i>
              <input type="submit" value="" id="search-btn1"> 
            </a>
          </form>
          <form class="nav-icons">
            <?php
            if (isset($_SESSION['login'])) {
            ?>
              <a rel="external" href="userprofile.php"> <i class="material-icons person">person</i></a>
            <?php
            } else {
            ?>
              <a rel="external" href="login.php"> <i class="material-icons person">person</i></a>
            <?php
            }
            ?>
            <?php
            $number_cart = 0;
            if (isset($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $key => $value) {
                $number_cart++;
              }
            }
            ?>
            <a href="cart.php"> <i class="material-icons cart">shopping_cart</i>
              </a>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <!--End Navbar-->