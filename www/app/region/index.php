<?
include("../../settings/config.php");
include("../../settings/databaseinfo.php");
include("../../settings/mysql.php");
include("../../settings/json.php");
include("../../languages/translator.php");
include("../../templates/templates.php");

use Aurora\Addon\WebUI\Configs;
$regions = Configs::d()->GetRegionsByXY($_GET['x'], $_GET['y']);
$region = $regions->current();
$RegionName = $region->RegionName();
$regionType = $region->RegionType();
$owner = Configs::d()->GetGridUserInfo($region->EstateOwner());
$firstN = $owner->FirstName();
$lastN = $owner->LastName();
$locX = $region->RegionLocX() / 256;
$locY = $region->RegionLocY() / 256;
if ($regionType == ''){
    $regionType = 'Unknown';
}
$source = $region->ServerURI() . "/index.php?method=regionImage" . str_replace('-', '', $region->RegionID());

$DbLink = new DB;

  $DbLink->query("SELECT id,
                         displayTopPanelSlider, 
                         displayTemplateSelector,
                         displayStyleSwitcher,
                         displayStyleSizer,
                         displayFontSizer,
                         displayLanguageSelector,
                         displayScrollingText,
                         displayWelcomeMessage,
                         displayLogo,
                         displayLogoEffect,
                         displaySlideShow,
                         displayMegaMenu,
                         displayDate,
                         displayTime,
                         displayRoundedCorner,
                         displayBackgroundColorAnimation,
                         displayPageLoadTime,
                         displayW3c,
                         displayRss FROM ".C_ADMINMODULES_TBL." ");
                     
  list($id,
       $displayTopPanelSlider,
       $displayTemplateSelector, 
       $displayStyleSwitcher,
       $displayStyleSizer,
       $displayFontSizer,
       $displayLanguageSelector,
       $displayScrollingText,
       $displayWelcomeMessage,
       $displayLogo,
       $displayLogoEffect,
       $displaySlideShow,
       $displayMegaMenu,
       $displayDate,
       $displayTime,
       $displayRoundedCorner,
       $displayBackgroundColorAnimation,
       $displayPageLoadTime,
       $displayW3c,
       $displayRss) = $DbLink->next_record();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="<?= SYSURL ?><? echo $template_css ?>" type="text/css" />
  <link rel="icon" href="<?= SYSURL ?><?= $favicon_image ?>" />
  <title><?= SYSNAME ?>: <? echo $webui_region_information; ?></title>

<?php if($displayRoundedCorner)  { ?>
<script src="<?= SYSURL ?>javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.corner.js?v2.11"></script>
<script type="text/javascript">
	  $("#regionMap .nosim, #regionMap .thissim, #regionMap tr td").corner("10px");
	  $("#region_picture").corner("15px");
		$("#container_popup, #content_popup").corner();
</script>
<?php } ?>

</head>

<body class="webui">
<div id="container_popup">
<div id="content_popup">
  <h2><?= SYSNAME ?>: <? echo $webui_region_information; ?></h2>
  
  <div id="regioninfo">
  <!--  <div id="info"><p><? // echo $webui_regioninfo ?></p></div> -->
  <!--  <h2><? // echo $webui_region_information; ?>:</h2> -->

    <hr>
<?php
	$range = $region->RegionSizeX();
	$range = $region->RegionSizeY() > $range ? $region->RegionSizeY() : $range;
	$neighbours = Configs::d()->GetRegionNeighbours($region->RegionID(), (integer)ceil($range / 2));
	if($neighbours->count() > 0){
?>
    <div id="regionMap">
		<h3>Neighbours:</h3>
		<ul>
<?php
		foreach($neighbours as $neighbour){
			$query = array(
				'x' => $neighbour->RegionLocX(),
				'y' => $neighbour->RegionLocY(),
				'z' => $neighbour->RegionLocZ()
			);
			if($query['z'] == 0){
				unset($query['z']);
			}
?>
			<li><a href="?<?php echo http_build_query($query, '', '&amp;'); ?>"><?php echo htmlentities($neighbour->RegionName()); ?></a></li>
<?php	} ?>
		</ul>
    </div>
<?php } ?>

    <div id="region_picture">
      <img src="<? echo $source; ?>" alt="<?= $RegionName ?>" title="<?= $RegionName ?>" />
    </div>

    <div id="regiondetails">
      <table>
        <tr>
          <td><? echo $webui_region_name; ?>: <?= $RegionName ?></td>
        </tr>
      
        <tr>
          <td><? echo $webui_region_type; ?>: <?= $regionType ?></td>
        </tr>
      
        <tr>
          <td><? echo $webui_location; ?> X: <?= $locX ?> Y: <?= $locY ?></td>
        </tr>
      
        <tr>
          <td><? echo $webui_owner; ?>: <a href="<?= SYSURL ?>app/agent/?name=<?= $firstN ?> <?= $lastN ?>"><?= $firstN ?> <?= $lastN ?></a></td>
        </tr>
      </table>
    </div>
  </div>
</div>
</div>
