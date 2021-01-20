<?php
include 'inc/header.php';

?>
<?php
// if (isset($_GET['cartId'])) {
//     $cartId = $_GET['cartId'];
//     $delProductCart = $cart->del_product_cart($cartId);
// }
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $quantity = $_POST['quantity'];
//     $cartId = $_POST['cartId'];
//     $update_quantity = $cart->update_quantity_cart($cartId, $quantity);
// }
?>
<?php
// if (!isset($_GET['id'])) {
//     echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
// }
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Compare Product</h2>
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
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
$get_cart = $cart->get_product_cart();
if ($get_cart) {
    $subTotal = 0;
    $qty = 0;
    while ($result = $get_cart->fetch_assoc()) {

        ?>
                    <tr>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></td>
                        <td><?php echo number_format($result['price'], 0, '', '.') . 'đ' ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
                                <input type="number" name="quantity" value="<?php echo $result['quantity'] ?>"
                                    min="1" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>
                        <td>
                            <?php $total = $result['price'] * $result['quantity'];
        echo number_format($total, 0, '', '.') . 'đ';
        ?>
                        </td>
                        <td><a onclick="return confirm('Are you sure delete?')"
                                href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>
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
                <table style=" float:right;text-align:left;" width="40%">
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
                        </td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td><?php $finalPrice = $grandTotal + $subTotal;
    echo number_format($finalPrice, 0, '', '.') . 'đ';?></td>
                    </tr>
                </table>
                <?php
} else {
    echo "Your cart is empty";
}
?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>