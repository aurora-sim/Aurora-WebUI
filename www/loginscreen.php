<?
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
include("settings/config.php");
include("settings/mysql.php");
include("settings/json.php");

$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();

$found = array();
$found[0] = json_encode(array('Method' => 'OnlineStatus', 'WebPassword' => md5(WIREDUX_PASSWORD)));
$do_post_request = do_post_request($found);
$recieved = json_decode($do_post_request);
$GRIDSTATUS = $recieved->{'Online'};
// Doing it the same as the Who's Online now part
$DbLink = new DB;
$DbLink->query("SELECT UserID FROM ".C_GRIDUSER_TBL." where Online = 1 AND ". 
				"Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
				"Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
				"ORDER BY Login DESC");
$NOWONLINE = 0;
while(list($UUID) = $DbLink->next_record())
{
	// Let's get the user info
	$DbLink3 = new DB;
	$DbLink3->query("SELECT RegionID from ".C_PRESENCE_TBL." where UserID = '".$UUID."'");
	list($regionUUID) = $DbLink3->next_record();

	$DbLink2 = new DB;
	$DbLink2->query("SELECT username, lastname from ".C_USERS_TBL." where UUID = '".$UUID."'");
	list($firstname, $lastname) = $DbLink2->next_record();
	$username = $firstname." ".$lastname;
	// Let's get the region information
	$DbLink3 = new DB;
	$DbLink3->query("SELECT RegionName from ".C_REGIONS_TBL." where RegionUUID = '".$regionUUID."'");
	list($region) = $DbLink3->next_record();
	if ($region != "")
	{
	$NOWONLINE = $NOWONLINE + 1;
	}
}

$DbLink->query("SELECT count(*) FROM ".C_GRIDUSER_TBL." where Login > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
list($LASTMONTHONLINE) = $DbLink->next_record();
 
$DbLink->query("SELECT count(*) FROM ".C_USERS_TBL."");
list($USERCOUNT) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM ".C_REGIONS_TBL."");
list($REGIONSCOUNT) = $DbLink->next_record();

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="loginscreen/css/style.css" type="text/css" rel="stylesheet">
<script src="loginscreen/javascript/resize.js" type="text/javascript"></script>
<script src="loginscreen/javascript/imageswitch_root.js" type="text/javascript"></script>

<? include("languages/translator.php"); ?>
<title><?=SYSNAME?>: <? echo $webui_login_screen ?></title>

<SCRIPT>
$(document).ready(function(){
bgImgRotate();
});
</SCRIPT>

</head>
    
<body class="webui">

<div id=top_image>
    <img src="images/login_screens/logo.png" alt="<?=SYSNAME?>" title="<?=SYSNAME?>" />
</div>

<div id=bottom_left>
    <?
      include("loginscreen/modules/special.php");
    ?>
    
    <div id=regionbox>
        <? 
          include("loginscreen/modules/region_box.php"); 
        ?>
    </div>
</div>

<img id=mainImage src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt="" title="" />

<div id=bottom>
    <div id=news>
      <? include("loginscreen/modules/news.php"); ?>
    </div>
</div>

<div id=topright>
    <br />
    <br />
    <br />
    <div id=gridstatus>
      <? include("loginscreen/modules/gridstatus.php"); ?>
    </div>
    
    <br />
    
    <div id=Infobox>
      <? 
        if(($INFOBOX=="1")&&($BOXCOLOR=="white")){
        include("loginscreen/modules/box_white.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="green")){
        include("loginscreen/modules/box_green.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="yellow")){
        include("loginscreen/modules/box_yellow.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="red")){
        include("loginscreen/modules/box_red.php"); }
      ?>
    </div>
</div>
</body>
</html>
