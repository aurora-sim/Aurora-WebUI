<?
include("../../settings/config.php");
include("../../settings/mysql.php");
include("../../settings/json.php");
include("../../languages/translator.php");
include("../../templates/templates.php");

$DbLink = new DB;
$query = "SELECT RegionName,LocX,LocY,OwnerUUID,Info FROM ".C_REGIONS_TBL." where LocX='".cleanQuery($_GET[x])."' and LocY='".cleanQuery($_GET[y])."'";
$DbLink->query($query);
list($RegionName,$locX,$locY,$owner, $info) = $DbLink->next_record();
$locX = $locX/256;
$locY = $locY/256;
$recieved = json_decode($info);
$regionType = $recieved->{'regionType'};
if($regionType == '')
$regionType = 'Unknown';
$DbLink->query("SELECT FirstName,LastName FROM ".C_USERS_TBL." where PrincipalID='".cleanQuery($owner)."'");
list($firstN,$lastN) = $DbLink->next_record();

$DbLink->query("SELECT RegionUUID, Info FROM ".C_REGIONS_TBL." where locX='".($locX*256)."' and locY='".($locY*256)."'");
list($UUID,$Info) = $DbLink->next_record();
$recieved = json_decode($Info);
$serverIP = $recieved->{'serverIP'};
$serverHttpPort = $recieved->{'serverHttpPort'};

$SERVER ="http://$serverIP:$serverHttpPort";
$UUID = str_replace("-", "", $UUID);
$source = $SERVER."/index.php?method=regionImage".$UUID."";
?>


<?
	/*+++ PRINT NEIGHBORS +++*/
	// Array of 8 locations to search for
	$locarr['RegionName1']="(LocX='".($locX - 1)*256 ."' and LocY='".($locY - 1)*256 ."')";
	$locarr['RegionName2']="(LocX='".$locX * 256 ."' and LocY='".($locY - 1)*256 ."')";
	$locarr['RegionName3']="(LocX='".($locX + 1)*256 ."' and LocY='".($locY - 1)*256 ."')";
	$locarr['RegionName4']="(LocX='".($locX - 1)*256 ."' and LocY='".$locY *256 ."')";
	/* This region would go here */
	$locarr['RegionName6']="(LocX='".($locX + 1)*256 ."' and LocY='".$locY *256 ."')";
	$locarr['RegionName7']="(LocX='".($locX - 1)*256 ."' and LocY='".($locY + 1)*256 ."')";
	$locarr['RegionName8']="(LocX='".$locX * 256 ."' and LocY='".($locY + 1)*256 ."')";
	$locarr['RegionName9']="(LocX='".($locX + 1)*256 ."' and LocY='".($locY + 1)*256 ."')";
	
	$DbLink->query("SELECT RegionName,LocX,LocY FROM ".C_REGIONS_TBL." where ".implode(" or ",$locarr));
	while(list($RegionNameX,$locX1,$locY1) = $DbLink->next_record()){
		
		switch($locX1/256){
			case $locX: //same col
				$regN = 5;
				switch(	$locY1/256 ) {
					case $locY - 1: //down one
					$regN = 8;
					break;
					case $locY + 1: //up one
					$regN = 2;
					break;
				}
				break;
			case $locX - 1: //one left
				$regN = 4;
				switch(	$locY1/256 ) {
					case $locY - 1: //down one
					$regN = 7;
					break;
					case $locY + 1: //up one
					$regN = 1;
					break;
				}
				break;
			default: // one right
				$regN = 6;
				switch(	$locY1/256 ) {
					case $locY - 1: //down one
					$regN = 9;
					break;
					case $locY + 1: //up one
					$regN = 3;
					break;
				}
				break;
		}
		${"RegionName".$regN} = "<a href='?x=".$locX1."&y=".$locY1."'>".$RegionNameX."</a>";
	}
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?= SYSURL ?><? echo $template_css ?>" type="text/css" />
    <link rel="icon" href="<?= SYSURL ?><?=$favicon_image?>" />
    <title><?=SYSNAME?>: <? echo $webui_region_information; ?></title>
</head>

<body class="webui_pop">
<div id="content">
    <h2><?= SYSNAME ?>: <? echo $webui_region_information; ?> &rsaquo; <span><?=$RegionName?></span></h2>
  
    <div id="regioninfo">
	  <!--  <div id="info"><p><? echo $webui_regioninfo ?></p></div> -->
	  <!--  <h2><? echo $webui_region_information; ?>:</h2> -->
    
          
	<div id="regionMap">
	<table cellpadding="0" cellspacing="4">
        <tr>
            <td <?php echo ($RegionName1 ? ">".$RegionName1 : "class='nosim'>")?></td>
            <td <?php echo ($RegionName2 ? ">".$RegionName2 : "class='nosim'>")?></td>
            <td <?php echo ($RegionName3 ? ">".$RegionName3 : "class='nosim'>")?></td>
        </tr>
        <tr>
            <td <?php echo ($RegionName4 ? ">".$RegionName4 : "class='nosim'>")?></td>
            <td class='thissim'><?=$RegionName?></td>
            <td <?php echo ($RegionName6 ? ">".$RegionName6 : "class='nosim'>")?></td>
        </tr>
        <tr>
            <td <?php echo ($RegionName7 ? ">".$RegionName7 : "class='nosim'>")?></td>
            <td <?php echo ($RegionName8 ? ">".$RegionName8 : "class='nosim'>")?></td>
            <td <?php echo ($RegionName9 ? ">".$RegionName9 : "class='nosim'>")?></td>
        </tr>
  </table>
  </div>

    <div id="region_picture">
        <img src="<? echo $source; ?>" alt="<?=$RegionName?>" title="<?=$RegionName?>" />
    </div>
   
   <div id="regiondetails">
    <table>
    	<tr>
        	<td><img src="<? echo $source; ?>" alt="<?=$RegionName?>" title="<?=$RegionName?>" width="128" height="128" /></td>
        </tr>
        <tr>
            <td><? echo $webui_region_name; ?>: <?=$RegionName?></td>
        </tr>
        <tr>
            <td><? echo $webui_region_type; ?>: <?=$regionType?></td>
        </tr>
        <tr>
            <td><? echo $webui_location; ?> X: <?=$locX?> Y: <?=$locY?></td>
        </tr>
        <tr>
            <td><? echo $webui_owner; ?>: <a href="<?=SYSURL?>app/agent/?name=<?=$firstN?> <?=$lastN?>"><?=$firstN?> <?=$lastN?></a></td>
        </tr>
    </table>
    </div>
  </div>
</div>
</body>
</html>