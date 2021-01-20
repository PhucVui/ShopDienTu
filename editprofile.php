<?php
include 'inc/header.php';
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    $updateCustomer = $cs->update_customer($_POST, $id);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Update Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <?php
if (isset($updateCustomer)) {
    echo '<td colspan="3">' . $updateCustomer . '</td>';
}
?>
                    </tr>
                    <?php

$get_customer = $cs->show_customer($id);
if ($get_customer) {
    while ($result = $get_customer->fetch_assoc()) {
        ?>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" value="<?php echo $result['email'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></input></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type='submit' name='save' value='SAVE' style='font-size:18px'></input>
                        </td>
                    </tr>

                    <?php
}
}
?>
                </table>
            </form>
        </div>
    </div>

    <?php
include 'inc/footer.php';

?>