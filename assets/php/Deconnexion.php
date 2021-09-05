<?php
session_start();
session_destroy();
setcookie("stayconnected", time() - 3600);
header('Location: '.$_SERVER['HTTP_REFERER'])
?>