<?php
session_start();

session_destroy();

header("location:app_home.php");
exit();
?>