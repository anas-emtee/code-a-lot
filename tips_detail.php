<?php 
include "app_header.php"; 
if(isset($_REQUEST["tip_reference"])){
    $acc_el = $_REQUEST["tip_reference"];
    $con = Dbcon();
  
    $evpqr = "SELECT * FROM `tips` WHERE `id`='$acc_el'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) > 0){
            $blog = mysqli_fetch_array($evpr);
            $bt = $blog["title"];
            $bs = $blog["status"];
            $bid = $blog["id"];
            $bo = $blog["author"];
            $bcon = $blog["content"];
            if($blog["content"] != "none"){
                $myfile = fopen($bcon, "r") or die("Unable to open file!");
                $bc = fread($myfile, filesize($bcon));
                fclose($myfile);
            }
            $ur = mysqli_query($con, "SELECT * FROM `registered_users` WHERE `id`='$bo'");
            $user = mysqli_fetch_array($ur);

        }else{
            header("location:tips_home.php");
        }
    }else{
        header("location:tips_home.php");
    }
}else{
    header("location:tips_home.php");
}

$isSaved = false;
$isLiked = false;

if(isset($_SESSION["active_user"])){
    $uid = $_SESSION["active_user"]["id"];
    $isSaved = checkSaved($acc_el, "tips", $uid);
    $isLiked = checkLiked($acc_el, "tips", $uid);
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
        .mr{
            margin-right: 5px;
        }
        .black{
            color: grey !important;
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
                <?php if($blog["cover_img"] != "none" && $blog["cover_img"] != "None"){ ?>
                    <a href="#" class="content-round shadow-small bottom-30">
                        <img src="images/empty.png" data-src="<?= $blog["cover_img"] ?>" class="blog-image preload-image responsive-image bottom-0 shadow">
                    </a>
                <?php } ?>
                <strong style="width:100%;" class="font-17 full-width">
                    <?= $blog["title"] ?>
                </strong>
                <span>
                    Covered: <a href="#" class="color-hightlight"><?= $blog["topics"] ?></a>
                    <!--<br />Category: <?= $blog["category"] ?>-->
                </span>
                <a data-menu="sheet-options-3" href="#" class="blog-post-more bg-highlight shadow-small"><i class="fa fa-bars"></i></a>
                <a data-menu="menu-comment" href="#" class="blog-post-more bg-highlight shadow-small" style="margin-right: 50px;"><i class="fa fa-comments"></i></a>
            </div>

            <div class="decoration decoration-margins"></div>

            <div class="content reading-time-box">
                <h4 class="color-gray-dark font-12 bottom-30">
                    By <a href="#" class="color-highlight"><?= $user["username"] ?></a>  
                    - <span class="reading-time color-highlight"></span> Minutes 
                    - <span class="reading-words color-highlight"></span> Words.
                </h4>

                <?= $bc ?>
            </div>

            <div class="decoration decoration-margins"></div>
            <div class="content">
                <a href="#" data-menu="menu-comment" class="button shadow-medium button-rounded button-full button-blue2-3d button-blue2 uppercase ultrabold"><i class="mr fa fa-comments"></i> Comment and Review</a>
            </div>
            <?php include "app_footer.php"; ?>
        </div>
        <a href="#" class="back-to-top-badge back-to-top-small bg-highlight"><i class="fa fa-angle-up"></i>Back to Top</a>
        <div id="sheet-options-3" class="menu-box menu-bottom bg-transparent">
            <div class="menu-wrapper">
                <div class="menu-title bottom-20">
                    <span class="color-highlight">Before we continue</span>
                    <h1>Blog Options</h1>
                </div>
                <!--<div class="content">
                    <p>
                        Please select an option to continue. Just tap the button you want to select. Add anything you want here.
                    </p>
                </div>-->
            </div>
            <?php if((int)$isLiked  == 0){ ?>
                <a href="tips_action.php?action=like&element=<?= $acc_el ?>&element_type=tips" class="color-highlight button button-full button-rounded button-sm button-white uppercase ultrabold top-10">
                    Like &nbsp;&nbsp;&nbsp;<i class="fa fa-heart"></i>
                </a>
            <?php }else{ ?>
                <a href="#" class="color-highlight button button-full button-rounded button-sm button-white uppercase ultrabold top-10">
                    Liked &nbsp;&nbsp;&nbsp;<i class="fa fa-heart"></i>
                </a>
            <?php } ?>
            <?php if((int)$isSaved == 0){ ?>
                <a href="tips_action.php?action=save&element=<?= $acc_el ?>&element_type=tips" class="color-highlight button button-full button-rounded button-sm button-white uppercase ultrabold top-10">
                    Save &nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark"></i>
                </a>
            <?php }else{ ?>
                <a href="#" class="color-highlight button button-full button-rounded button-sm button-white uppercase ultrabold top-10">
                    Saved &nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark"></i>
                </a>
            <?php } ?>
            <a href="#" class="close-menu color-red-dark button button-full button-rounded button-sm button-white uppercase ultrabold top-30">Cancel</a>
        </div>
        <div id="menu-comment" data-height="90vh" class="menu-box menu-bottom">
            <div class="menu-title">
                <span class="color-highlight">Join the discussion</span>
                <h1>Post a Comment / Review</h1>
                <a href="#" class="menu-hide"><i class="fa fa-times"></i></a>
            </div>
            <div class="content top-20">
                <?php if(isset($_SESSION["active_user"])){ ?>
                <div class="accordion accordion-style-0">
                    <div class="accordion-border">
                        <a href="#" class="font-14" data-accordion="accordion-11">Post Comment<i class="fa fa-2x fa-comments"></i></a>
                        <div class="accordion-content" id="accordion-11">
                            <div class="content">
                                <form action="tips_action.php" method="post">
                                    <input type="hidden" name="user" value="<?= $_SESSION["active_user"]["id"] ?>" />
                                    <input type="hidden" name="item" value="<?= $acc_el ?>" />
                                    <input type="hidden" name="item_type" value="tips" />
                                    <input type="hidden" name="rating" value="0" />
                                    <input type="hidden" name="post" value="comment" />
                                    
                                    <div class="input-simple-1 textarea has-icon bottom-30">
                                        <strong>Required Field</strong>
                                        <i class="fa fa-edit"></i>
                                        <em class="color-highlight">Enter your Review</em>
                                        <textarea class="textarea-simple-1" name="content" required="" placeholder="Expanding Text Area"></textarea>
                                    </div>
                                    <div class="clear"></div>
                                    <button type="submit" name="post_now" class="button shadow-medium button-rounded button-full button-green-3d button-green uppercase ultrabold">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-border">
                        <a href="#" class="font-14" data-accordion="accordion-22">Post Review <i class="fa fa-2x fa-star"></i></a>
                        <div class="accordion-content" id="accordion-22">
                            <div class="content-title bottom-30 top-30">
                                <span class="color-highlight">Input Style</span>
                                <h1>Post A Review</h1>
                            </div>

                            <div class="container left-20">
                                <div class="row lead">
                                    <div id="stars" class="starrr"></div>
                                    You gave a rating of <span id="count">0</span> star(s)
                                </div>
                            </div>
                            
                            <div class="content">
                                <form action="tips_action.php" method="post">
                                    <input type="hidden" name="user" value="<?= $_SESSION["active_user"]["id"] ?>" />
                                    <input type="hidden" name="item" value="<?= $acc_el ?>" />
                                    <input type="hidden" name="item_type" value="tips" />
                                    <input type="hidden" name="post" value="review" />
                                    <div class="input-simple-1 has-icon input-green bottom-30">
                                        <strong>Star Rating</strong>
                                        <em class="color-highlight">Your Rating</em>
                                        <i class="fa fa-star-o"></i>
                                        <input id="counti" readonly="" required="" name="rating" type="number" placeholder="Your Rating">
                                    </div>
                                    
                                    <div class="input-simple-1 textarea has-icon bottom-30">
                                        <strong>Required Field</strong>
                                        <i class="fa fa-edit"></i>
                                        <em class="color-highlight">Enter your Review</em>
                                        <textarea class="textarea-simple-1" name="content" required="" placeholder="Expanding Text Area"></textarea>
                                    </div>
                                    <div class="clear"></div>
                                    <button type="submit" name="post_now" class="button shadow-medium button-rounded button-full button-green-3d button-green uppercase ultrabold">Post Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
                <?php }else{ ?>
                    <ul class="menu-list bottom-20">
                        <li>
                            <a href="app_login.php?from=blog_detail.php?blog_reference=<?= $acc_el ?>">
                                <i class='fa fa-lock color-google'></i>
                                <span class='color-google'>Sign In</span>
                                <em>This is where it all Begins</em>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
                <div class="decoration"></div>
                <?php
                    $con = Dbcon();
  
                    $upqr = "SELECT * FROM `user_elements_post` WHERE `item`='$acc_el' AND `item_type`='tips'";
                    if($upr = mysqli_query($con, $upqr)){
                        if(mysqli_num_rows($upr) > 0){
                            while($post = mysqli_fetch_array($upr)){
                                $pt = $post["post"];
                                $ui = $post["user"];
                                $usr = mysqli_query($con, "SELECT * FROM `registered_users` WHERE `id`='$ui'");
                                $usinfo = mysqli_fetch_array($usr);
                                if($pt == "review"){
                                    $r = $post["rating"];

                ?>
                    <div class="review-4 container">
                        <h1 class="bold"><?= $post["rating"] ?>.00</h1>
                        <h2 class="thiner"><?= $usinfo["username"] ?>:</h2>
                        <div class="review-stars">
                            <?php for ($i=1; $i <= 5; $i++) { 
                                if($i <= $r){ ?>
                                <i class="fa fa-star"></i>
                            <?php }else{ ?>
                                <i class="fa fa-star black"></i>
                            <?php }} ?>
                        </div>
                        <img alt="img" class="preload-image" src="<?= $usinfo["profile_img"] ?>">
                        <p class="text-justify">
                            <?= $post["comment"] ?>
                        </p>
                    </div>
                    <div class="decoration"></div>
                <?php } else if($pt == "comment"){ ?>
                    <div class="review-4 container">
                        <h3 class="bold"><?= $usinfo["username"] ?>:</h3>
                        <h2 class="thiner">&nbsp;</h2>
                        
                        <img alt="img" class="preload-image" src="<?= $usinfo["profile_img"] ?>">
                        <p style="margin-top: 30px;" class="text-justify">
                            <?= $post["comment"] ?>
                        </p>
                    </div>
                    <div class="decoration"></div>
                <?php } } }else{ ?>
                    <div class="review-4 container">
                        <h3 class="bold">No Comments</h3>
                        <h2 class="thiner">&nbsp;</h2>
                        <p>
                            Start by Posting One here
                        </p>
                    </div>
                    <div class="decoration"></div>
                <?php } } ?>
            </div>
        </div>
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
<script>
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='mr fa fa-3x .fa-star-o'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('fa-star-o').addClass('fa-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('fa-star').addClass('fa-star-o');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('fa-star').addClass('fa-star-o');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
    $('#count').html(value);
    document.getElementById("counti").value = value;
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
  });
});
</script>
<script src="scripts/prism.min.js"></script>
</body>
</html>
