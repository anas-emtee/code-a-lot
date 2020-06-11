<?php include "system_header.php"; ?>

<body class="dark-edition">
  <div class="wrapper ">
    <?php include "system_sidebar.php"; ?>

    <div class="main-panel">
      <?php 
        $page_navbar_title = "Start A new Tip/Trick";
        include "system_navbar.php"; 
      ?>
      
      <div class="content">
        <div class="container-fluid" style="padding-top: 0px !important;">
          <!-- your content here -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">New Tip/Trick</h4>
                  <p class="card-category">Start a New Tip/Trick</p>
                </div>
                <div class="card-body">
                  <form action="tip_action.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user" value="1">
                    <div class="row" style="margin-bottom: 20px;">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Blog Title</label>
                          <input type="text" name="blog_title" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                            <a href="#" onclick="fileUpload();">
                              <div class="thumbnail" style="border:solid 1px #ebeadc; border-radius: 20px; box-shadow: 2px 4px #888888;">
                                <div class="img-responsive">
                                  <img id="prev" src="../images/placeholders/1.png" style="width: 100%; border-radius: 20px;" class="img-responsive" />
                                </div>
                              </div>
                            </a>
                          </div>
                          <div class="col-md-9">
                            <div class="form-group">
                              <!--<label class="bmd-label-floating">Blog Category</label>-->
                              <select name="category" required="" class="form-control">
                                <option value="">Select Blog Category</option>
                                <option value="Java">Java</option>
                                <option value="JSP">JSP</option>
                                <option value="Javascript">Javascript</option>
                                <option value="CSS">CSS</option>
                                <option value="HTML">HTML</option>
                                <option value="Python">Python</option>
                              </select>
                            </div>

                            <div class="form-group" style="visibility: hidden;">
                              <label class="bmd-label-floating">Blog Cover Image</label>
                              <input type="file" onchange="previewFile()" id="fileup" class="form-control" required="" name="banner" />
                            </div>

                            <div class="form-group">
                              <label>Description / Introduction</label>
                              <div class="form-group">
                                <label class="bmd-label-floating"> Give an Introduction to your new blog </label>
                                <textarea class="form-control" name="descr" rows="5"></textarea>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="start_blog" value="submit" class="btn btn-primary pull-right">Start Blog</button>
                    <div class="clearfix"></div>
                  </form>
                  <script type="text/javascript">
                    function fileUpload(){
                      document.getElementById("fileup").click();
                      return false;
                    }
                    function previewFile() {
                      var prev = document.getElementById("prev");
                      var file    = document.getElementById("fileup").files[0];

                      var def    = prev.src;
                      var reader  = new FileReader();
                        
                      reader.onloadend = function () {
                        prev.src = reader.result;
                      }

                      if (file) {
                        reader.readAsDataURL(file);
                      } else {
                         prev.src = def;
                      }
                    }
                  </script>
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