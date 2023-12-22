<?php
session_start(); 
include './DBConnect/DBConnect.php';
include './Functions.php';

$item_per_page = 12;  
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;  
$offset = ($current_page - 1) * $item_per_page;  

$SQL = "SELECT * FROM `products` WHERE `Pro_Type` = 'Signature Cake' LIMIT " . $item_per_page . " OFFSET " . $offset;
$Product = $con->query($SQL);

$SQL = "SELECT * FROM `products` WHERE `Pro_Type` = 'Event Cake' LIMIT " . $item_per_page . " OFFSET " . $offset;
    $eventPro = $con->query($SQL);
    

$total_records = mysqli_query($con, "SELECT * FROM `products` WHERE `Pro_Type` = 'Signature Cake'");
$totals = mysqli_num_rows($total_records);  
// var_dump($totals); exit;
$total_page = ceil($totals / $item_per_page);  

?>

<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<!--Bat dau san pham-->
<section id="product1" class="section-p1">

  <h2 class="">Signature Cake</h2>
  <p class="">Happiness is  with cake</p>
  <div class="pro-container">

    <?php
    while ($row = $Product->fetch_array()) {
    ?>
      <div class="pro" onclick="window.location.href='product-detail.php?id=<?= $row['Pro_ID'] ?>';">
        <img src="<?= $row['Pro_Img'] ?>"> 
        <div class="des">
          <span><?= $row['Pro_Type'] ?></span>
          <h5><?= $row['Pro_Name'] ?></h5>
        </div>
        <div class="cart">
          <h4><?= number_format($row['Pro_Price'], 0, ",", ".") ?></h4>
          <a href="#" onclick="window.location.href='product-detail.php?id=<?= $row['Pro_ID'] ?>';" class="cart-1"><i class="material-icons">shopping_cart</i></a>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
  <a href="products.php"><button class="view-btn">View More</button></a>
</section>
<!--Ket thuc san pham-->


<!--Bat dau banner-->

<section id="banner" class="section-m1">
  <h4>On Sale Christmas Event</h4>
  <h2>Up to 70% and its a pleasure to give you sale on Christmas day</h2>
  <a href="products.php"><button class="view-btn">Explore More</button></a>
</section>


<!--Ket thuc banner-->


<!--Bat dau banner-->


<section id="product1" class="section-p1">
  <h2 class="">On Sale Event Christmas</h2>
  <p class="">This event will never restock</p>
  <div class="pro-container">
  <?php
    while ($row = $eventPro->fetch_array()) {
    ?>
    <div class="pro" onclick="window.location.href='product-detail.php?id=<?= $row['Pro_ID'] ?>';">
      <img src="<?= $row['Pro_Img'] ?>" alt="" class="">
      <div class="des">
        <span><?= $row['Pro_Type'] ?></span>
        <h5><?= $row['Pro_Name'] ?></h5>
      </div>
      <div class="cart">
        <h4><?= number_format($row['Pro_Price'], 0, ",", ".") ?></h4>
        <a id="addcart" href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
      </div>
    </div> 
    <?php
    }
    ?>
  </div>
  </div>
  <a href="products.php"><button class="view-btn">View More</button></a>
</section>

  
<?php
include 'inc/footer.php';
?>