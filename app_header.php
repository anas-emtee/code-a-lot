<?php
session_start();
include "resources/DbCon.php";
include "resources/Content_Class.php";
include "resources/MainFunctions.php";
include "AppFunctions.php";
include "resources/Mailer.php";
require_once 'resources/Mobile_Detect.php';
include "resources/PC_Detect.php";

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
<!--<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
		<title>ePax Facility Booking</title>
		<link rel="stylesheet" type="text/css" href="../styles/style.css">
		<link rel="stylesheet" type="text/css" href="../fonts/css/fontawesome-all.min.css">
		<link rel="stylesheet" type="text/css" href="../styles/framework.css">
		<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	</head>-->
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
		<title>Code-a-lot Blog</title>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="styles/framework.css">
		<link rel="stylesheet" type="text/css" href="styles/framework-blog.css">
		<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
		<link href="//cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css"  rel="stylesheet">
		<script src="//cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
		<link rel="stylesheet" href="styles/prism.css" />
		
		<style type="text/css">
			@media screen and (min-width: 1025px) {
				.blog-image{
					height: 78vh;
				}
				.half-image{
					height: 50vh;
				}
			}
		</style>
	</head>