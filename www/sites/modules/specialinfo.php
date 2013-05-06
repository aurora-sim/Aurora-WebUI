<?php
$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();

$found = array();
$found[0] = json_encode(array('Method' => 'OnlineStatus', 'WebPassword' => md5(WEBUI_PASSWORD)));
$do_post_request = do_post_request($found);
$recieved = json_decode($do_post_request);
?>

<div id="speciallight">
	<p><?php echo $BOX_INFOTEXT?></p>
</div>