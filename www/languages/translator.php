<!-- Test Traduction  -->
<div id="Translator_Module">
<div class="textcolorwhite" >
<?php
if(!empty($_COOKIE['lang']))$lang=$_COOKIE['lang'];
if(!empty($_GET['lang']))$lang=$_GET['lang'];
if(!empty($lang) && ($lang=='eng' || $lang=='fr' || $lang=='esp')){
  include('lang_'.$lang.'.php');
  setcookie('lang',$lang,time()+3600*25*365,'/');
}else include('languages/lang_fr.php');
// echo "wiredux_welcome = $wiredux_welcome";
?>
</div>

<div class="textcolorwhite">
<a href="?lang=fr"><img src=images/flags/flag-fr.png alt="French" title="French" /></a>
<a href="?lang=eng"><img src=images/flags/flag-eng.png alt="English" title="English" /></a>
<a href="?lang=esp"><img src=images/flags/flag-esp.png alt="Spain" title="Spain" /></a> 
<?php echo "$wiredux_actual_language"; ?>
</div></div>
