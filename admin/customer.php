<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../classes/customer.php';
include_once $filepath . '/../helpers/format.php';
?>
<?php
if (!isset($_GET['customerid']) || $_GET['customerid'] == null) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerid'];
}
$cs = new customer();
$fm = new Format();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin khách hàng</h2>
        <div class="block copyblock">
            <?php
$get_customer = $cs->show_customer($id);
if ($get_customer) {
    while ($result = $get_customer->fetch_assoc()) {
        ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" class="medium"
                                name="catName" />
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" class="medium"
                                name="catName" />
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" class="medium"
                                name="catName" />
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>"
                                class="medium" name="catName" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" class="medium"
                                name="catName" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
}
}
?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>