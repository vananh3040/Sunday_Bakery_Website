<?php
    include './DBConnect/DBConnect.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $action = isset($_GET['action']) ? $_GET['action'] : 'none';


    if($action == 'add')
    {
        if(isset($_POST['New_product']) && !empty($_POST['New_product']))
        {

            $New_Product = $_POST['New_product'];
            
            print_r($New_Product); 
        }
    }



    if($action == 'delete')
    {
        if(isset($_POST['Pro_ID']) && !empty($_POST['Pro_ID']))
        {
            $Pro_ID = $_POST['Pro_ID'];
            $SQLDelete = "DELETE FROM `products` WHERE `Pro_ID` = '$Pro_ID'";
            $Delete = $con->query($SQLDelete);

            if($Delete)
            {
                echo "Delete Success!";
            }
            else
            {
                echo "Delete Fail!";
            }
        }
    }   
    
    if($action == 'search')
    {
        if(isset($_POST['Search']) && !empty($_POST['Search']))
        {
            $Search = $_POST['Search'];
            $SQLProduct = "SELECT * FROM `products` WHERE `Pro_Name` LIKE '%$Search%'";
            $Product = $con->query($SQLProduct);

            while($row = $Product->fetch_array())
            {
?>
                <tr>
                    <td><a href="Account_Modal.php?CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'customer', 'left=500, top=50, width=450, height=300, toolbar=1, resizable=0'); return false;" style="color: #06ba2a; text-decoration: underline;"><?= $row['Cus_ID'] ?></a></td>
                    <td><?= $row['Cus_Name'] ?></td>
                    <td><?= $row['Cus_BDay'] ?> </td>
                    <td><?php if($row['Cus_Gender'] == 1){echo "Nam";} else{echo "Nữ";} ?></td>
                    <td><?= $row['Cus_Email'] ?></td>
                    <td><?= $row['Cus_Phone'] ?></td>                                                          
                    <td><a class="delete-ac" onclick="Delete(<?= $row['Cus_ID'] ?>)"><i class="fa fa-trash"></i></a></td>
                </tr>
<?php
            }
        }
        else
        {
            echo "Nothing";
        }
    }
?>