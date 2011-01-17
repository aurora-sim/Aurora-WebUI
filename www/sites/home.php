<?
$DbLink = new DB;
$DbLink->query("SELECT content FROM ".C_PAGE_TBL." WHERE id='1'");
list($content) = $DbLink->next_record();
?>

<div id="content"><h2><?= SYSNAME ?>: Home </h2><?=$content?>
<p>LoginScreen Demo @ <a target="_blank" href="loginscreen.php">loginscreen.php</a></p>
<p><?= SYSNAME ?> is a Free Open Source WebInterface for Aurora-Sim</p></div>
