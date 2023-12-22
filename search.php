<?php
session_start();
include './DBConnect/DBConnect.php';
include 'Functions.php';

$item_per_page = 12; // Số sản phẩm trên một trang
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
$offset = ($current_page - 1) * $item_per_page; // Công thức chia sản phẩm đều ra các trang

// $search = !empty($_GET['Search']) ? $_GET['Search'] : "";
$search = !empty($_GET['Search']) ? $_GET['Search'] : "";
$param = "";

$field = isset($_GET['field']) ? $_GET['field'] : "";
$sort = isset($_GET['sort']) ? $_GET['sort'] : "";
$sort_condition = "";

if (!empty($search)) {
    $param .= "&Search=" . $search . "&";
}
if (!empty($field) && !empty($sort)) {
    $sort_condition = "ORDER BY `$field` $sort";
    $param .= "field=$field&sort=$sort" . "&";
}
$QR = "SELECT * FROM `products` WHERE `Pro_Name` LIKE '%" . $search . "%' " . $sort_condition . " LIMIT " . $item_per_page . " OFFSET " . $offset;
$Products = $con->query($QR);

$total_records = mysqli_query($con, "SELECT * FROM `products` WHERE `Pro_Name` LIKE '%" . $search . "%'");

$totals = mysqli_num_rows($total_records); // Tổng số sản phẩm
$total_page = ceil($totals / $item_per_page); // Tổng số sản phẩm / Số sản phẩm trên một trang = Tổng Số trang (Nếu ra số lẻ sẽ làm tròn)
?>
<?php
include 'inc/header.php';
?>

<!--Bat dau Products -->

<!--Product content-->
<div class="bg-main">
    <div class="container-1 section-p1">
        <div class="box">
            <div class="breadcumb-1">
                <a href="./index.php">home</a>
                <span><i class="material-icons">keyboard_double_arrow_right</i></span>
                <a href="./products.php">all products</a>
            </div>
        </div>
        <div class="box">
            <div class="row">
                <div class="filter-col" id="filter-col">
                    <div class="box filter-toggle-box">
                        <button class="btn-flat btn-hover" id="filter-close">close</button>
                    </div>

                    <div class="box">
                        <span class="filter-header">
                            Categories
                        </span>
                        <ul class="filter-list">
                            <li><a href="#">Signature Cake</a></li>
                            <li><a href="#">Cupcakes Beautifully</a></li>
                            <li><a href="#">Sweet Treats And Party</a></li>
                            <li><a href="#">Bread & Pastry</a></li>
                        </ul>
                    </div>
                    <div class="box">
                        <span class="filter-header">
                            CHRISTMAS
                        </span>
                        <ul class="filter-list">
                            <li><a href="#">Bespoke Christmas Cake </a></li>
                            <li><a href="#">Wall ST Bull And Try</a></li>
                            <li><a href="#">Thriving Disney Family</a></li>
                            <li><a href="#">Love Winter</a></li>
                        </ul>
                    </div>
                    <div class="box">
                        <span class="filter-header">
                            Price
                        </span>
                        <div class="price-range">
                            <div class="slidecontainer">
                                <input type="range" min="1" max="600" value="50" class="slider" id="myRange">
                                <p><b>Cost: <span id="demo"></span> </b> </p>
                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <span class="filter-header">
                            rating
                        </span>
                        <ul class="filter-list">
                            <li>
                                <div class="group-checkbox">
                                    <input type="checkbox" id="remember1">
                                    <label for="remember1">
                                        <span class="rating">
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                        </span>
                                        <i class='bx bx-check'></i>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="group-checkbox">
                                    <input type="checkbox" id="remember1">
                                    <label for="remember1">
                                        <span class="rating">
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                        </span>
                                        <i class="material-symbols-outlined">
                                            done
                                        </i>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="group-checkbox">
                                    <input type="checkbox" id="remember1">
                                    <label for="remember1">
                                        <span class="rating">
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                        </span>
                                        <i class="material-symbols-outlined">
                                            done
                                        </i>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="group-checkbox">
                                    <input type="checkbox" id="remember1">
                                    <label for="remember1">
                                        <span class="rating">
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                        </span>
                                        <i class="material-symbols-outlined">
                                            done
                                        </i>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="group-checkbox">
                                    <input type="checkbox" id="remember1">
                                    <label for="remember1">
                                        <span class="rating">
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                            <i class='material-icons'>star</i>
                                        </span>
                                        <i class="material-symbols-outlined">
                                            done
                                        </i>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-2">
        <section id="product1" class="section-n1">
            <div class="box">
                <?php
                if ($totals <= 0) {
                } else {
                ?>
                    <div class="sort">
                        <select id="sortbox" onchange="this.options[this.selectedIndex].value && 
                    (window.location = this.options[this.selectedIndex].value);">
                            <option value="?field=Pro_ID&sort=ASC" selected>
                                <p>FEATURED</p>
                            </option>
                            <option value="?field=Pro_Price&sort=ASC" <?php if (isset($_GET['field']) && $_GET['field'] == "Pro_Price" && isset($_GET['sort']) && $_GET['sort'] == "ASC") { ?> selected <?php } ?>>
                                <p>PRICE, LOW TO HIGH</p>
                            </option>
                            <option value="?field=Pro_Price&sort=DESC" <?php if (isset($_GET['field']) && $_GET['field'] == "Pro_Price" && isset($_GET['sort']) && $_GET['sort'] == "DESC") { ?> selected <?php } ?>>
                                <p>PRICE, HIGH TO LOW</p>
                            </option>
                            <option value="?field=Pro_Name&sort=ASC" <?php if (isset($_GET['field']) && $_GET['field'] == "Pro_Name" && isset($_GET['sort']) && $_GET['sort'] == "ASC") { ?> selected <?php } ?>>
                                <p>ALPHABETICALLY, A-Z</p>
                            </option>
                            <option value="?field=Pro_Name&sort=DESC" <?php if (isset($_GET['field']) && $_GET['field'] == "Pro_Name" && isset($_GET['sort']) && $_GET['sort'] == "DESC") { ?> selected <?php } ?>>
                                <p>ALPHABETICALLY, Z-A</p>
                            </option>
                        </select>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="pro-container">
                <?php
                while ($row = $Products->fetch_array()) {
                ?>
                    <div class="pro" id="except" onclick="window.location.href='product-detail.php?id=<?= $row['Pro_ID'] ?>';">
                        <img src="<?= $row['Pro_Img'] ?>" alt="" class="">
                        <div class="des">
                            <span><?= $row['Pro_Type'] ?></span>
                            <h5><?= $row['Pro_Name'] ?></h5>
                        </div>
                        <div class="cart">
                            <h4><?= number_format($row['Pro_Price'], 0, ",", ".") ?></h4>
                            <a href="#" class="cart-1"><i class="material-icons">shopping_cart</i></a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="box">
                <ul class="pagination">
                    <?php
                    if ($current_page > 3) {
                        $first_page = 1;
                    ?>
                        <li><a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><span><strong>First</strong></span></a></li>
                    <?php
                    }
                    ?>
                    <?php
                    for ($num = 1; $num <= $total_page; $num++) {
                        if ($num != $current_page) {
                            if ($num > $current_page - 3 && $num < $current_page + 3) {
                    ?>
                                <li> <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><span><?= $num ?></span></a>
                                <li>
                                <?php
                            }
                        } else // Tô màu cho trang đã chọn
                        {
                                ?>
                                <li> <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $num ?>" class="active"><span class="select"><?= $num ?></span></a>
                                <li>
                            <?php
                        }
                    }
                            ?>

                            <?php
                            if ($current_page < $total_page - 3) {
                                $end_page = $total_page;

                            ?>
                                <li> <a href="?<?= $param ?>per_page=<?= $item_per_page ?>&page=<?= $end_page ?>"><span><strong>Last</strong></span></a>
                                <li>
                                <?php
                            }
                                ?>
                </ul>
            </div>
        </section>
    </div>
</div>


<!--END Product content-->
<?php
include 'inc/footer.php';
?>