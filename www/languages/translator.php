<?php
if(!empty($_COOKIE['lang']))$lang=$_COOKIE['lang'];
if(!empty($_GET['lang']))$lang=$_GET['lang'];
if(!empty($lang) && array_key_exists($lang, $languages))
{
    include('lang_'.$lang.'.php');
    setcookie('lang',$lang,time()+3600*25*365,'/');
}
else
    include('lang_en.php'); //Eng by default
// echo "webui_welcome = $webui_welcome";
?>