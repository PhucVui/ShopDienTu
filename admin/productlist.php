<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../config/loadfile.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>

<?php
$pd = new product();
if (isset($_GET['delId'])) {
    $id = $_GET['delId'];
    $delPro = $pd->delete_product($id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">
            <?php
if (isset($delPro)) {
    echo $delPro;
}
?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$pd = new product();
$show_prod = $pd->show_product();
if ($show_prod) {
    $i = 0;
    while ($result = $show_prod->fetch_assoc()) {
        $i++;
        ?>
                    <tr class="odd gradeX">
                        <td> <?php echo $i ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><?php echo $result['price'] ?></td>
                        <td><img src="uploads/<?php echo $result['image'] ?>" hight="50" , width="50"></td>
                        <td>
                            <?php
if ($result['type'] == 0) {
            echo 'Nổi bật';
        } else {
            echo 'Không nổi bật';
        }

        ?>
                        </td>
                        <td><?php echo $result['catName'] ?></td>
                        <td><?php echo $result['brandName'] ?></td>
                        <td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure delete?')"
                                href="?delId=<?php echo $result['productId'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
}
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