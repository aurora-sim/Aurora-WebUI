<!-- Test Translation  -->
<?php
if(!empty($_COOKIE['lang']))$lang=$_COOKIE['lang'];
if(!empty($_GET['lang']))$lang=$_GET['lang'];
if(!empty($lang) && ($lang=='eng' || $lang=='fr' || $lang=='esp')){
  include('lang_'.$lang.'.php');
  setcookie('lang',$lang,time()+3600*25*365,'/');
}else include('languages/lang_eng.php');
// echo "wiredux_welcome = $wiredux_welcome";
?>
