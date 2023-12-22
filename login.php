<?php
session_start();
ob_start();
// session_destroy();
include './DBConnect/DBConnect.php';
include 'Functions.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');


$logout = isset($_GET['module']) ? $_GET['module'] : "";
if (!empty($logout) && $logout == "logout") {
    session_destroy();
    header('Location: login.php');
}

if (isset($_POST['login']) && $_POST['login'] == "login-btn") {
    $username = $_POST['Acc_Username'];
    $password = md5($_POST['Acc_Password']);

    $SQLLogin = "SELECT * FROM `accounts` WHERE `Acc_Role` = 'customer' AND `Acc_Username` = '$username' AND `Acc_Password` = '$password'";
    $Account = $con->query($SQLLogin);
    $row = $Account->fetch_array();

    if (!empty($row)) {
        if (isset($_POST['remember'])) {
            setcookie("Username", $username);
            setcookie("Password", $_POST['Acc_Password']);
            setcookie("Check", $_POST['remember']);
        } else {
            setcookie("Check", 0);
        }
        $_SESSION['login'] = $row;
        header('Location: index.php');
    }
}

$Username = "";
$Password = "";
$check = false;
if (isset($_COOKIE['Username']) && isset($_COOKIE['Password']) && $_COOKIE['Check'] == 1) {
    $Username = $_COOKIE['Username'];
    $Password = $_COOKIE['Password'];
    $check = true;
} else {
    $Username = "";
    $Password = "";
    $check = false;
}
ob_end_flush();
?>

<?php
include 'inc/header.php';
?>



<!--Bat dau dang nhap-->
<section id="login">
    <div class="container forms">
        <div class="form login">

            <div class="slide-imgs">
                <img src="img/bg3.webp" alt="">
            </div>

            <div class="form-content">
                <div class="brand-img"><img src="img/logo3.png" alt=""></div>
                <header>Login</header>
                <form id="LoginForm" action="" method="POST">
                    <div class="field input-field">
                        <input type="text" placeholder="Username" class="input" value="<?= $Username ?>" name="Acc_Username" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" value="<?= $Password ?>" name="Acc_Password" required>
                        <i class="fa fa-eye-slash eye-icon"></i>
                    </div>
                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <div class="field button-field">
                        <button type="submit" class="btn" name="login" value="login-btn">Login</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>

        </div>


        <!-- Signup Form -->

        <div class="form signup">
            <div class="slide-imgs">
                <img src="img/bg3.webp" alt="">
            </div>
            
            <div class="form-content">
                <div class="brand-img"><img src="img/logo3.png" alt=""></div>
                <header>Signup</header>
                <form id="RegForm" method="POST">
                    <div class="field input-field">
                        <input type="text" name="Acc_Username" id="username" placeholder="Username" class="input" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="Acc_Password" id="password" placeholder="Create password" class="password" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="Password" id="repassword" placeholder="Confirm password" class="password" required>
                        <i class="fa fa-eye-slash eye-icon"></i>
                    </div>

                    <div class="field button-field">
                        <button type="submit" class="btn" name="register" value="TẠO TÀI KHOẢN">Signup</button>
                    </div>
                    <small style="color: red;" id="notify"></small>
                </form>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Ket thuc dang nhap-->
<script src="js/login-app.js"></script>

<script type="text/javascript">
    $(function() {
        $("#RegForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "signup-process.php", // gửi ajax đến file
                type: "post", // chọn phương thức gửi là post
                dateType: "text", // dữ liệu trả về dạng text
                data: {
                    register: $(this).serializeArray(),
                },
                success: function(result) {
                    // $("#form-load").load("Login.php #form-load");   
                    if (result === 'Tạo tài khoản thành công!') {
                        alert("Tạo tài khoản thành công!");
                    }
                    $("#notify").text(result);
                }
            });
        });
    });
</script>

<?php
include 'inc/footer.php';
?>

<!--Ket thuc banner-->