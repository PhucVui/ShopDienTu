<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>

<?php
if (!isset($_GET['productid']) || $_GET['productid'] == null) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $id = $_GET['productid'];
}

$pd = new product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateProduct = $pd->update_product($_POST, $_FILES, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block">
            <?php
if (isset($updateProduct)) {
    echo $updateProduct;
}
?>
            <?php
$get_product_by_id = $pd->getproductbyid($id);

if ($get_product_by_id) {
    while ($resultpd = $get_product_by_id->fetch_assoc()) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $resultpd['productName'] ?>" class="medium"
                                name="productName" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>Select Category</option>
                                <?php
$cat = new category();
        $catlist = $cat->show_category();
        if ($catlist) {
            while ($result = $catlist->fetch_assoc()) {
                ?>
                                <option <?php if ($result['catId'] == $resultpd['catId']) {echo 'selected';}?>
                                    value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php
}
        }
        ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>Select Brand</option>
                                <?php
$brand = new brand();
        $brandlist = $brand->show_brand();
        if ($brandlist) {
            while ($result = $brandlist->fetch_assoc()) {
                ?>
                                <option <?php if ($result['brandId'] == $resultpd['brandId']) {echo 'selected';}?>
                                    value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?>
                                </option>
                                <?php
}
        }
        ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce"
                                name="description"><?php echo $resultpd['description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $resultpd['price'] ?>" class="medium" name="price" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="uploads/<?php echo $resultpd['image'] ?>" hight="80" , width="80"><br>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
if ($resultpd['type'] == 0) {
            ?>
                                <option selected value="0">Nổi bật</option>
                                <option value="1">Không nổi bật</option>
                                <?php
} else {
            ?>
                                <option value="0">Nổi bật</option>
                                <option selected value="1">Không nổi bật</option>
                                <?php
}
        ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>