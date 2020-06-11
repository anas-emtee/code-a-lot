<?php
session_start();
include "../resources/DbCon.php";
include "../resources/Content_Class.php";
include "../resources/MainFunctions.php";
include "../resources/Mailer.php";
require_once '../resources/Mobile_Detect.php';
include "../resources/PC_Detect.php";

$detect = new Mobile_Detect;
$device = "";
$device_os = "";

if($detect->isMobile()) {
    $device = "Mobile";
}else{
    $device = "PC";
}

// Any tablet device.
if( $detect->isTablet()) {
    $device = "Tablet";
}

// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet()) {
  //echo "Exclude tablets";
}

// Check for a specific platform
if( $detect->isiOS()) {
    $device_os = "iOS";
}

if( $detect->isAndroidOS()) {
    $device_os = "Android";
}
if( $detect->isWindowsPhoneOS()) {
    $device_os = "Windows Phone";
}

if($device == "PC") {
   $device_os = getOS();
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Code-a-lot Blog</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="icon" href="../images/favicon.png" type="image/x-icon">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>