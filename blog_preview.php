<?php 
include "app_header.php"; 
if(isset($_REQUEST["blog_reference"])){
    $acc_el = $_REQUEST["blog_reference"];
    $con = Dbcon();
  
    $evpqr = "SELECT * FROM `blogs` WHERE `id`='$acc_el'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) > 0){
            $blog = mysqli_fetch_array($evpr);
            $bt = $blog["title"];
            $bs = $blog["status"];
            $bid = $blog["id"];
            $bcon = $blog["content"];
            $bc = "";
            if($blog["content"] != "none"){
                $myfile = fopen($bcon, "r") or die("Unable to open file!");
                $bc = fread($myfile, filesize($bcon));
                fclose($myfile);
            }
        }else{
            header("location:blog_home.php");
        }
    }else{
        header("location:blog_home.php");
    }
}else{
    header("location:blog_home.php");
}
?>
<body>
    <style type="text/css">
        pre{
            border-radius: 20px !important;
            margin-top: 20px !important;
            margin-bottom: 20px !important;
            box-shadow: 10px 10px 5px #aaaaaa;
        }
        p{
            text-align: justify;
        }
    </style>
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
            <div class="reading-bar"><div class="reading-line bg-highlight"></div></div>
			<div class="blog-post-home">
                <a href="#" class="content-round shadow-small"><img src="images/empty.png" data-src="<?= $blog["cover_img"] ?>" class="blog-image preload-image responsive-image bottom-0 shadow"></a>
                <strong style="width:100%;" class="font-17 full-width">
                    Macbooks are Really Popular
                </strong>
                <span>In:<a href="#" class="color-hightlight">Tech, Gadgets, Laptops</a></span>
                <a href="#" class="blog-post-more bg-highlight shadow-small"><i class="fa fa-bars"></i></a>
            </div>

            <div class="decoration decoration-margins"></div>

            <div class="content reading-time-box">
                <h4 class="color-gray-dark font-12 bottom-30">
                    By <a href="#" class="color-highlight">Enabled</a>  
                    - <span class="reading-time color-highlight"></span> Minutes 
                    - <span class="reading-words color-highlight"></span> Words.
                </h4>

                <?= $bc ?>
            </div>

            <div class="decoration decoration-margins"></div>


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
