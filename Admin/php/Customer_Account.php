<?php
    if(isset($_SESSION['loginadmin']))
    {
        $item_per_page = 10;  
        $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;  
        $offset = ($current_page - 1) * $item_per_page;  
        $SQLAccount = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'customer' LIMIT " . $item_per_page . " OFFSET " . $offset;
        $AccountAD = $con->query($SQLAccount);
        
        $total_records = mysqli_query($con, "SELECT * FROM `accounts` WHERE `Acc_Role` = 'customer'");
        $totals = mysqli_num_rows($total_records);  
   
        $total_page = ceil($totals / $item_per_page);  
?> 

        <div class="ad-account">
 
            <br>

            <div class="info-account">
                <br>
                <input type="text" class="search-ac" name="search" id="search-ac" placeholder="Username">
                <br>
                <br>
                <div class="custom">
                <table border="1"  cellspacing="0" align="center" id="loadaccount">
                    <tr class="table-title">
                        <th>Account ID</th>
                        <th>Username </th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date Created</th>
                        <th>Customer ID</th>
                        <th>Delele</th>
                    </tr>
                    <tbody id="datasearch">
                        <?php
                            while($row = $AccountAD->fetch_array())
                            {
                        ?>
                                <tr>
                                    <td><?= $row['Acc_ID'] ?></td>
                                    <td><?= $row['Acc_Username'] ?></td>
                                    <td><?= $row['Acc_Password'] ?> </td>
                                    <td><?= $row['Acc_Role'] ?></td>
                                    <td><?= $row['Acc_Status'] ?></td>
                                    <td><?= $row['Acc_Date'] ?></td>
                                    <td><a href="Customer_Modal.php?CUSID=<?= $row['Cus_ID'] ?>" target="_blank" onclick="window.open(this.href, 'customer', 'left=500, top=50, width=450, height=300, toolbar=1, resizable=0'); return false;" style="color: #06ba2a; text-decoration: underline;"><?= $row['Cus_ID'] ?></a></td>                                                           
                                    <td><a class="delete-ac" onclick="Delete(<?= $row['Acc_ID'] ?>)"><i class="fa fa-remove"></i></a></td>
                                </tr>
                        <?php
                            }
                        ?>

                        <tr>
                            <td colspan="8">
                                <div class="page-btn">
                                <?php
                                    if($current_page > 5)
                                    {
                                        $first_page = 1;                 
                                ?>
                                        <a href="?action=customerac&page=<?= $first_page ?>"><span><strong>First</strong></span></a>
                                <?php
                                    }
                                ?>

                                <?php
                                    for($num = 1; $num <= $total_page; $num++)
                                    {
                                        if($num != $current_page)
                                        {
                                            if($num > $current_page - 5 && $num < $current_page + 5)
                                            {
                                ?>
                                                <a href="?action=customerac&page=<?= $num ?>"><span><?= $num ?></span></a>
                                <?php
                                            }  
                                        }
                                        else // Tô màu cho trang đã chọn
                                        {
                                ?>
                                            <a href="?action=customerac&page=<?= $num ?>"><span class="select"><?= $num ?></span></a>
                                <?php
                                        } 
                                    }
                                ?>

                                <?php
                                    if($current_page < $total_page - 5)
                                    {
                                        $end_page = $total_page;
                                ?>
                                        <a href="?action=customerac&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                                <?php
                                    }
                                ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>         
                </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function()
            {
                $("#search-ac").keyup(function()
                {
                    var keyword = $("#search-ac").val();
                    $.ajax
                    ({
                        url: "Account_Process.php?account=customer&action=search", // gửi ajax đến file
                        type: "post", // chọn phương thức gửi là post
                        dateType: "text", // dữ liệu trả về dạng text
                        data: 
                        { 
                            Search: keyword,
                        },
                        success: function(result)
                        {                  
                            if(result == 'Nothing')     
                            {
                                $("#loadaccount").load("Admin_Page.php?action=customerac #loadaccount"); 
                            }
                            else
                            {
                                $("#datasearch").html(result);
                            }                            
                        }
                    });
                });
            });

            function Delete(id)
            {
                $.ajax
                ({
                    url: "Account_Process.php?account=customer&action=deleteac", // gửi ajax đến file
                    type: "post", // chọn phương thức gửi là get
                    dateType: "text", // dữ liệu trả về dạng text
                    data: 
                    { 
                        Acc_ID: id,
                    },
                    success: function (result)
                    {              
                        alert(result);      
                        $("#loadaccount").load("Admin_Page.php?action=customerac #loadaccount");             
                    }
                });
            };
        </script>
<?php
    }
    else
    {
        header('Location: Login.php');
    }
?>