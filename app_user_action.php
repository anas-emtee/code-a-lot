<?php
session_start();
include "resources/DbCon.php";
include "resources/Content_Class.php";
include "resources/MainFunctions.php";
include "resources/Mailer.php";
require_once 'resources/Mobile_Detect.php';
include "resources/PC_Detect.php";

if(isset($_REQUEST["login"])){
    $email = $_REQUEST["account_email"];
    $password = $_REQUEST["account_pass"];
    
    if(isset($_REQUEST["original-from"])){
        $ori_from = $_REQUEST["original-from"];
    }else{
        $ori_from = "Default";
    }
    $con = Dbcon();
    $query =  "SELECT * FROM `registered_users` WHERE `email`='$email' AND `password`='$password'";
    
    if ($adds = mysqli_query($con, $query) or die(mysqli_error($con))){
        echo mysqli_num_rows($adds);
        if (mysqli_num_rows($adds)){
            $main = mysqli_fetch_array($adds);
            $_SESSION["active_user"] = $main;
                
            $t=time();
            $td = date("Y-m-d HH:mm:ss",$t);

            $_SESSION["logged"] = $td;
            if($ori_from != "Default"){
                header("location:".$ori_from);
            }else{
                header("location:app_home.php");
            }    
        }else{
            echo "Error: ".mysqli_error($con);
            header("location:app_login.php?error=Username or Password Doesn't Exist");
        }
    }else{
        echo "Error: ".mysqli_error($con);
        header("location:app_login.php?error=1ziggler211");
    }
}else if(isset($_REQUEST["register"])){
    $uname = $_REQUEST["fullname"];
    $email = $_REQUEST["account_email"];
    $password = $_REQUEST["account_password"];

    $con = Dbcon();
    $query =  "INSERT INTO `registered_users` (`username`, `email`, `password`) VALUES ('$uname', '$email', '$password')";
    if (mysqli_query($con, $query) or die(mysqli_error($con))){
        $result = "success";
        $RID = mysqli_insert_id($con);
        $query =  "SELECT * FROM `registered_users` WHERE `id`='$RID'";
    
        if ($adds = mysqli_query($con, $query) or die(mysqli_error($con))){
            if (mysqli_num_rows($adds)){
                $main = mysqli_fetch_array($adds);
                $_SESSION["active_user"] = $main;
                    
                $t=time();
                $td = date("Y-m-d HH:mm:ss",$t);

                $_SESSION["logged"] = $td;
            }
        }
    }
    mysqli_close($con);

    header("location:app_home.php");

}else if(isset($_REQUEST["post_now"])){
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

    header("location:blog_detail.php?blog_reference=".$item);

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
    }
    mysqli_close($con);

    header("location:blog_detail.php?blog_reference=".$element);
    
}else{
    echo "No Session ";
    header("location:app_login.php?error=Uninitiated");
}
?>