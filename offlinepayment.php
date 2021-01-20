<?php
include 'inc/header.php';
?>

<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insert_order = $cart->insertOrder($customer_id);
    $delcart = $cart->del_all_data_cart();
    header('Location:success.php');
}
?>

<style type="text/css">
.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;
}

.box_right {
    width: 46%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
}

a.a_order {
    background: green;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
    padding: 10px 30px;
    padding-bottom: 10px;
    border: none;
}
</style>
<form action="" method="post">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Offline Payment</h3>
                </div>
                <div class="clear"></div>
                <div class=box_left>
                    <div class="cartpage">
                        <?php
if (isset($update_quantity)) {
    echo $update_quantity;
}
?>
                        <?php
if (isset($delProductCart)) {
    echo $delProductCart;
}
?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">Id</th>
                                <th width="20%">Product Name</th>
                                <th width="15%">Price</th>
                                <th width="10%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
$get_cart = $cart->get_product_cart();
if ($get_cart) {
    $subTotal = 0;
    $qty = 0;
    $i = 0;
    while ($result = $get_cart->fetch_assoc()) {
        $i++;
        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><?php echo number_format($result['price'], 0, '', '.') . 'đ' ?></td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td>
                                    <?php $total = $result['price'] * $result['quantity'];
        echo number_format($total, 0, '', '.') . 'đ';
        ?>
                                </td>
                            </tr>
                            <?php
$subTotal += $total;
        $qty = $qty + $result['quantity'];
    }

}
?>
                        </table>
                        <?php
$check_cart = $cart->check_cart();
if ($check_cart) {

    ?>
                        <table style=" float:right;text-align:left" width="40%">
                            <tr>
                                <th>Sub Total : </th>
                                <td>
                                    <?php
echo number_format($subTotal, 0, '', '.') . 'đ';

    Session::set('sum', $subTotal);
    Session::set('sl', $qty);
    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>VAT : </th>
                                <td>
                                    <?php $grandTotal = $subTotal * 0.1;
    echo number_format($grandTotal, 0, '', '.') . 'đ';
    ?>
                                </td><br>
                            </tr>
                            <tr>
                                <th style="color:red">Grand Total :</th>
                                <td style="font-weight:bold; font-size:17px"><?php $finalPrice = $grandTotal + $subTotal;
    echo number_format($finalPrice, 0, '', '.') . 'đ';?></td>
                            </tr>
                        </table>
                        <?php
} else {
    echo "Your cart is empty";
}
?>
                    </div>
                </div>
                <div class=box_right>
                    <table class="tblone">
                        <?php
$id = Session::get('customer_id');
$get_customer = $cs->show_customer($id);
if ($get_customer) {
    while ($result = $get_customer->fetch_assoc()) {
        ?>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                        </tr>

                        <?php
}
}
?>

                    </table>

                </div>
            </div>

        </div>
        <center><a href="?orderid=order" class="a_order">Order Now</a></center>
    </div>
</form>
<?php
include 'inc/footer.php';
?>