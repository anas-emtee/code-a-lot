<?php include "system_header.php"; ?>

<body class="dark-edition">
  <div class="wrapper ">
    <?php include "system_sidebar.php"; ?>

    <div class="main-panel">
      <?php 
        $page_navbar_title = "Manage Blogs";
        include "system_navbar.php"; 
      ?>
      
      <div class="content">
        <div class="container-fluid" style="padding-top: 0px !important;">
          <!-- your content here -->
          <div class="row">

            <?php 
            $con = Dbcon();
  
            $evpqr = "SELECT * FROM `tips`";
            if($evpr = mysqli_query($con, $evpqr)){
                if(mysqli_num_rows($evpr) > 0){
                    while($blog = mysqli_fetch_array($evpr)){
            ?>
            <div class="col-md-4">
              <div class="card card-profile">
                <!--<div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="../<?= $blog["cover_img"] ?>" />
                  </a>
                </div>-->
                <div class="card-body">
                  <h6 class="card-category"><?= $blog["category"] ?></h6>
                  <h4 class="card-title"><?= substr($blog["title"], 0, 50) ?></h4>
                  <p class="card-description" style="min-height: 50px;">
                    <?= substr($blog["descr"], 0, 200) ?>
                  </p>
                  <a href="tip_compose.php?blog_reference=<?= $blog["id"] ?>" class="btn btn-primary btn-round"><i class="fa fa-edit"></i></a>
                  <a href="tip_compose.php?blog_reference=<?= $blog["id"] ?>" class="btn btn-info btn-round"><i class="fa fa-eye"></i></a>
                  <?php if($blog["status"] == "published"){ ?>
                    <a href="tip_compose.php?blog_reference=<?= $blog["id"] ?>" class="btn btn-danger btn-round"><i class="fa fa-ban"></i></a>
                  <?php } ?>
                </div>
              </div>
            </div>

            <?php }}} ?>
            <div class="col-md-4">
              <div class="card card-profile">
                <!--<div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="../<?= $blog["cover_img"] ?>" />
                  </a>
                </div>-->
                <div class="card-body">
                  <h6 class="card-category">New</h6>
                  <h4 class="card-title">Create A New Tip/Trick</h4>
                  <p class="card-description" style="min-height: 50px;">
                    Create a beautiful blog that fits your style. Choose from a selection of easy-to-use templates or design something new.
                  </p>
                  <a href="tips_startup.php" class="btn btn-primary btn-round">Start New</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <?php include "system_footer.php"; ?>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
  
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>