<?php
session_start();
$_SESSION['popup']= true;
header("Location: ".$_SERVER['HTTP_REFERER'])
?>