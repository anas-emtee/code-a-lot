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
            if($blog["content"] != "none"){
              $bcon = "../".$blog["content"];
              $myfile = fopen($bcon, "r") or die("Unable to open file!");
              $bc = fread($myfile, filesize($bcon));
              fclose($myfile);
            }
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
    border-radius: 15px;
    height: 17vh;
  }
</style>
<body class="dark-edition">
  <div class="wrapper ">
    <?php include "system_sidebar.php"; ?>

    <div class="main-panel">
      <?php 
        $page_navbar_title = $blog["title"];
        include "system_navbar.php"; 
      ?>
      
      <div class="" style="margin-top: 85px;">
          <!-- your content here -->
          <div class="panel panel-default">
            <div class="panel-body message">
             
              <div class="col-sm-12" >
                <p style="color:white;">Introduction: <?= $blog["descr"] ?></p>
              </div>
              <div class="col-sm-12" >
                <div class="btn-toolbar" role="toolbar">
                  <div class="btn-group">
                    <button title="Insert Object" onclick="insertBlock('b', '')" class="btn btn-primary"><span class="fa fa-bold"></span></button>
                    <button title="Insert Object" onclick="insertBlock('i', '')" class="btn btn-primary"><span class="fa fa-italic"></span></button>
                    <button title="Insert Object" onclick="insertBlock('u', '')" class="btn btn-primary"><span class="fa fa-underline"></span></button>
                  </div>

                  <div class="btn-group">
                    <button title="Insert Object" onclick="insertBlock('p', '')" class="btn btn-primary"><span class="fa fa-align-justify"></span></button>
                    <button title="Insert Object" onclick="insertBlock('t', '')" class="btn btn-primary"><span class="fa fa-text-width"></span></button>
                    <button title="Insert Object" onclick="insertBlock('quote', '')" class="btn btn-primary"><span class="fa fa-quote-left"></span></button>
                    <button title="Insert Object" onclick="insertBlock('br', '')" class="btn btn-primary"><span class="fa fa-align-right"></span></button>
                  </div>
                  <div class="btn-group">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="fa fa-code"></span> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#" onclick="insertBlock('code', 'language-java')"><span class="label label-danger"> Java </span></a></li>
                      <li><a href="#" onclick="insertBlock('code', 'language-css')"><span class="label label-info"> CSS </span></a></li>
                      <li><a href="#" onclick="insertBlock('code', 'language-html')"><span class="label label-success"> HTML </span></a></li>
                      <li><a href="#" onclick="insertBlock('code', 'language-js')"><span class="label label-warning"> JS </span></a></li>
                    </ul>
                  </div>
                  <div class="btn-group">
                    <button title="Insert Object" onclick="insertBlock('ul', '')" class="btn btn-primary"><span class="fa fa-list-ul"></span></button>
                    <button title="Insert Object" onclick="insertBlock('ol', '')" class="btn btn-primary"><span class="fa fa-list-ol"></span></button>
                  </div>
                  
                  <div class="btn-group">
                    <button title="Insert Object" onclick="insertBlock('p', '')" class="btn btn-primary"><span class="fa fa-indent"></span></button>
                    <button title="Insert Object" onclick="insertBlock('p', '')" class="btn btn-primary"><span class="fa fa-outdent"></span></button>
                    <a href="../blog_preview.php?blog_reference=<?= $bid ?>" target="_blank" class="btn btn-primary">
                      <span class="fa fa-eye"></span>
                    </a>
                    <button title="Insert Object" onclick="insertBlock('p', '')" class="btn btn-primary"><span class="fa fa-terminal"></span></button>
                  </div>
                  <div class="btn-group">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="fa fa-paperclip"></span> <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#">add label <span class="label label-danger"> Home</span></a></li>
                      <li><a href="#">add label <span class="label label-info">Job</span></a></li>
                      <li><a href="#">add label <span class="label label-success">Clients</span></a></li>
                      <li><a href="#">add label <span class="label label-warning">News</span></a></li>
                    </ul>
                  </div>
                </div>
                <br>  
                <div class="row">
                  <div class="col-sm-10">
                    <form action="blog_action.php" name="form" method="post">
                      <input class="form-control" type="hidden" name="blog_id" value="<?= $bid ?>">
                      <input class="form-control" type="hidden" name="status" value="<?= $bs ?>">
                      
                      <div class="form-group">
                        <textarea id="block_body" class="form-control" style="background-color: #ebeadc; border-radius:20px; padding: 20px; color: black;" 
                                  name="block_body" rows="30" placeholder="Click here to reply"><?= $bc ?></textarea>
                      </div>
                      
                      <div class="form-group">  
                        <button type="submit" name="publish_blog" class="btn btn-success">Publish</button>
                        <button type="submit" name="save_blog" class="btn btn-primary">Save Draft</button>
                        <button type="submit" name="discard_blog" class="btn btn-danger">Discard</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-sm-2" style="min-height: 72vh; max-height: 72vh; overflow-y: scroll;">
                    <div class="card card-profile" style="margin-top: 0 !important; padding-top: 0 !important;">
                      <div class="card-body">
                        <img class="img thumb-img" src="../<?= $blog["cover_img"] ?>" />
                      </div>
                    </div>
                    <?php
                      $con = Dbcon();
                      $query="select * from `blog_media` WHERE blog='$bid'";
                      $result = mysqli_query($con, $query);
                      if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="card card-profile" style="margin-top: 0 !important; padding-top: 0 !important;">
                      <div class="card-body">
                        <a href="#" title="<?= $row['mname'] ?>" onclick="insertMedia('<?= $row['msource'] ?>', '<?= $row['mtype'] ?>'); return false;">
                          <img class="img thumb-img" src="../<?= $row['msource'] ?>" />
                        </a>
                      </div>
                    </div>
                    <?php }} ?>
                    <div class="card card-profile" style="margin-bottom: 0 !important; padding-bottom: 0 !important;">
                      <div class="card-body">
                        <a href="blog_media.php?blog_reference=<?= $bid ?>">
                          <img class="img thumb-img" src="assets/img/add.png" />
                        </a>
                      </div>
                    </div>
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
    function insertMedia(msource, mtype, caption="No Caption"){
      alert(msource+" == "+mtype);
      preEx = document.getElementById("block_body").value;
      newText = "";
      if(mtype == "image"){
        newText = '<div class="blog-post-home full"><a href="#" class="content-round shadow-small"><img class="preload-image responsive-image bottom-0 shadow" src="images/empty.png" data-src="'+msource+'" /></a>\n<caption>Figure: '+caption+'</caption></div>';
      }else if(mtype == "image"){
        newText = '<div class="content-round shadow-small"><video width="100%" height="40vh" controls>\n<source src="movie.mp4" type="video/mp4">\n<source src="movie.ogg" type="video/ogg">\nour browser does not support the video tag.\n</video></div>';
      }

      if(preEx == ""){
        margedText = newText;
      }else{
        margedText = preEx+"\n"+newText;
      }
      
      document.getElementById("block_body").value = margedText;
      return false;
    }
    function insertBlock(block, type='none'){
      //alert(block+" == "+type);
      preEx = document.getElementById("block_body").value;
      newText = "";

      if(block == "p"){
        newText = "<p>\n<!-- Insert Text Here -->\n</p>";
      }else if(block == "b"){
        newText = "<strong>\n<!-- Insert Text Here -->\n</strong>";
      }else if(block == "br"){
        newText = "<br />";
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
        newText = "<ul>\n\t<li><!-- Insert Text Here --><li>\n\t<li><!-- Insert Text Here --></li>\n\t<li><!-- Insert Text Here --></li>\n\t<li><!-- Insert Text Here --></li>\n\t<li><!-- Insert Text Here --></li>\n</ul>";
      }else if(block == "ol"){
        newText = "<ol>\n\t<li><!-- Insert Text Here --><li>\n\t</li><!-- Insert Text Here --><li>\n\t</li><!-- Insert Text Here --></li>\n\t<li><!-- Insert Text Here --></li>\n\t<li><!-- Insert Text Here --></li>\n</ol>";
      }

      //<h4 class="uppercase bolder">Dummy Heading</h4>

      if(preEx == ""){
        margedText = newText;
      }else{
        margedText = preEx+"\n"+newText;
      }
      
      document.getElementById("block_body").value = margedText;
      return false;
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