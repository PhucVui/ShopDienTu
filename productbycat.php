<?php
include 'inc/header.php';
?>
<?php

if (!isset($_GET['catId']) || $_GET['catId'] == null) {
    echo "<script>window.location = '404.php'</script>";
} else {
    $id = $_GET['catId'];
}
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $brandName = $_POST['brandName'];
//     $updateBrand = $brand->update_brand($brandName, $id);
// }
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <?php
$name_cat = $cat->get_name_cat($id);
if ($name_cat) {
    while ($result_name = $name_cat->fetch_assoc()) {
        ?>
            <div class="heading">
                <h3>Category : <?php echo $result_name['catName'] ?></h3>
            </div>
            <?php
}}
?>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
$productbycat = $cat->get_product_by_cat($id);
if ($productbycat) {
    while ($result = $productbycat->fetch_assoc()) {
        ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php"><img style="height:150;width:100"
                        src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                <h2><?php echo $result['productName'] ?></h2>
                <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                <p><span class="price"><?php echo number_format($result['price'], 0, '', '.') . 'đ' ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>"
                            class="details">Details</a></span></div>
            </div>
            <?php
}
} else {
    echo '<span class="success">Category is currently Empty</span>';
}

?>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';

?>