<?
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
include("../settings/config.php");
include("../settings/databaseinfo.php");
include("../settings/mysql.php");
include("templates/templates.php");
use Aurora\Addon\WebUI\Configs;

$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();

$GRIDSTATUS = Configs::d()->OnlineStatus()->Online();
$NOWONLINE       = Configs::d()->NumberOfRecentlyOnlineUsers(0,true);
$LASTMONTHONLINE = Configs::d()->NumberOfRecentlyOnlineUsers(2419200,false);
$USERCOUNT       = Configs::d()->FindUsers()->count();
$REGIONSCOUNT    = Configs::d()->GetRegions()->count();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?= SYSURL ?><?=$template_css?>" type="text/css" rel="stylesheet">
<script src="<?= SYSURL ?>loginscreen/javascripts/resize.js" type="text/javascript"></script>
<script src="<?= SYSURL ?><?if($picturesByTime){ echo "loginscreen/javascripts/timeimageswitch.js"; } else { echo "loginscreen/javascripts/randomimageswitch.js"; }; ?>" type="text/javascript"></script>

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
    <? if($showSpecialReport) { ?>
    <?
      include("modules/special.php");
    ?>
    <? } ?>

    <? if($showRegionsPanel) { ?>
    <div id=regionbox>
        <? 
          include("modules/region_box.php"); 
        ?>
    </div>
    <? } ?>
</div>

<img id=mainImage src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt="" title="" />

<? if($showNewsBar) { ?>
<div id=bottom>
    <div id=news>
      <? include("modules/news.php"); ?>
    </div>
</div>
<? } ?>

<div id=topright>
    <br />
    <br />
    <br />
    <? if($showGridStatus) { ?>
    <div id=gridstatus>
      <? include("modules/gridstatus.php"); ?>
    </div>
    <? } ?>
    
    <br />
    
    <? if($showAlertPanel) { ?>
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
    <? } ?>
</div>
</body>
</html>
