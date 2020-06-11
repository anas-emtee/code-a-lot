<?php
session_start();
include "../resources/DbCon.php";
include "../resources/Content_Class.php";
include "../resources/MainFunctions.php";
include "../resources/Mailer.php";
require_once '../resources/Mobile_Detect.php';
include "../resources/PC_Detect.php";

if(isset($_REQUEST["start_blog"])){
  $user = $_REQUEST["user"];
  $title = $_REQUEST["blog_title"];
  $category = $_REQUEST["category"];
  $topics = $_REQUEST["topics"];
  $descr = $_REQUEST["descr"];

  $nameString = substr($title, 20);
  $nameString = str_replace(" ", "", $nameString);
  $nameString = strtolower($nameString);
    
  //logo
  $logo = $_FILES["banner"]["name"]; //the original file name
  $splitLogo = explode(".", $logo); //split the file name by the dot
  $logoExt = end($splitLogo); //get the file extension
  $newLogoName  = $nameString.'.'.$logoExt; //join file name and ext.
  $logo = "../resources/media/$newLogoName";
  $logo_loc = "resources/media/$newLogoName";

  move_uploaded_file($_FILES["banner"]["tmp_name"], $logo);
  
  $con = Dbcon();
  $usql = "INSERT INTO `tips` (`title`, `descr`, `category`, `topics`, `author`, `cover_img`)".
          " VALUES ('$title', '$descr', '$category', '$topics', '$user', '$logo_loc')";
  if(mysqli_query($con, $usql)or die(mysqli_error($con))){
    $EVID = mysqli_insert_id($con);
    $_SESSION["blog_access"] = $EVID;
    $result = 'success';
  }else{$result = 'fail';}
  mysqli_close($con);

  if($result == 'success'){
    header('Location: tip_compose.php?blog_reference='.$EVID);
  }else if($result == 'fail'){
    header('Location: tip_startup.php');
  }
  
  exit();
}

if(isset($_REQUEST["save_blog"]) || isset($_REQUEST["publish_blog"])){
  $newStat = "published";
  if(isset($_REQUEST["save_blog"])){
    $newStat = $_REQUEST["status"];
  }
  $blog = $_REQUEST["blog_id"];
  $content = $_REQUEST["block_body"];
  $nameString = $blog."_content.txt";
  $confile = "../resources/blogs/".$nameString;
  $confile_loc = "resources/blogs/".$nameString;

  $myfile = fopen($confile, "w") or die("Unable to open file!");
  fwrite($myfile, $content);
  fclose($myfile);

  $con = Dbcon();
  $usql = "UPDATE `tips` SET `content`='$confile_loc', `status`='$newStat' WHERE `id`=$blog";
  if(mysqli_query($con, $usql)or die(mysqli_error($con))){
      $result = 'success';
  }else{$result = 'fail';}
  mysqli_close($con);

  if($result == 'success'){
    header('Location: tip_compose.php?blog_reference='.$blog);
  }else if($result == 'fail'){
    header('Location: tip_compose.php?blog_reference='.$blog);
  }
  
  exit();
}
if(isset($_REQUEST["upload_media"])){
  $user_id = $_REQUEST["user_id"];
  $blog_id = $_REQUEST["blog_id"];
  $mname = $_REQUEST["mname"];

  $nameString = $mname;
  $nameString = str_replace(" ", "", $nameString);
  $nameString = strtolower($nameString);

  //logo
  $logo = $_FILES["banner"]["name"]; //the original file name
  $splitLogo = explode(".", $logo); //split the file name by the dot
  $logoExt = end($splitLogo); //get the file extension
  $newLogoName  = $nameString.'.'.$logoExt; //join file name and ext.
  $logo = "../resources/media/$newLogoName";
  $logo_loc = "resources/media/$newLogoName";

  move_uploaded_file($_FILES["banner"]["tmp_name"], $logo);

  $con = Dbcon();
  $usql = "INSERT INTO `tips_media`(`mname`, `msource`, `blog`, `author`)".
          " VALUES ('$mname', '$logo_loc', '$blog_id', '$user_id')";
  if(mysqli_query($con, $usql)or die(mysqli_error($con))){
    $result = 'success';
  }else{$result = 'fail';}
  mysqli_close($con);

  if($result == 'success'){
    header('Location: tip_media.php?blog_reference='.$blog_id);
  }else if($result == 'fail'){
    header('Location: tip_media.php?blog_reference='.$blog_id);
  }
  
  exit();

}
?>