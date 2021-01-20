<?php
include 'inc/header.php';
?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insert_order = $cart->insertOrder($customer_id);
    $delcart = $cart->del_all_data_cart();
    header('Location: success.php');
}
?>

<style type="text/css">
h2.success_order {
    text-align: center;
    color: red;
}

p.success_note {
    text-align: center;
    padding: 10px;
    font-size: 18px;
}
}
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Order Success</h2>
                <?php
$customer_id = Session::get('customer_id');
$get_amount = $cart->getAmountPrice($customer_id);
if ($get_amount) {
    $amount = 0;
    while ($result = $get_amount->fetch_assoc()) {
        $price = $result['price'];
        $amount += $price;

    }
}
?>
                <p class="success_note">You bought product from our website with total price is :
                    <?php
$vat = $amount * 0.1;
$total = $vat + $amount;
echo number_format($total, 0, '', '.') . 'đ';
?>
                </p>
                <p class="success_note">We will contact with you soon. Please see your order details : <a
                        href="orderdetails.php">
                        Click Here !!!</a>
                </p>
                <p class="success_note">Thank you so much !!!</p>
            </div>
        </div>
    </div>
</form>
<?php
include 'inc/footer.php';
?>