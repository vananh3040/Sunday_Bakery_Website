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


<div class="pf-user">

    <div class="cus-info"> 
        <div id="load_form">
            <h3> Full Name</h3>
            <input type="text" class="inputcus-info" name="Cus_Name" id="name" value="<?= $Cus_Name ?>" placeholder="Full Name" maxlength="100" required>

            <h3> Gender</h3>
            <div class="input-gender">
                <input type="radio" name="Cus_Gender" value="1" <?php if($Cus_Gender == 1){echo "checked";} ?> required> <span> Male</span> 
                <input type="radio" name="Cus_Gender" value="0" <?php if($Cus_Gender == 0){echo "checked";} ?> required> <span> Female</span>
            </div>

            <h3> Birthday</h3>
            <input type="date" class="inputcus-info" name="Cus_BDay" id="birthday" value="<?= $Cus_BDay ?>" min="1850-01-01" required>

            <h3> Phone number</h3>
            <input type="tel" class="inputcus-info" name="Cus_Phone" id="tel" value="<?= $Cus_Phone ?>" placeholder="Phone number" maxlength="15" required>                 

            <h3> Email</h3>
            <input type="email" class="inputcus-info" name="Cus_Email" id="email" value="<?= $Cus_Email ?>" placeholder="Email" maxlength="100" required>
        </div>   

        <a id="open-popup-btn" class="btn-update" onclick="Update_Info()">Update</a>
    </div>

 

<!----------------- Popup, Modal ----------------->
<div class="popup center">
    <div class="icon" id="icon-status">
     <p>Update sucessful!</p>
    </div>

    <div class="title-1" id="notify">

    </div> 
    <br>
    <div class="dismiss-btn">
        <button id="dismiss-popup-btn">OK</button>
    </div>
</div>

 

<script type="text/javascript">
    function Update_Info()
    {
        $.ajax
        ({
            url: "./Process/user-process.php?action=update", // gửi ajax đến file
            type: "post", // chọn phương thức gửi là post
            dateType: "text", // dữ liệu trả về dạng text
            data: 
            {
                Cus_ID: <?php if(isset($_SESSION['login']['Cus_ID'])) {echo $_SESSION['login']['Cus_ID'];} else{echo "0";} ?>,
                Cus_Name: $("#name").val(),
                Cus_BDay: $("#birthday").val(),
                Cus_Gender: $('[name="Cus_Gender"]:radio:checked').val(),
                Cus_Email: $("#email").val(),
                Cus_Phone: $("#tel").val(),
            },
            success: function(result)
            {   
                if(result == 'Cập nhật thành công!')
                {
                    $("#icon-status").html('<i class="fa fa-check"></i>');
                    $("#notify").text(result);
                }
                else if(result == 'Vui lòng điền đầy đủ thông tin!')
                {
                    $("#icon-status").html('<i class="fa fa-exclamation-triangle" style="color: #fcc603; font-size: 80px;"></i>');
                    $("#notify").text(result);                
                }
                $("#load_form").load("Profile.php?action=user #load_form");
            }
        });
    }


    document.getElementById("open-popup-btn").addEventListener("click",function()
    {
        document.getElementsByClassName("popup")[0].classList.add("active");
    });

    document.getElementById("dismiss-popup-btn").addEventListener("click",function()
    {
        document.getElementsByClassName("popup")[0].classList.remove("active");
    });
</script>

<?php
    }
    else
    {
        header('Location: login.php');
    }
?>