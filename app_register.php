<?php include "app_header.php"; ?>
<body>
    
<div id="page-transitions" class="page-build light-skin highlight-blue">    
    <?php include "app_topbar.php"; ?>
    
	<div class="page-content header-clear-large">
		<div class="page-login page-login-full bottom-20">
			<img class="half-img preload-image login-bg responsive-image bottom-30 shadow-medium" src="images/empty.png" data-src="images/pictures/10w.jpg" alt="img">
			<form name="login" action="app_user_action.php" method="post">
                <input type="hidden" name="register" value="register">
                <div class="page-login-field top-15">
    				<i class="fa fa-user color-highlight"></i>
    				<input type="text" name="fullname" placeholder="Select a Username">
    				<em>(required)</em>
    			</div>
    			<div class="page-login-field">
    				<i class="fa fa-at color-highlight"></i>
    				<input type="email" name="account_email" placeholder="Your your Email">
    				<em>(required)</em>
    			</div>
    			<div class="page-login-field">
    				<i class="fa fa-lock color-highlight"></i>
    				<input type="password"  name="account_password" placeholder="Enter a Password">
    				<em>(required)</em>
    			</div>
    			<div class="page-login-field bottom-30">
    				<i class="fa fa-lock color-highlight"></i>
    				<input type="password"  name="cpassword" placeholder="Confirm Password">
    				<em>(required)</em>
    			</div>
            </form>
			<div class="page-login-links bottom-10">
				<a class="forgot center-text" href="page-signup.html"><i class="fa fa-user float-right"></i>Alread registered? Sign in here</a>
				<div class="clear"></div>
			</div>
			<a href="#" onclick="document.login.submit(); return false;" class="button button-green button-full button-rounded button-sm uppercase ultrabold shadow-small ">Register Account</a>
		</div>
		<!--<div class="page-login page-login-full bottom-50">
			<div class="decoration"></div>
			<a href="#" class="button button-social bottom-15 button-full button-sm button-rounded button-icon shadow-small bg-facebook"><i class="fab fa-facebook-f"></i> Connect with Facebook</a>
			<a href="#" class="button button-social bottom-15 button-full button-sm button-rounded button-icon shadow-small bg-twitter"><i class="fab fa-twitter"></i> Connect with Twitter</a>
			<a href="#" class="button button-social bottom-15 button-full button-sm button-rounded button-icon shadow-small bg-google"><i class="fab fa-google-plus-g"></i> Connect with Google Plus</a>
		</div>-->
        
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