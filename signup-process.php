<?php
    include './DBConnect/DBConnect.php';

    if(isset($_POST['register']))
    {
        $JSON = json_encode($_POST['register']); // Chyển sang dạng JSON
        $Register = json_decode($JSON, true); // Chuyền JSON sang array. Thật ra để mảng POST cũng lấy đc dữ liệu cơ mà tui thích màu mè 

        $Cus_Name = $Register[0]['value'];   
        $Acc_Username = $Register[0]['value'];
        $Acc_Password = md5($Register[1]['value']);
        $Re_Password = md5($Register[2]['value']);

        $SQLUser = "SELECT * FROM `accounts` WHERE `Acc_Username` = '$Acc_Username'";
        $CheckUser = $con->query($SQLUser);
        $row = $CheckUser->fetch_array();

        if(!empty($row))
        {
            echo "Tên người dùng '$Acc_Username' đã tồn tại. Vui lòng chọn tên khác!";
        }
        else
        {
            if($Acc_Password !== $Re_Password)
            {
                echo "Mật khẩu không khớp. Vui lòng nhập lại!";
            }
            else
            {
                $current_date = date("Y-m-d H:i:s");
                // Insert into Database
                $SQLCus = "INSERT INTO customer(Cus_ID, Cus_Name) VALUES ('', '$Cus_Name')";
                $Customer = $con->query($SQLCus);
                $id = mysqli_insert_id($con);
                
                $SQLAcc = "INSERT INTO accounts(Acc_ID, Acc_Username, Acc_Password, Acc_Role, Acc_Status, Acc_Date, Cus_ID) VALUES ('', '$Acc_Username', '$Acc_Password', 'customer', 0, '$current_date', '$id')";
                $Account = $con->query($SQLAcc);

                if($Customer == true && $Account == true)
                {
                    echo "Tạo tài khoản thành công!";
                }
                else
                {
                    echo "Lỗi hệ thống! Tạo tài khoản thất bại!";
                }
            }
        }
    }
?>