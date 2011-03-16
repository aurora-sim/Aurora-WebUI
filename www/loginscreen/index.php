<?
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
include("../settings/config.php");
include("../settings/mysql.php");
include("../settings/json.php");

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
$DbLink->query("SELECT UserID FROM ".C_USERINFO_TBL." where IsOnline = 1 AND ".
				"LastLogin < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
				"LastLogout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
				"ORDER BY LastLogin DESC");
$NOWONLINE = 0;

while(list($UUID) = $DbLink->next_record())
{
// Let's get the user info
$DbLink3 = new DB;
$DbLink3->query("SELECT CurrentRegionID from ".C_USERINFO_TBL." where UserID = '".$UUID."'");
list($RegionUUID) = $DbLink3->next_record();

$DbLink2 = new DB;
$DbLink2->query("SELECT FirstName, LastName from ".C_USERS_TBL." where PrincipalID = '".$UUID."'");
list($firstname, $lastname) = $DbLink2->next_record();
$username = $firstname." ".$lastname;
// Let's get the region information
$DbLink3 = new DB;
$DbLink3->query("SELECT RegionName from ".C_REGIONS_TBL." where RegionUUID = '".$RegionUUID."'");
list($region) = $DbLink3->next_record();
if ($region != "")
{
$NOWONLINE = $NOWONLINE + 1;
}
}

$DbLink->query("SELECT count(*) FROM ".C_USERINFO_TBL." where LastLogin > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
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
<link href="<?= SYSURL ?>loginscreen/templates/default_template.css" type="text/css" rel="stylesheet">
<script src="<?= SYSURL ?>loginscreen/javascripts/resize.js" type="text/javascript"></script>
<script src="<?= SYSURL ?>loginscreen/javascripts/imageswitch.js" type="text/javascript"></script>

<? include("../languages/translator.php"); ?>
<title><?=SYSNAME?>: <? echo $webui_login_screen ?></title>

<SCRIPT>
$(document).ready(function(){
bgImgRotate();
});
</SCRIPT>

</head>
    
<body class="webui">

<div id=top_image>
    <img src="<?= SYSURL ?>loginscreen/images/logo.png" alt="<?=SYSNAME?>" title="<?=SYSNAME?>" />
</div>

<div id=bottom_left>
    <?
      include("modules/special.php");
    ?>
    
    <div id=regionbox>
        <? 
          include("modules/region_box.php"); 
        ?>
    </div>
</div>

<img id=mainImage src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt="" title="" />

<div id=bottom>
    <div id=news>
      <? include("modules/news.php"); ?>
    </div>
</div>

<div id=topright>
    <br />
    <br />
    <br />
    <div id=gridstatus>
      <? include("modules/gridstatus.php"); ?>
    </div>
    
    <br />
    
    <div id=Infobox>
      <? 
        if(($INFOBOX=="1")&&($BOXCOLOR=="white")){
        include("modules/box_white.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="green")){
        include("modules/box_green.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="yellow")){
        include("modules/box_yellow.php"); 
        }else if(($INFOBOX=="1")&&($BOXCOLOR=="red")){
        include("modules/box_red.php"); }
      ?>
    </div>
</div>
</body>
</html>
