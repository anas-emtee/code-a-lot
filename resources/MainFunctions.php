<?php

function randomString($length, $from) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'), range('a','z'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
    
    if(checkCode($str, $from)){
        return $str;
    }else{
        return randomString($length, $from);
    }
}

function randomStringAlt($length, $from, $col) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('0','9'), range('a','z'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    
    if(checkCodeAlt($str, $from, $col)){
        return $str;
    }else{
        return randomStringAlt($length, $from, $col);
    }
}

function checkCodeAlt($code, $from, $col) {
    $str = false;
    $con = Dbcon();
    $evpqr = "SELECT * FROM `".$from."` WHERE `".$col."`='$code'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) <= 0){
           $str = true;
        }else{ $str = false; }
    }else{ $str = false; }
    return $str;
}

function checkCode($code, $from) {
	$str = false;
    $con = Dbcon();
	$evpqr = "SELECT * FROM `".$from."` WHERE `passcode`='$code'";
    if($evpr = mysqli_query($con, $evpqr)){
        if(mysqli_num_rows($evpr) <= 0){
           $str = true;
        }else{ $str = false; }
    }else{ $str = false; }
	return $str;
}

function finalCheck($myArray, $myUk){
    $ret = TRUE;
    foreach($myArray as $win => $reciept) {
        //echo "<br> Final Checkin Key=" . $win . ", Value=" . $reciept;
        $ag = explode("-", $win)[2];
        $ag1 = explode("-", $myUk)[2];
        if($ag == $ag1){
            $ret = $ret && FALSE;
        }
    }
    return $ret;
}

?>