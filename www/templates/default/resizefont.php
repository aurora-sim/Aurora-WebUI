<?php
// start session
// import selected size into session
session_start();
$_SESSION['fontsize'] = $_GET['f'];
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
