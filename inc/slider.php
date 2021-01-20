<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
$get_lastestDell = $product->getLastestDell();
if ($get_lastestDell) {
    while ($resultdell = $get_lastestDell->fetch_assoc()) {
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultdell['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>DELL</h2>
                    <p><?php echo $resultdell['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultdell['productId'] ?>">Add to
                                cart</a></span></div>
                </div>
            </div>
            <?php
}
}
?>
            <?php
$get_lastestsam = $product->getLastestSamsung();
if ($get_lastestsam) {
    while ($resultsam = $get_lastestsam->fetch_assoc()) {
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"><img src="admin/uploads/<?php echo $resultsam['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>SAMSUNG</h2>
                    <p><?php echo $resultsam['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultsam['productId'] ?>">Add to
                                cart</a></span></div>
                </div>
            </div>
        </div>
        <?php
}
}
?>
        <div class="section group">
            <?php
$get_lastestHa = $product->getLastestHawei();
if ($get_lastestHa) {
    while ($resultha = $get_lastestHa->fetch_assoc()) {
        ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultha['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Hawei</h2>
                    <p><?php echo $resultha['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultha['productId'] ?>">
                                Add to cart</a></span></div>
                </div>
            </div>
            <?php
}
}
?>
            <?php
$get_lastestLG = $product->getLastestLG();
if ($get_lastestLG) {
    while ($resultlg = $get_lastestLG->fetch_assoc()) {
        ?>

            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php"><img src="admin/uploads/<?php echo $resultlg['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>LG</h2>
                    <p><?php echo $resultlg['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $resultlg['productId'] ?>">Add to
                                cart</a></span></div>
                </div>
            </div>
        </div>
        <?php
}
}
?>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                    <li><img src="images/4.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>