<?php
session_start();
include './DBConnect/DBConnect.php';
include 'Functions.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($_SESSION['login'])) {
  header('Location: Login.php');
}

$action = isset($_GET['action']) ? $_GET['action'] : 'info';
?>

<?php
include 'inc/header.php';
?>
<title>
  <?php
  switch ($action) {
    case 'info': {
        echo 'Thông Tin Khách Hàng';  
        break;
      }
    case 'order': {
        echo 'Orders';
        break;
      }
    case 'order1':
        {
            echo 'Packaging';
            break;
        }
     case 'order2':
        {
            echo 'Delivery';
            break;
        }
    case 'repass': {
        echo 'Change Pass';
        break;
      }
    default: {
        echo 'Thông Tin Khách Hàng';
        break;
      }
  }
  ?>
</title>



<section id="menu-dashboard">

  <section id="menu-info">
    <div class="menu-head">
      <h2>Profile</h2>
    </div>
    <div class="item-user">
      <li <?php if ($action == 'info') {
            echo "active";
          } ?>><i class="material-icons ">person</i><a href="userprofile.php?action=info">Information </a></li>
      <li <?php if ($action == 'order') {
            echo "active";
          } ?>><a href="userprofile.php?action=order"><i class="material-icons">list_alt</i> Orders </a> </li>
            <li <?php if($action == 'order1'){echo "active";} ?>><i class="material-icons">inventory_2</i><a href="userprofile.php?action=order1"> Pakaging </a> </li>
            <li <?php if($action == 'order2'){echo "active";} ?>><i class="material-icons">local_shipping</i> <a href="userprofile.php?action=order2">Delivery </a></li>
      <li <?php if ($action == 'repass') {
            echo "active";
          } ?>><i class="material-icons">settings</i><a href="userprofile.php?action=repass">Change Password </a></li>
          
          
      <li><i class="material-icons">logout</i><a href="Login.php?module=logout">Logout</a></li>
    </div>
  </section>
 

  <section id="menu-board"> 
  <?php
    if ($action == 'info') {
      include 'user-info.php';
    } else if ($action == 'order') {
      include 'user-order.php'; 
    } else if ($action == 'order1') {
      include 'user-order-2.php';
    }else if ($action == 'order2') {
      include 'user-order-3.php';
    }
    else if ($action == 'repass') {
      include 'user-repass.php';
    } else {
      include 'user-info.php';
    }
    ?> 
  
  </section>
</section>

  
<?php
include 'inc/footer.php';
?>