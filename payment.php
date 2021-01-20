<?php
include 'inc/header.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<style>
h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}

.wrapper_method {
    text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    background: cornsilk;
}

.wrapper_method a {
    padding: 10px;
    background: red;
    color: #fff;
}

.wrapper_method h3 {
    margin-bottom: 20px
}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Choose method payment</h3>
                    <a href="offlinepayment.php">Öffline Payment</a>
                    <a href="onlinepayment.php">Önline Payment</a><br><br><br>
                    <a style="background:gold" href="cart.php">
                        << Back </a>
                </div>
            </div>
        </div>
    </div>

    <?php
include 'inc/footer.php';

?>