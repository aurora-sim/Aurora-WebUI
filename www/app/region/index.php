<? 
include("../../settings/config.php");
include("../../settings/mysql.php");
include("../../languages/translator.php");
include("../../skins/skins.php");

$DbLink = new DB;
$query = "SELECT RegionName,LocX,LocY,OwnerUUID,Info FROM ".C_REGIONS_TBL." where LocX='".$_GET[x]."' and LocY='".$_GET[y]."'";
$DbLink->query($query);
list($RegionName,$locX,$locY,$owner, $info) = $DbLink->next_record();
$locX = $locX/256;
$locY = $locY/256;
$recieved = json_decode($info);
$regionType = $recieved->{'regionType'};
if($regionType == '')
$regionType = 'Unknown';
$DbLink->query("SELECT FirstName,LastName FROM ".C_USERS_TBL." where PrincipalID='$owner'");
list($firstN,$lastN) = $DbLink->next_record();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="<?= SYSURL ?><? echo $skin_css ?>" type="text/css" />
    <link rel="icon" href="<?= SYSURL ?>images/main/favicon.ico" />
    <title><?=SYSNAME?>: <? echo $webui_region_information; ?></title>
</head>

<body class="webui">

<div id="content">
    <h2><?= SYSNAME ?>: <? echo $webui_region_information; ?></h2>
  
    <div id="regioninfo">
	  <!--  <div id="info"><p><? echo $webui_regioninfo ?></p></div> -->
	  <!--  <h2><? echo $webui_region_information; ?>:</h2> -->
    <hr>
    <table>
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
            <td><? echo $webui_owner; ?>: <a href="<?=SYSURL?>/app/agent/?first=<?=$firstN?>&last=<?=$lastN?>"><?=$firstN?> <?=$lastN?></a></td>
        </tr>
    </table>

    <div id="region_picture">
        <img src="regionimage.php?x=<?=$locX?>&y=<?=$locY?>" alt="<?=$RegionName?>" title="<?=$RegionName?>" />
    </div>

  </div>
  <hr>
</div>
</body>
</html>
