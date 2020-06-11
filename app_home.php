<?php 
include "app_header.php"; 

$con = Dbcon();
$evpqr = "SELECT * FROM `indexed_elements` WHERE status='1'";
$evpr = mysqli_query($con, $evpqr) or die(mysqli_error($con));
$evpr1 = mysqli_query($con, $evpqr) or die(mysqli_error($con));
$count = mysqli_num_rows($evpr);
?>
<body>
    
	<div id="preloader" class="preloader-light">
	    <h1></h1>
	    <div id="preload-spinner"></div>
	    <p>The Ultimate Mobile Experience</p>
	    <em>This will only take a second. It's totally worth it!</em>
	</div>
	        
	<div id="page-transitions" class="page-build light-skin highlight-blue">    
    	<link rel="stylesheet" type="text/css" href="styles/framework-news.css">   
	    <?php include "app_topbar.php"; ?>
	    <div class="page-content header-clear-medium ">
			<div class="single-slider owl-carousel owl-no-dots bottom-30">
				<?php
                if($count > 0){
                    while($row = mysqli_fetch_array($evpr)){
                        $bo = $row["item"];
                        $bt = $row["item_type"];
                        $ur = mysqli_query($con, "SELECT * FROM `$bt` WHERE `id`='$bo'");
                        $blog = mysqli_fetch_array($ur);
                        $aurl = "blog_detail.php?blog_reference=".$blog["id"];
                        if($bt == "classes"){
                        	$aurl = "class_detail.php?blog_reference=".$blog["id"];
                        }
	            ?>
				<a href="<?= $aurl ?>" class="news-slide-1 content-round shadow-small">
					<img src="<?= $blog["cover_img"] ?>" data-src-retina="<?= $blog["cover_img"] ?>" class="blog-image rounded-image" alt="">
					<strong class="font-16"><?= $blog["title"] ?></strong>
					<em class="bg-red-dark"><?= $blog["category"] ?></em>
					<i class="fa fa-angle-right"></i>
					<span class="overlay overlay-gradient"></span>
				</a>
				<?php }} ?>
			</div>
			<div class="content">
				<?php
                if($count > 0){
                    while($row = mysqli_fetch_array($evpr1)){
                    	$bo = $row["item"];
                        $bt = $row["item_type"];
                        $ur = mysqli_query($con, "SELECT * FROM `$bt` WHERE `id`='$bo'");
                        $blog = mysqli_fetch_array($ur);
                        $aurl = "blog_detail.php?blog_reference=".$blog["id"];
                        if($bt == "classes"){
                        	$aurl = "class_detail.php?blog_reference=".$blog["id"];
                        }
                ?>
				<div class="news-list-item">
					<a href="<?= $aurl ?>">
						<img class="preload-image rounded-image shadow-medium" src="images/empty.png" data-src="<?= $blog["cover_img"] ?>" alt="img">
						<strong><?= $blog["title"] ?></strong>
					</a>
					<span><i class="fas fa-clock"></i><?= explode(" ", $blog["published"])[0] ?> <a href="#" class="color-blue-dark"><?= $blog["category"] ?></a></span>
				</div>
				<?php }} ?>

				<!--<div class="one-half">
					<div class="news-col-item">
						<a href="#">
							<img class="preload-image rounded-image shadow-medium bottom-15" src="images/empty.png" data-src="images/pictures/8s.jpg" alt="img">
							<em class="bg-blue-dark">Technology</em>
							<strong>Macbooks are selling better with the release of MacOS High Sierra</strong>
						</a>
						<span><i class="fas fa-clock"></i>30 Dec 2019</span>
					</div>
					<div class="news-col-item bottom-0">
						<a href="#">
							<img class="preload-image rounded-image shadow-medium bottom-15" src="images/empty.png" data-src="images/pictures/5s.jpg" alt="img">
							<em class="bg-red-dark">Nutrition</em>
							<strong>Strawberries are an incredibly tasty source of fibers.</strong>
						</a>
						<span><i class="fas fa-clock"></i>30 Dec 2019</span>
					</div>
				</div>
				<div class="one-half last-column">
					<div class="news-col-item">
						<a href="#">
							<img class="preload-image rounded-image shadow-medium bottom-15" src="images/empty.png" data-src="images/pictures/7s.jpg" alt="img">
							<em class="bg-green-dark">Technology</em>
							<strong>Drinking 50 cups of coffee will not make you stop sleeping!</strong>
						</a>
						<span><i class="fas fa-clock"></i>30 Dec 2019</span>
					</div>
					<div class="news-col-item bottom-0">
						<a href="#">
							<img class="preload-image rounded-image shadow-medium bottom-15" src="images/empty.png" data-src="images/pictures/6s.jpg" alt="img">
							<em class="bg-yellow-dark">Photography</em>
							<strong>A camera that looks stunning after all these years!</strong>
						</a>
						<span><i class="fas fa-clock"></i>30 Dec 2019</span>
					</div>
				</div>-->
				<div class="clear"></div>
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
