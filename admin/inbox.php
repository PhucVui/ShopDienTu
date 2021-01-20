<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/cart.php';?>
<?php include_once '../helpers/format.php';?>

<?php
$cart = new cart();
if (isset($_GET['shipid'])) {
    $id = $_GET['shipid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shipped = $cart->shipped($id, $time, $price);
}

if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $del_shipped = $cart->del_shipped($id, $time, $price);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <?php
if (isset($shipped)) {
    echo $shipped;
}
?>
            <?php
if (isset($del_shipped)) {
    echo $del_shipped;
}
?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order Time</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Customer Id</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$cart = new cart();
$fm = new Format();
$get_inbox_cart = $cart->get_inbox_cart();
if ($get_inbox_cart) {
    $i = 0;
    while ($result = $get_inbox_cart->fetch_assoc()) {
        $i++;
        ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $fm->formatDate($result['date_order']); ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><?php echo $result['quantity'] ?></td>
                        <td><?php echo number_format($result['price'], 0, '', '.') . 'đ' ?></td>
                        <td><?php echo $result['customer_id'] ?></td>
                        <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">View</a></td>
                        <td>
                            <?php
if ($result['status'] == 0) {
            ?>
                            <a
                                href="?shipid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Pending</a>
                            <?php
} elseif ($result['status'] == 1) {
            ?>
                            <?php
echo 'Shipped';
            ?>
                            <?php
} elseif ($result['status'] == 2) {
            ?>
                            <a
                                href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>
                            <?php
}
    }
    ?>
                        </td>
                    </tr>
                    <?php

}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>