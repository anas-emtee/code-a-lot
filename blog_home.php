<?php include "app_header.php"; ?>
<body>
    
	<div id="preloader" class="preloader-light">
	    <h1></h1>
	    <div id="preload-spinner"></div>
	    <p>The Ultimate Mobile Experience</p>
	    <em>This will only take a second. It's totally worth it!</em>
	</div>
	        
	<div id="page-transitions" class="page-build light-skin highlight-blue">    
    	<!-- Import Style Here to Decrease Overall Load Time of Pages -->
        <link rel="stylesheet" type="text/css" href="styles/framework-blog.css">   
	    <?php include "app_topbar.php"; ?>
	    <div class="page-content header-clear-medium ">
            <?php
            $con = Dbcon();
            $evpqr = "SELECT * FROM `blogs` WHERE status='published'";
            if($evpr = mysqli_query($con, $evpqr)){
                if(mysqli_num_rows($evpr) > 0){
                    while($blog = mysqli_fetch_array($evpr)){
                        $bo = $blog["author"];
                        $ur = mysqli_query($con, "SELECT * FROM `registered_users` WHERE `id`='$bo'");
                        $user = mysqli_fetch_array($ur);
            ?>
			<div class="blog-post-home">
                <?php if($blog["cover_img"] != "none" && $blog["cover_img"] != "None"){ ?>
                    <a href="#" class="content-round shadow-small bottom-30">
                        <img src="images/empty.png" data-src="<?= $blog["cover_img"] ?>" class="blog-image preload-image responsive-image bottom-0 shadow">
                    </a>
                <?php } ?>
                <strong class="font-17"><?= $blog["title"] ?></strong>
                <p><?= $blog["descr"] ?></p>
                <span>In:<a href="#" class="color-hightlight"> <?= $blog["topics"] ?></a></span>
                <div class="blog-post-stats">
                    <a href="#"><i class="fa fa-heart color-red-light"></i><?= $blog["likes"] ?></a>
                    <a href="#"><i class="fa fa-eyhe color-blue-light"></i><?= $blog["views"] ?></a>
                    <a href="#"><i class="fa fa-comments color-brown-light"></i><?= $blog["saves"] ?></a>
                    <div class="clear"></div>
                </div>
                <p> </p>
                <a href="#" class="blog-post-home-author">
                    <img src="images/empty.png" data-src="<?= $user["profile_img"] ?>" class="preload-image responsive-image shadow-small">
                    <span>By: <u class="color-blue-dark"><?= $user["username"] ?></u></span>
                    <em><?= explode(" ", $blog["published"])[0] ?></em>
                </a>
                <a href="blog_detail.php?blog_reference=<?= $blog["id"] ?>" class="blog-post-more bg-green-dark shadow-small"><i class="fa fa-angle-right"></i></a>
            </div>
            <div class="decoration decoration-margins"></div>
            <?php }}} ?>

            <div class="content">
                <div class="blog-categories blog-categories-3 bottom-20">
                    <a href="#"><strong></strong><em>Tech</em><span class="bg-red-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/1s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Nutrition</em><span class="bg-green2-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/2s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Web</em><span class="bg-teal-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/3s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Design</em><span class="bg-blue2-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/4s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Colors</em><span class="bg-gray-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/5s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>HTML</em><span class="bg-blue-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/6s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Mobile</em><span class="bg-pink-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/7s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>CSS</em><span class="bg-magenta-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/8s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <a href="#"><strong></strong><em>Gadgets</em><span class="bg-brown-dark opacity-50"></span><img src="images/empty.png" data-src="images/pictures/9s.jpg" class="preload-image responsive-image" alt="img"></a>
                    <div class="clear"></div>
                </div>
            
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
