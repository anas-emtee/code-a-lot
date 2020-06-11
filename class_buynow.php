<?php 
include "app_header.php"; 

if(isset($_REQUEST["class_reference"])){
    $acc_el = $_REQUEST["class_reference"];
    $con = Dbcon();
  
    $evpqr = "SELECT * FROM `classes` WHERE `id`='$acc_el'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) > 0){
            $class = mysqli_fetch_array($evpr);
            $bt = $class["title"];
            $amt = $class["price"];
            $ci = $class["cover_img"];

            if($class["cover_img"] == "none" && $class["cover_img"] == "None"){
                $ci = "images/placeholders/1.png";
            }

            if($class["promo_flag"] == "1"){
                $amt = $class["promo_price"];
            }

            if($amt == "0"){
                $amt = "Free";
            }

        }else{
            header("location:classes_home.php");
        }
    }else{
        header("location:classes_home.php");
    }
}else{
    header("location:classes_home.php");
}
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	    <?php include "app_topbar.php"; ?>
	    <div class="page-content header-clear-medium ">
            <div class="content">
                <div class="store-featured-1 ">
                    <a href="#">
                        <img src="system/<?= $ci ?>" class="bottom-15" alt="img">
                    </a>
                    <u>$ <?= $amt ?></u>
                    <span class="top-10 color-green-dark"><?= $class["category"] ?></span>
                    <strong><?= $bt ?></strong>
                    <em><?= $class["course_desc"] ?></em>
                    <?php if($class["promo_flag"] == "1"){ ?>
                        <span style="margin-left: 25px;" class="color-green-dark"><del class="color-gray-dark">$ <?= $class["price"] ?></del> Originally</span>
                    <?php } ?>
                </div>
                
                <div class="decoration top-30"></div>

                <div class="content-fullscreen bottom-0">
                    <div class="store-cart-total">
                        <strong class="font-14">Subtotal</strong>
                        <span class="font-14">$ <?= $amt ?></span>
                        <div class="clear"></div>
                    </div>
                    <!--<div class="store-cart-total">
                        <strong class="font-14">Shipping</strong>
                        <span class="font-14">$ 150</span>
                        <div class="clear"></div>
                    </div>
                    <div class="store-cart-total">
                        <strong class="font-14 color-highlight">Discount</strong>
                        <span class="font-14 color-highlight">- $ 350</span>
                        <div class="clear"></div>
                    </div>-->
                    <div class="store-cart-total half-top bottom-20">
                        <strong class="font-15 uppercase ultrabold">Grand Total</strong>
                        <span class="font-15 uppercase ultrabold">$ <?= $amt ?></span>
                        <div class="clear"></div>
                    </div>
                    <div class="decoration"></div>
                    
                    <?php if($amt == "Free" || $amt == "0"){ ?>
                        <p class="text-center">
                            Support us by telling your friends about us or sharing your experience on Code-a-lot. It will mean alot to us.
                        </p>
                        <div class="d-flex p-3  justify-content-center">
                            <div class="p-2">
                                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="I just bought a joined a class titled bla bla bla on code-a-lot go to www.code-a-lot.com to see more" data-url="http://www.code-a-lot.com" data-via="@code-a-lot" data-hashtags="#code-a-lot" data-show-count="false">Tweet</a>
                            </div>
                            <div class="p-2">
                                <a href="https://twitter.com/anas_emtee?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-show-screen-name="false" data-show-count="false">Follow</a>
                            </div>
                        </div>
                        <div class="d-flex  justify-content-center">
                            <div class="p-2">
                                <div class="g-ytsubscribe" data-channel="GoogleDevelopers" data-layout="large" data-count="none"></div>
                            </div>
                        </div>
                        <a href="#" class="button button-blue button-rounded button-full button-sm ultrabold uppercase shadow-small">
                            Get Class Free
                        </a>
                        <!--<div class="center-icons center-3-icons">
                            <a href="#" class="icon icon-xs bg-facebook shadow-small icon-round"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="icon icon-xs bg-twitter shadow-small icon-round"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="icon icon-xs bg-whatsapp shadow-small icon-round"><i class="fab fa-whatsapp"></i></a>
                        </div>-->
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <script src="https://apis.google.com/js/platform.js"></script>

                    <?php }else{ ?>
                        <a href="#" class="button button-blue button-rounded button-full button-sm ultrabold uppercase shadow-small">
                            Proceed to Checkout
                        </a>
                    <?php } ?>
                </div>

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
