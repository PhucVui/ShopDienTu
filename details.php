<?php
include 'inc/header.php';
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == null) {
    echo "<script>window.location = '404.php'</script>";
} else {
    $id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $AddtoCart = $cart->add_to_cart($id, $quantity);
}
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <?php
$get_product_details = $product->getproduct_details($id);
if ($get_product_details) {
    while ($results_details = $get_product_details->fetch_assoc()) {

        ?>
            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img src="admin/uploads/<?php echo $results_details['image'] ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $results_details['productName'] ?></h2>
                    <?php echo $fm->textShorten($results_details['description'], 110) ?>
                    <div class="price">
                        <p>Price: <span><?php echo number_format($results_details['price'], 0, '', '.') . 'đ' ?></span>
                        </p>
                        <p>Category: <span><?php echo $results_details['catName'] ?></span></p>
                        <p>Brand:<span><?php echo $results_details['brandName'] ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="quantity" min="1" value="1" />
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                        </form>
                        <?php
if (isset($AddtoCart)) {
            echo '<span style="color:red; font-size:18px;">Product already Added</span>';
        }
        ?>
                    </div>
                    <div class="add-cart">
                        <form action="" method="POST">
                            <!-- <a href="?list=<?php echo $results_details['productId'] ?>" class="buysubmit">
                            Save to Favourite List</a> -->
                            <a href="?compare=<?php echo $results_details['productId'] ?>" class=" buysubmit">
                                Compare Product</a>
                            <input type="submit" class="buysubmit" name="compare" value="Compare Product" />
                            <input type="hidden" class="buysubmit" name="productid"
                                value="<?php echo $results_details['productId'] ?>" />
                        </form>
                    </div>
                </div>
                <div class=" product-desc">
                    <h2>Product Details</h2>
                    <?php echo $fm->textShorten($results_details['description'], 110) ?>
                </div>
            </div>
            <?php
}
}
?>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php
$get_category = $cat->show_category_frontend();
if ($get_category) {
    while ($getCategory = $get_category->fetch_assoc()) {
        ?>
                    <li><a
                            href="productbycat.php?catId=<?php echo $getCategory['catId'] ?>"><?php echo $getCategory['catName'] ?></a>
                    </li>
                    <?php
}
}
?>
                </ul>

            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';

?>