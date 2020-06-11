<?php 
include "app_header.php"; 

$con = Dbcon();
$classes_res = mysqli_query($con, "SELECT * FROM `classes` ORDER BY `title` ASC")or die(mysqli_error($con));
$popular_res = mysqli_query($con, "SELECT * FROM `classes` ORDER BY `views` DESC LIMIT 10")or die(mysqli_error($con));
$cover_res = mysqli_query($con, "SELECT * FROM `classes` WHERE `cover_flag`=1 ORDER BY `title` ASC")or die(mysqli_error($con));
$class_count = mysqli_num_rows($classes_res);
$pop_count = mysqli_num_rows($classes_res);
$cover_count = mysqli_num_rows($classes_res);
?>
<body>
    
	<div id="preloader" class="preloader-light">
	    <h1></h1>
	    <div id="preload-spinner"></div>
	    <p>The Ultimate Mobile Experience</p>
	    <em>This will only take a second. It's totally worth it!</em>
	</div>
	        
	<div id="page-transitions" class="page-build light-skin highlight-blue">    
    	<link rel="stylesheet" type="text/css" href="styles/framework-store.css">
	    <?php include "app_topbar.php"; ?>
        <div class="page-content header-clear-small">
        
        <div class="single-slider owl-carousel owl-no-dots">
            <?php
            if($cover_count > 0){
                while($row = mysqli_fetch_array($cover_res)){
            ?>
            <div class="store-slide-1">
                <a href="#" class="store-slide-image">
                    <img class="half-image" style="border-radius: 15px;" src="system/<?= $row["cover_img"] ?>" alt="">
                </a>
                <div class="store-slide-title bottom-15">
                    <h4 class="bottom-10 center-text"><?= $row["title"] ?></h4>
                    <em class="color-gray-dark small-text center-text"><?= $row["course_desc"] ?></em>
                </div>
                <div class="store-slide-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="store-slide-price">
                    <?php if($row["promo_flag"] == "1"){ ?>
                    <strong>$ <?= $row["promo_price"] ?><br> <del>$ <?= $row["price"] ?></del></strong>
                    <?php }else{ ?>
                    <strong>$ <?= $row["price"] ?></strong>
                    <?php } ?>
                    <a href="#">
                        <i class="fa fa-square color-orange-dark"></i><?= $row["category"] ?>
                        <em class="color-green-dark">Level - <?= $row["course_level"] ?></em>
                    </a>
                    <div class="clear"></div>
                </div>
                <div class="store-slide-button">
                    <a href="class_detail.php?class_reference=<?= $row["id"] ?>" class="button button-blue button-center button-rounded button-full button-sm shadow-small uppercase ultrabold">View Details</a>
                </div>
            </div>
            <?php } }else{ ?>
            <div class="store-slide-1">
                <a href="#" class="store-slide-image">
                    <img src="images/placeholders/2.png" alt="" class="half-image">
                </a>
                <div class="store-slide-title bottom-15">
                    <h4 class="bottom-0 center-text">White Smart Watch</h4>
                    <em class="color-gray-dark small-text center-text">Sport Band, Water Proof, 132 GB, Black</em>
                </div>
                <div class="store-slide-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="store-slide-price">
                    <strong>$299.99<br> <del>$ 399.99</del></strong>
                    <a href="#"><i class="fa fa-heart color-orange-dark"></i>Add to Wishlist<em class="color-red-dark">We're currently out of Stock</em></a>
                    <div class="clear"></div>
                </div>
                <div class="store-slide-button">
                    <a href="#" class="button button-blue button-center button-rounded button-full button-sm shadow-small uppercase ultrabold">Add to Cart</a>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="decoration decoration-margins top-30 bottom-10"></div>

        <div class="content bottom-0">
            <div class="single-slider owl-carousel owl-no-dots">
                <?php
                if($pop_count > 0){
                    while($row = mysqli_fetch_array($popular_res)){
                ?>
                <div class="store-slide-2">
                    <a href="class_detail.php?class_reference=<?= $row["id"] ?>" class="store-slide-image">
                        <img style="border-radius: 15px;" src="system/<?= $row["cover_img"] ?>">
                    </a>
                    <div class="store-slide-title">
                        <strong><?= $row["title"] ?></strong>
                        <em class="color-gray-dark"><?= $row["course_desc"] ?></em>
                    </div>
                    <div class="store-slide-button">
                        <strong>$<?= $row["price"] ?></strong>
                        <a href="class_detail.php?class_reference=<?= $row["id"] ?>"><i class="fa fa-info-circle color-blue-dark"></i>View Details</a>
                    </div>
                </div>
                <?php } }else{ ?>
                <div class="store-slide-2">
                    <a href="#" class="store-slide-image">
                        <img src="images/placeholders/2a.png">
                    </a>
                    <div class="store-slide-title">
                        <strong>White Smart Watch</strong>
                        <em class="color-gray-dark">Sport Band, Water and Dust Resistant, Large Storage Capacity</em>
                    </div>
                    <div class="store-slide-button">
                        <strong>$359.99</strong>
                        <a href="#"><i class="fa fa-shopping-cart color-blue-dark"></i>Add to Cart</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="decoration decoration-margins"></div>

        <div class="content-title bottom-0 top-30">
            <span class="color-highlight">Some of the best</span>
            <h1>All Classes</h1>
        </div>

        <div class="decoration decoration-margins"></div>

	    <div class="content">
                <?php
                if($class_count > 0){
                    while($row = mysqli_fetch_array($classes_res)){
                ?>
                <a href="class_detail.php?class_reference=<?= $row["id"] ?>">
                    <div class="store-cart-1">
                        <img class="preload-image" style="border-radius: 15px;" src="images/empty.png" data-src="system/<?= $row["cover_img"] ?>" alt="img">
                        <strong style="margin-left: 30px;"><?= $row["title"] ?></strong>
                        <span style="margin-left: 30px;" class="color-gray-dark">
                            <?= $row["course_desc"] ?>
                            <br /><br />
                            <?php if($row["promo_flag"] == "1"){ ?>
                                <del class="color-gray-dark">$<?= $row["price"] ?></del>
                                <i class="color-green-dark">On Sale</i>
                            <?php }else{ ?>
                                <i class="color-green-dark"> <?= $row["category"] ?> </i>
                            <?php } ?>
                        </span>
                        <?php if($row["promo_flag"] == "1"){ ?>
                            <em style="margin-left: 30px;">$<?= $row["promo_price"] ?></em>
                        <?php }else{ ?>
                            <em style="margin-left: 30px;">$<?= $row["price"] ?></em>
                        <?php } ?>
                    </div>
                </a>
                <div class="decoration top-30"></div>
                <?php } }else{ ?>
                <div class="store-cart-1">
                    <img class="preload-image" src="images/empty.png" data-src="images/placeholders/5.png" alt="img">
                    <strong>Large SmartPhone, 32 GB Capacity, White</strong>
                    <span class="color-blue-dark"><i class="fa fa-truck"></i> Free Shipping</span>
                    <em>$1099</em>
                </div>
                <div class="decoration top-30"></div>
                <?php } ?>
        </div>

        <?php include "app_footer.php"; ?>
    </div>
    <a href="#" class="back-to-top-badge back-to-top-small bg-highlight"><i class="fa fa-angle-up"></i>Back to Top</a>
    <div id="menu-share" data-height="420" class="menu-box menu-bottom">
        <div class="menu-title">
            <span class="color-highlight">Just tap to share</span>
            <h1>Sharing is Caring</h1>
            <a href="#" class="menu-hide"><i class="fa fa-times"></i></a>
        </div>
        <div class="sheet-share-list">
            <a href="#" class="shareToFacebook"><i class="fab fa-facebook-f bg-facebook"></i><span>Facebook</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToTwitter"><i class="fab fa-twitter bg-twitter"></i><span>Twitter</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToLinkedIn"><i class="fab fa-linkedin-in bg-linkedin"></i><span>LinkedIn</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToGooglePlus"><i class="fab fa-google-plus-g bg-google"></i><span>Google +</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToPinterest"><i class="fab fa-pinterest-p bg-pinterest"></i><span>Pinterest</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToWhatsApp"><i class="fab fa-whatsapp bg-whatsapp"></i><span>WhatsApp</span><i class="fa fa-angle-right"></i></a>
            <a href="#" class="shareToMail no-border bottom-5"><i class="fas fa-envelope bg-mail"></i><span>Email</span><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>      

<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/plugins.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
</body>
</html>
