<?php
if(!empty($_GET['lang'])){
	$lang=$_GET['lang'];
}else if(!empty($_COOKIE['lang'])){
	$lang=$_COOKIE['lang'];
}else{
	if(!defined('DEFAULT_LANG')){
		define('DEFAULT_LANG', 'en'); // do not change this line to change the default language, add/edit the option on your config.php
	}
	$lang = DEFAULT_LANG;
}
if(!empty($lang) && array_key_exists($lang, $languages))
{
    include('lang_'.$lang.'.php');
    setcookie('lang',$lang,time()+3600*25*365,'/');
}
else{
/**
*	English will be used as a fallback language in the event that there is:
*	1) No language specified in the cookie
*	2) No language specified in the query argument
*	3) A typo in the default language config
*/
    include('lang_en.php');
}
?>
