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
.order {
    font-size: 50px;
    font-weight: bold;
    color: red;
}
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="order">
                <h3 style="text-align: center;">Order Page</h2>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>