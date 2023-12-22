<?php
    if(isset($_SESSION['login']))
    {
        $number = 1;
        $ID_Cus = $_SESSION['login']['Cus_ID'];
        $SQLOrder = "SELECT * FROM `orders`, `customer` WHERE `orders`.`Cus_ID` = `customer`.`Cus_ID` AND `orders`.`Ord_Status` = '1' AND `orders`.`Cus_ID` = '$ID_Cus'";
        $Order = $con->query($SQLOrder);

        $total = mysqli_num_rows($Order); 
        $_SESSION['Order1'] = $total;    
?> <div class="wrap-classes-2">  
        <div class="pf-order">
            
            <?php
                if($total <= 0)
                {
                    echo '<h1 style="letter-spacing: 2px;">Empty</h1><br>';
                }
                else
                {
            ?>  
                    <table align="center" id="loadorder">   
                        
                        <tr class="table-title" id="tired-row">
                        <th>Number&nbsp;&nbsp;</th>
                        <th>Order's info&nbsp;&nbsp;</th>
                        <th>Total&nbsp;&nbsp;</th>
                        <th>Date&nbsp;&nbsp;</th>
                        <th>Address&nbsp;&nbsp;</th>
                        <th>Status&nbsp;&nbsp;</th>
                    </tr>

                        <?php   
                            while($row = $Order->fetch_array())
                            {
                        ?>
                                <tr class="table-content">
                                    <td><?= $number++ ?></td>

                                    <td>
                                        <table  >
                                        <tr class="table-title" id="tired-row">
                                            <th>&nbsp;</th>
                                            <th>Product&nbsp;</th>
                                            <th>Name&nbsp;</th>
                                            <th>Cost&nbsp;</th>
                                            <th>Quantity&nbsp;</th>
                                        </tr>

                                            <?php
                                                $num = 1;
                                        
                                                $ID_Order = $row['Ord_ID'];
                                                $SQLOrderDT = "SELECT * FROM `orders`, `order_details`, `products` WHERE `orders`.`Ord_ID` = `order_details`.`Ord_ID` AND `order_details`.`Pro_ID` = `products`.`Pro_ID` AND `orders`.`Ord_Status` = '1' AND `orders`.`Ord_ID` = '$ID_Order' AND `orders`.`Cus_ID` = '$ID_Cus'";
                                                $ODDT = $con->query($SQLOrderDT);
                                            
                                                while($row_1 = $ODDT->fetch_array())
                                                {
                                            ?>
                                                    <tr>
                                                        <td>
                                                        &nbsp;&nbsp;<?= $num++ ?>&nbsp;&nbsp;
                                                        </td>
                                                        <td>
                                                            <a href="Product_Detail.php?id=<?= $row_1['Pro_ID'] ?>" target="_blank"><img style="width: 40%; height: 40%; padding: 0;" src="<?= $row_1['Pro_Img'] ?>"></a>&nbsp;&nbsp;
                                                        </td>
                                                        <td>
                                                            <?= $row_1['Pro_Name'] ?> 
                                                        </td>
                                                        <td>
                                                            <?= number_format($row_1['Pro_Price'], 0, ",", ".") ?> <small><strong><u></u></strong></small>&nbsp;&nbsp;
                                                        </td>
                                                        <td>
                                                            <?= $row_1['Ordd_Amount'] ?>&nbsp;&nbsp;
                                                        </td>
                                                    </tr>  
                                            <?php
                                                }                                             
                                            ?>
                                        </table>
                                    </td>

                                    <td>
                                        <h3 ><?= number_format($row['Ord_Total'], 0, ",", ".") ?> <small><strong><u></u></strong></small></h3> 
                                    </td>
                                    <td>
                                        <?= $row['Ord_Date'] ?>
                                    </td>
                                    <td>
                                        <?= $row['Ord_Address'] ?>
                                    </td>
                                    <td>
                                        <h4 style="color: #32a852; font-weight: bolder;">Packaging</h4>
                                    </td>                                  
                                </tr>
                        <?php
                            }
                        ?>
                    </table>                   
            <?php
                }
            ?>
        </div> 
   </div>
<?php
    }
?>