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

    header("location:class_detail.php?class_reference=".$item);

}else if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
    $element = $_REQUEST["element"];
    $element_type = $_REQUEST["element_type"];
    $user = $_SESSION["active_user"]["id"];
    $result = "failed";

    $con = Dbcon();
    $evpqr = "SELECT * FROM `user_elements` WHERE `item`='$element' AND `item_type`='$element_type' AND `action`='$action' AND `user`='$user'";
    echo $evpqr;
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) == 0){
            $query =  "INSERT INTO `user_elements` (`item`, `item_type`, `action`, `user`) VALUES ('$element', '$element_type', '$action', '$user')";
            if (mysqli_query($con, $query) or die(mysqli_error($con))){
                $result = "success";
                if($action == "like"){ likeElement($element, $element_type); }
                else if($action == "save"){ saveElement($element, $element_type); }
            }
        }
    }
    mysqli_close($con);

    header("location:class_detail.php?class_reference=".$element);
    exit();
    
}else{
    echo "No Session ";
    header("location:app_login.php?error=Uninitiated");
}
?>