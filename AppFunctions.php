<?php

function checkSaved($item, $element, $user) {
    $str = false;
    $con = Dbcon();
    $evpqr = "SELECT * FROM `user_elements` WHERE `item`='$item' AND `item_type`='$element' AND `action`='save' AND `user`='$user'";
    //echo $evpqr;
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) > 0){
           $str = true;
        }else{ $str = false; }
    }else{ $str = false; }
    return $str;
}

function checkLiked($item, $element, $user) {
    $str = false;
    $con = Dbcon();
    $evpqr = "SELECT * FROM `user_elements` WHERE `item`='$item' AND `item_type`='$element' AND `action`='like' AND `user`='$user'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) > 0){
           $str = true;
        }else{ $str = false; }
    }else{ $str = false; }
    return $str;
}

function likeElement($item, $element){
    $str = false;
    $con = Dbcon();
    $evpqr = "UPDATE `".$element."` SET `likes` = `likes`+1 WHERE `item`='$item'";
    $str = mysqli_query($con, $evpqr);
        
    return $str;
}

function saveElement($item, $element){
    $str = false;
    $con = Dbcon();
    $evpqr = "UPDATE `".$element."` SET `saves` = `saves`+1 WHERE `item`='$item'";
    $str = mysqli_query($con, $evpqr);
        
    return $str;
}

function viewElement($item, $element){
    $str = false;
    $con = Dbcon();
    $evpqr = "UPDATE `".$element."` SET `views` = `views`+1 WHERE `item`='$item'";
    $str = mysqli_query($con, $evpqr);
        
    return $str;
}

?>