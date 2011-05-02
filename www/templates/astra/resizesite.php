<?php
// start session
// import selected size into session
session_start();
$_SESSION['sitesize'] = $_GET['s'];
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
