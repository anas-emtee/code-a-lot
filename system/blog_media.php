<?php 
include "system_header.php"; 
$bt = "";
$bid = "";
$bc = "";
$bs = "";
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
            $bcon = "../".$blog["content"];
            $myfile = fopen($bcon, "r") or die("Unable to open file!");
            $bc = fread($myfile, filesize($bcon));
            fclose($myfile);
        }else{
            header("location:dashboard.php");
        }
    }else{
        header("location:dashboard.php");
    }
}else{
    header("location:dashboard.php");
}
?>
<style type="text/css">
  .thumbnail{
    margin-bottom: 10px;
    border-radius: 15px;
    border:solid 1px;
    box-shadow: 2px 2px 1px #aaaaaa;
  }
  .thumb-img{
    width: 100%;
    height: 17vh;
    border-radius: 15px;
  }
</style>
<body class="dark-edition">
  <div class="wrapper ">
    <?php include "system_sidebar.php"; ?>

    <div class="main-panel">
      <?php 
        $page_navbar_title = $blog["title"]." Media";
        include "system_navbar.php"; 
      ?>
      
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <div class="row">
            <!-- List Of Images -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">
                    Manage Media 
                    <span class="pull-right">
                      <a href="blog_compose.php?blog_reference=<?= $bid ?>">Continue Editing</a>
                    </span>
                  </h4>
                  <p class="card-category">Add New Blog Media</p>
                </div>
                <div class="card-body">
                  <form action="blog_action.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="blog_id" value="<?= $bid ?>">
                    <input class="form-control" type="hidden" name="user_id" value="1">
                    <div class="row">
                      <div class="col-md-10">
                        <div class="form-group" style="visibility: hidden;">
                          <label class="bmd-label-floating">Blog Cover Image</label>
                          <input type="file" onchange="previewFile()" id="fileup" class="form-control" required="" name="banner" />
                        </div>
                        <div class="form-group">
                          <label class="bmd-label-floating">Media Name</label>
                          <input type="text" name="mname" class="form-control">
                          <small>Example: Diagram1</small>
                        </div>
                        
                      </div>
                      <div class="col-md-2">
                        <div class="card card-profile">
                          <div class="card-body">
                            <a href="#" onclick="fileUpload();">
                              <img id="prev" class="img thumb-img" src="assets/img/add.png" />
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" name="upload_media" class="btn btn-primary pull-right">Upload Media</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-2">
                  <div class="card card-profile">
                    <div class="card-body">
                      <img class="img thumb-img" src="../<?= $blog["cover_img"] ?>" />
                    </div>
                  </div>
                </div>
                <?php
                  $con = Dbcon();
                  $query="select * from `blog_media` WHERE blog='$bid'";
                  $result = mysqli_query($con, $query);
                  if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                ?>
                <div class="col-md-2">
                  <div class="card card-profile">
                    <div class="card-body">
                      <img class="img thumb-img" src="../<?= $row["msource"] ?>" />
                    </div>
                  </div>
                </div>
                <?php }} ?>
              </div>
            </div>
          </div>
        </div>
      </div>
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
    function insertBlock(block, type='none'){
      //alert(block+" == "+type);
      preEx = document.getElementById("block_body").value;
      newText = "";

      if(block == "p"){
        newText = "<p>\n<!-- Insert Text Here -->\n</p>";
      }else if(block == "b"){
        newText = "<strong>\n<!-- Insert Text Here -->\n</strong>";
      }else if(block == "i"){
        newText = "<i>\n<!-- Insert Text Here -->\n</i>";
      }else if(block == "u"){
        newText = "<u>\n<!-- Insert Text Here -->\n</u>";
      }else if(block == "quote"){
        newText = "<quote>\n<!-- Insert Text Here -->\n</quote>";
      }else if(block == "code"){
        newText = '<pre><code class="'+type+'"><!--Paste Code Here--></code></pre>';
      }else if(block == "t"){
        newText = '<h4 class="uppercase bolder">\n<!-- Insert Subtitle Here -->\n</h4>';
      }else if(block == "ul"){
        newText = "<ul>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n</ul>";
      }else if(block == "ol"){
        newText = "<ol>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --><li>\n</ol>";
      }

      //<h4 class="uppercase bolder">Dummy Heading</h4>

      if(preEx == ""){
        margedText = newText;
      }else{
        margedText = preEx+"\n"+newText;
      }
      
      document.getElementById("block_body").value = margedText;
    }
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