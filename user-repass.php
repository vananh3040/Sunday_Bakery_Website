<?php
    if(isset($_SESSION['login']))
    {
        $Cus_Name = "";
        $Cus_BDay = "";
        $Cus_Gender = "";
        $Cus_Email = "";
        $Cus_Phone = "";
        
        $ID_Cus = $_SESSION['login']['Cus_ID'];

        $Acc_ID = $_SESSION['login']['Acc_ID'];
        $Acc_Username = $_SESSION['login']['Acc_Username'];
        $Acc_Password = $_SESSION['login']['Acc_Password'];

        $SQLuser = "SELECT * FROM `customer` JOIN `accounts` ON `customer`.`Cus_ID` = `accounts`.`Cus_ID` WHERE `accounts`.`Cus_ID` = '$ID_Cus'";
        $User = $con->query($SQLuser);
        if($User == true)
        {
            $row = $User->fetch_array();

            $Cus_Name = !empty($row['Cus_Name']) ? $row['Cus_Name'] : '';
            $Cus_BDay = !empty($row['Cus_BDay']) ? $row['Cus_BDay'] : '';
            $Cus_Gender = !empty($row['Cus_Gender']) ? $row['Cus_Gender'] : '';
            $Cus_Email = !empty($row['Cus_Email']) ? $row['Cus_Email'] : '';
            $Cus_Phone = !empty($row['Cus_Phone']) ? $row['Cus_Phone'] : '';         
        }
        else
        {
            echo "Lỗi hệ thống!";
        }
?>

 <div id="change-pass" class="content-board hide">
   <form action="" method="POST" class="info-form">
     <div class="form-items">
       <h5>Password</h5>
       <input type="password" name="Acc_Password" id="oldpassword" placeholder="Old password" class="input" required>
     </div>

     <div class="form-items">
       <h5>New password</h5>
       <input type="password" name="Acc_NewPassword" id="newpassword" placeholder="Password" class="input" required>
     </div>
     <div class="form-items">
       <h5>Confirm password</h5>
       <input type="password" name="Acc_ReNewPassword" id="renewpassword" placeholder="Password" class="input" required>
     </div>

     <div class="edit-button">
       <input type="submit" name="changepassword" value="Change Password">
     </div>

     <p style="color: red;">
       <?php
        if (isset($_POST['changepassword']) && $_POST['changepassword'] == "Change Password") {
          $Acc_OldPassword = md5($_POST['Acc_Password']);
          $Acc_NewPassword = md5($_POST['Acc_NewPassword']);
          $Acc_ReNewPassword = md5($_POST['Acc_ReNewPassword']);

          if ($Acc_OldPassword === $Acc_Password) {
            if ($Acc_NewPassword === $Acc_ReNewPassword) {
              $SQLChangepass = "UPDATE `accounts` SET `Acc_Password` = '$Acc_NewPassword' WHERE `Acc_ID` = '$Acc_ID'";
              $ChangePassword = $con->query($SQLChangepass);
              if ($ChangePassword == true) {
                echo "Đổi mật khẩu thành công!";
              } else {
                echo "Lỗi hệ thống! Đổi mật khẩu thất bại!";
              }
            } else {
              echo "Mật khẩu mới không khớp! Vui lòng nhập lại!";
            }
            unset($_POST);
          } else {
            echo "Mật khẩu cũ không chính xác!";
          }
        }
        ?>
     </p>
   </form>
 </div>


 
 <?php
    }
    else
    {
        header('Location: ./Login.php');
    }
?>