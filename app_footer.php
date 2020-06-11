    <div id="menu-bar" data-height="420" class="menu-box menu-bottom">
        <div class="menu-title">
            <span class="color-highlight">Check out our pages</span>
            <h1>Navigation</h1>
            <a href="#" class="menu-hide"><i class="fa fa-times"></i></a>
        </div>
        <div class="menu-page">
            <ul class="menu-list bottom-20">
                <li id="menu-index">
                    <a href="app_home.php">
                        <i class='fa fa-home color-green-dark'></i>
                        <span>Main Page</span>
                        <em>This is where it all Begins</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>  
                <li id="menu-components">
                    <a href="blog_home.php">
                        <i class='fa fa-calendar color-yellow-dark'></i>
                        <span>Blogs</span>
                        <em>Just a Copy and Paste Away</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>   
                <li id="menu-pages">
                    <a href="tips_home.php">
                        <i class='fa fa-id-card color-red-dark'></i>
                        <span>Tips & Tricks</span>
                        <em>Easy to Customize and Use</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>    
                <li id="menu-media">
                    <a href="classes_home.php">
                        <i class='fa fa-graduation-cap color-brown-light'></i>
                        <span>Classes</span>
                        <em>Showcase your Projects with Style</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>      
                <!--<li id="menu-contact">
                    <a href="app_account.php">
                        <i class='fa fa-cog color-blue-dark'></i>
                        <span>My Account</span>
                        <em>Let's get in Touch or Just Say Hello</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li id="menu-components">
                    <a href="app_user_printing.php">
                        <i class='fa fa-print color-yellow-dark'></i>
                        <span>MyPrint  <sup>TM</sup></span>
                        <em>Just a Copy and Paste Away</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li id="menu-pages">
                    <a href="app_user_renting.php">
                        <i class='fa fa-cube color-brown-light'></i>
                        <span>Tenancy</span>
                        <em>Easy to Customize and Use</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li id="menu-pages">
                    <a href="app_forum.php">
                        <i class='fa fa-file color-brown-light'></i>
                        <span>Community Forum</span>
                        <em>Easy to Customize and Use</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li id="menu-components">
                    <a href="app_guest_request.php">
                        <i class='fa fa-user color-yellow-dark'></i>
                        <span>Visitors & Guests</span>
                        <em>Just a Copy and Paste Away</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>-->
            </ul>  
            
            <div class="decoration top-20 bottom-20"></div>
            
            <ul class="menu-list">
            <?php if(isset($_SESSION["active_user"])){ ?>
                <li>
                    <a href="logout.php">
                        <i class='fa fa-lock color-google'></i>
                        <span class='color-google'>Logout</span>
                        <em>This is where it all Begins</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>  
            <?php }else{ ?>
                <li>
                    <a href="app_login.php">
                        <i class='fa fa-lock color-google'></i>
                        <span class='color-google'>Sign In</span>
                        <em>This is where it all Begins</em>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>

        <script type="text/javascript">
            $('#menu-hider, .close-menu, .menu-hide').on('click',function(){
                $('.menu-box').removeClass('menu-box-active');
                $('#menu-hider').removeClass('menu-hider-active');
                return false;
            });
        </script>
    </div>    
    <div class="footer">
        <!--<a href="#" class="footer-logo"></a>-->
        <p class="footer-text">Code-a-lot By Anas Tukur</p>
        <div class="footer-socials">
            <a href="#" class="scale-hover icon icon-round no-border icon-xs bg-facebook border-teal-3d"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="scale-hover icon icon-round no-border icon-xs bg-twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="scale-hover icon icon-round no-border icon-xs bg-google"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="scale-hover icon icon-round no-border icon-xs bg-phone"><i class="fa fa-phone"></i></a>
            <a href="#" data-menu="menu-share" class="scale-hover icon icon-round no-border icon-xs bg-teal-dark"><i class="fa fa-retweet font-15"></i></a>
            <a href="#" class="scale-hover icon icon-round no-border icon-xs back-to-top bg-blue-dark"><i class="fa fa-angle-up font-16"></i></a>
        </div>
        <p class="footer-copyright">Copyright &copy; eBahn Solutions <span id="copyright-year">2017</span>. All Rights Reserved.</p>
    </div>

