 
<?php
include './DBConnect/DBConnect.php';
include 'cart_process.php';
include 'Functions.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
}


$Cus_ID = "";
$Cus_Name = "";
$Cus_BDay = "";
$Cus_Gender = "";
$Cus_Email = "";
$Cus_Phone = "";

if (isset($_SESSION['login'])) {
  $ID_Cus = $_SESSION['login']['Cus_ID'];
  $SQLuser = "SELECT * FROM `customer` JOIN `accounts` ON `customer`.`Cus_ID` = `accounts`.`Cus_ID` WHERE `accounts`.`Cus_ID` = '$ID_Cus'";
  $User = $con->query($SQLuser);
  if ($User == true) {
    $row = $User->fetch_array();

    $Cus_ID = !empty($row['Cus_ID']) ? $row['Cus_ID'] : '';
    $Cus_Name = !empty($row['Cus_Name']) ? $row['Cus_Name'] : '';
    $Cus_BDay = !empty($row['Cus_BDay']) ? $row['Cus_BDay'] : '';
    $Cus_Gender = !empty($row['Cus_Gender']) ? $row['Cus_Gender'] : '';
    $Cus_Email = !empty($row['Cus_Email']) ? $row['Cus_Email'] : '';
    $Cus_Phone = !empty($row['Cus_Phone']) ? $row['Cus_Phone'] : '';
  } else {
    echo "Lỗi hệ thống!";
  }
}
$num = 1;
$i = 0;
$Total_Price = 0;
$html = "<table border='1' align='center'>";
$html .= "<tr align='center'><th>SỐ THỨ TỰ</th><th>TÊN SẢN PHẨM</th><th>ĐƠN GIÁ</th><th>SỐ LƯỢNG</th><th>THÀNH TIỀN</th></tr>";
?>


<?php
include 'inc/header.php';
?>


<!--Bat dau cart-->
<div class="small-container cart-page" id="updateload">
  <section id="heading-cart">

    <div class="heading">
      <div class="steps">
        <span><i class='material-icons'>shopping_cart</i></span>
        <h6>Cart</h6>
      </div>
      <hr color="blue" width="180px" />
      <div class="steps">
        <span><i class='material-icons'>location_on</i></span>
        <h6>Address</h6>
      </div>
      <hr color="blue" width="180px" />
      <div class="steps">
        <span><i class='material-icons'>payments</i></span>
        <h6>Order</h6>
      </div>
    </div>
  </section>


  <section id="cart" class="section-p3">
    <div class="table-body border-cart">
      <?php
      if (empty($_SESSION['cart'])) {
        echo '<br><h5 style=" ">Your cart is empty!</h5><br>';
      } else {
      ?>
        <table class="first-tab" width="100%">
          <thead>
            <tr>
              <td>Number</td>
              <td>Product</td>
              <td>Name</td> 
              <td>Quantity</td>
              <td>Subtotal</td>
              <td></td>
            </tr>
          </thead>


          <tbody>
            <?php
            foreach ($_SESSION['cart'] as $key => $value) {
            ?> 
              <tr>
              <td> <?= $num++ ?> </td>
                <td> <a href="product-detail.php?id=<?= $key ?>"><img src="<?= $value['image'] ?>" alt=""> </a>
                </td>
                <td>
                  <a href="product-detail.php?id=<?= $key ?>">
                    <h6><?= $value['name'] ?></h6>
                  </a>
                </td>
                
                <td>
                  <div class="wrapper">
                    <input type="number" id="quantity_<?= $key ?>" name="quantity_<?= $key ?>" value="<?= $value['num'] ?>" min="1" max="50" onchange="Updatecart(<?= $key ?>)">
                  </div>
                </td>
                <td><span id="itemval"><?php
                                        $Price = $value['price'] * $value['num'];
                                        echo number_format($Price, 0, ",", ".");
                                        $Total_Price += $Price;
                                        ?></span> </td>
                <td><a style="cursor: pointer" onclick="Deletecart(<?= $key ?>)"> <i class="material-icons"> disabled_by_default</i> </a></td>
              </tr>
          </tbody>
        <?php
              $i++;
              $html .=
                "
              <tr align='center'>
                  <td>$i</td>
                  <td>" . $value['name'] . "</td>
                  <td>" . number_format($value['price'], 0, ",", ".") . "</td>
                  <td>" . $value['num'] . "</td>
                  <td>" . number_format($Price, 0, ",", ".") . "</td>
              </tr>                                   
          ";
            }
            $html .=
              "
                                    <tr align='center'>
                                        <th colspan='4'>TỔNG TIỀN</th>
                                        <th>"
              . number_format($Total_Price, 0, ",", ".") .
              "</th>
                                    </tr>
                                </table>
                                
                            ";
        ?>
        </table>
    </div>
  </section>

  <!-- Information of customer -->
<div class="wrap-classes">
  <div class="order-info">
    <form action="" method="POST">
      <h1 class="order-title">INFORMATION</h1>
      <br>
      <div class="form-group-1">
        <h3></i>Fullname</h3>
        <input type="text" class="input-order" name="Cus_Name" id="name" value="<?= $Cus_Name ?>" placeholder="Fullname" maxlength="100" autofocus required>

        <h3></i>Gender</h3>
        <div class="input-gender">
          <input type="radio" name="Cus_Gender" value="1" <?php if ($Cus_Gender == 1) {
                                                            echo "checked";
                                                          } ?> required> <span> Male</span>
          <input type="radio" name="Cus_Gender" value="0" <?php if ($Cus_Gender == 0) {
                                                            echo "checked";
                                                          } ?> required> <span> Female</span>
        </div>

        <h3></i>Birthday</h3>
        <input type="date" class="input-order" name="Cus_BDay" id="date" value="<?= $Cus_BDay ?>" min="1850-01-01" required>
      </div>

      <div class="form-group-2">
        <h3></i>Phone number</h3>
        <input type="tel" class="input-order" name="Cus_Phone" id="tel" value="<?= $Cus_Phone ?>" placeholder="Phone number" maxlength="15" required>

        <h3></i>Email</h3>
        <input type="email" class="input-order" name="Cus_Email" id="email" value="<?= $Cus_Email ?>" placeholder="Email" maxlength="100" required>

        <h3></i>Address</h3>
        <textarea class="input-order" style="resize: vertical;" name="Ord_Address" id="address" placeholder="Address" maxlength="500" required></textarea>
      </div>

      <div class="clear"></div> 
      <hr> 
      <input type="submit" name="addorders" value="Order">
    </form>
  </div>


  <section id="cart-subtotal">
    <div id="subtotal" class="">
      <h3>TOTAL</h3>
      <table>
        <thead>
          <tr>
            <td><strong>Fee</strong></td>
            <td><strong>Cost</strong></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Cost</td>
            <td><?= number_format($Total_Price, 0, ",", "."); ?></td>
          </tr>
          <tr>
            <td>Ship</td>
            <td>0</td>
          </tr>
          <tr>
            <td>Total</td>
            <td><?= number_format($Total_Price, 0, ",", "."); ?></td>
          </tr>
          <tr>
            <td colspan="2">
              <h4>Combine VAT already</h4>
            </td>
          </tr>
          <tr colspan="2">

          </tr>
        </tbody>
      </table>
    <?php

        if (isset($_POST['addorders']) && $_POST['addorders'] == "Order") {
          $current_date = date("Y-m-d H:i:s");
          if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
            $Name = $_POST['Cus_Name'];
            $BDay = $_POST['Cus_BDay'];
            $Gender = $_POST['Cus_Gender'];
            $Email = $_POST['Cus_Email'];
            $Phone = $_POST['Cus_Phone'];

            $SQLUDCus = "UPDATE `customer` SET `Cus_Name`= '$Name', `Cus_BDay`= '$BDay', `Cus_Gender`= '$Gender', `Cus_Email`= '$Email', `Cus_Phone`= '$Phone' WHERE `Cus_ID` = '$Cus_ID'";
            $Customer = $con->query($SQLUDCus);

            $Ord_Address = $_POST['Ord_Address'];
            $data_orders = array(
              "Ord_ID" => '',
              "Ord_Address" => $Ord_Address,
              "Ord_Date" => $current_date,
              "Ord_Date_Done" => $current_date,
              "Ord_Total" => $Total_Price,
              "Ord_Status" => '0',
              "Cus_ID" => $Cus_ID
            );
            // Insert Orders into Database
            $ID_Orders = Insert("orders", $data_orders, "addorders");

            foreach ($_SESSION['cart'] as $key => $value) {
              $amount = $value['num'];
              $SQLOrderDetail = "INSERT INTO order_details(Ord_ID, Pro_ID, Ordd_Amount) VALUES ('$ID_Orders', '$key', '$amount')";
              $con->query($SQLOrderDetail);
            }
          }
        }
      }
    ?>
    </div>

  </section>
</div>

</div>
<!--Ket thuc cart-->
<script type="text/javascript">
  function Updatecart(id) {
    // alert(id);
    $.ajax({
      url: "cart_process.php?action=update", // gửi ajax lên server
      type: "post", // chọn phương thức gửi là post
      dateType: "text", // dữ liệu trả về dạng text
      data: {
        ID: id,
        Number: $("#quantity_" + id).val()
      },
      success: function(result) {
        $("#updateload").load("cart.php #updateload");
      }
    });
  }

  function Deletecart(id) {
    $.ajax({
      url: "cart_process.php?action=update", // gửi ajax lên server
      type: "post", // chọn phương thức gửi là post
      dateType: "text", // dữ liệu trả về dạng text
      data: {
        ID: id,
        Number: 0
      },
      success: function(result) {
        $("#deleteload").load("cart.php #deleteload");
      }
    });
  }
</script>



<?php
include 'inc/footer.php';
?>