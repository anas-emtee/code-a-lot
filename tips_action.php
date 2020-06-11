<?php
session_start();
include "resources/DbCon.php";
include "resources/Content_Class.php";
include "resources/MainFunctions.php";
include "AppFunctions.php";
include "resources/Mailer.php";
require_once 'resources/Mobile_Detect.php';
include "resources/PC_Detect.php";

if(isset($_REQUEST["post_now"])){
    $user = $_REQUEST["user"];
    $item = $_REQUEST["item"];
    $item_type = $_REQUEST["item_type"];
    $rating = $_REQUEST["rating"];
    $post = $_REQUEST["post"];
    $content = $_REQUEST["content"];

    $con = Dbcon();
    $content = mysqli_real_escape_string($con, $content);
    $query =  "INSERT INTO `user_elements_post`(`user`, `post`, `item`, `item_type`, `rating`, `comment`) VALUES ('$user', '$post', '$item', '$item_type', '$rating', '$content')";
    if (mysqli_query($con, $query) or die(mysqli_error($con))){
        $result = "success";
    }
    mysqli_close($con);

    header("location:tips_detail.php?tip_reference=".$item);

}else if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
    $element = $_REQUEST["element"];
    $element_type = $_REQUEST["element_type"];
    $user = $_SESSION["active_user"]["id"];
    $result = "failed";

    $con = Dbcon();
    $query =  "INSERT INTO `user_elements` (`item`, `item_type`, `action`, `user`) VALUES ('$element', '$element_type', '$action', '$user')";
    if (mysqli_query($con, $query) or die(mysqli_error($con))){
        $result = "success";
        if($action == "like"){likeElement($element, $element_type);}
        else if($action == "save"){saveElement($element, $element_type);}
    }
    mysqli_close($con);

    header("location:tips_detail.php?tip_reference=".$element);
    
}else{
    echo "No Session ";
    header("location:app_login.php?error=Uninitiated");
}
?>