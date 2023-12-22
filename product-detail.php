<?php
session_start();
// session_destroy();
include './DBConnect/DBConnect.php';
include 'Functions.php';

$id = !empty($_GET['id']) ? $_GET['id'] : 1;
$Acc_ID = isset($_SESSION['login']['Acc_ID']) ? $_SESSION['login']['Acc_ID'] : 0;

$QUERY = "SELECT * FROM `products` WHERE `Pro_ID` = " . $id;
$result = $con->query($QUERY);
$Product = $result->fetch_array();
 

$sessionKey = 'post_' . $id;
if (!isset($_SESSION["$sessionKey"])) {
  $_SESSION["$sessionKey"] = 1; //set giá trị cho session
  $con->query("UPDATE `products` SET `Pro_View` = `Pro_View` + 1 WHERE `Pro_ID` = " . $id);
}

$relate_product = 4; // Số sản phẩm muốn hiển thị
$QRY = "SELECT * FROM `products` ORDER BY RAND() LIMIT " . $relate_product;
$Relate_product = $con->query($QRY);
?>
<?php
include 'inc/header.php';
?>


<!--Bat dau new p-d-->
<section id="product-detail" class="section-p1">
  <div class="single-pro-image">
    <img src="<?= $Product['Pro_Img'] ?>" width="100%" id="MainImg" alt="">
  </div>
  <div class="product-content">
    <h1><?= $Product['Pro_Name']; ?></h1>
    <h2><?= $Product['Pro_Price']; ?></h2> 
    <div class="quantitynumb">
      <div class="wrapper">
        </span><input type="number" id="number" value="1" min="1" max="50">
      </div>
    </div>
    <button id="addcart" class="view-btn btn modal-btn">Add To Cart</button>
    <h4>Details</h4>
    <span> <?= $Product['Pro_Info']; ?></span>
  </div>
  <div>

  </div>
</section>

<section id="product1" class="section-p1">
  <h2 class="">On Sale Event Christmas</h2>
  <p class="">This event will never restock</p>
  <div class="pro-container">

    <div class="pro">
      <img src="img/cake1.webp" alt="" class="">
      <div class="des">
        <span>Christmas Collection (List)</span>
        <h5>Chocolate Pancake</h5>
      </div>
      <div class="cart">
        <h4>315.000</h4>
        <a href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
      </div>
    </div>
    <div class="pro">
      <img src="img/cake2.webp" alt="" class="">
      <div class="des">
        <span>Christmas Collection (List)</span>
        <h5>Chocolate Pancake</h5>
      </div>
      <div class="cart">
        <h4>315.000</h4>
        <a href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
      </div>
    </div>

    <div class="pro">
      <img src="img/cake3.webp" alt="" class="">
      <div class="des">
        <span>Christmas Collection (List)</span>
        <h5>Chocolate Pancake</h5>
      </div>
      <div class="cart">
        <h4>315.000</h4>
        <a href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
      </div>
    </div>

    <div class="pro">
      <img src="img/cake4.webp" alt="" class="">
      <div class="des">
        <span>Christmas Collection (List)</span>
        <h5>Chocolate Pancake</h5>
      </div>
      <div class="cart">
        <h4>315.000</h4>
        <a href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
      </div>
    </div>

</section>

 
<!--Script-->

<script type="text/javascript">
  $(function() {
    $("#addcart").click(function() {
      $.ajax({
        url: "cart_process.php?action=add", // gửi ajax đến file
        type: "post", // chọn phương thức gửi là post
        dateType: "text", // dữ liệu trả về dạng text
        data: {
          ID: <?= $id ?>,
          Number: $("#number").val()
        },
        success: function(result) {
          $("#value").text($("#number").val());
          $("#numbercart").text(result);
        }
      });
    });
  });
</script>


<?php
include 'inc/footer.php';
?>