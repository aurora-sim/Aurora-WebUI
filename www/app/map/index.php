<?
include("../../settings/config.php");
include("../../settings/mysql.php");

if(($_GET[size])and($ALLOW_ZOOM==TRUE)){
if(($_GET[size] == 64) or ($_GET[size] == 128) or ($_GET[size] == 192) or ($_GET[size] == 256)){
$size=$_GET[size];
}
}else{
$size=128; 
}

if($size==64){
$minuszoom=0; $pluszoom=128; $infosize=10;
}else if($size==128){
$minuszoom=64; $pluszoom=192; $infosize=20;
}else if($size==192){
$minuszoom=128; $pluszoom=256; $infosize=30;
}else if($size==256){
$minuszoom=192; $pluszoom=0; $infosize=40;
}
?>

<HEAD><TITLE><?=SYSNAME?> WorldMap</TITLE>
<STYLE type=text/css media=all>@import url(map.css);</STYLE>

<SCRIPT src="prototype.js" type=text/javascript></SCRIPT>
<SCRIPT src="effects.js" type=text/javascript></SCRIPT>
<SCRIPT src="mapapi.js" type=text/javascript></SCRIPT>


<SCRIPT type=text/javascript>

function loadmap() {
  mapInstance = new ZoomSize(<?=$size?>);
  mapInstance = new WORLDMap(document.getElementById('map-container'), {hasZoomControls: false, hasPanningControls: true});
  mapInstance.centerAndZoomAtWORLDCoord(new XYPoint(<?=$mapstartX?>,<?=$mapstartY?>),1);
<?
$DbLink = new DB;
$DbLink->query("SELECT regionName,locX,locY,PrincipalID FROM ".C_REGIONS_TBL." Order by locX");
while(list($regionName,$locX,$locY,$owner) = $DbLink->next_record()){

$DbLink1 = new DB;
$DbLink1->query("SELECT FirstName,LastName FROM ".C_USERS_TBL." where PrincipalID='$owner'");
list($firstN,$lastN) = $DbLink1->next_record();

$MarkerCoordX=$locX+0.00;
$MarkerCoordY=$locY+0.00;


if($display_marker=="tl"){
$MarkerCoordX=$MarkerCoordX-0.40;
$MarkerCoordY=$MarkerCoordY+0.40;
}else if($display_marker=="tr"){
$MarkerCoordX=$MarkerCoordX+0.40;
$MarkerCoordY=$MarkerCoordY+0.40;
}else if($display_marker=="dl"){
$MarkerCoordX=$MarkerCoordX-0.40;
$MarkerCoordY=$MarkerCoordY-0.40;
}else if($display_marker=="dr"){
$MarkerCoordX=$MarkerCoordX+0.40;
$MarkerCoordY=$MarkerCoordY-0.40;
}
?>


    <?
	$filename = "maptiles/mapimage-".$locX."-".$locY.".jpg";
	if (file_exists($filename)) 
	{
	echo 'var tmp_region_image = new Img("'.$filename.'",'.$size.','.$size.');';
	}
	else
	{
	echo 'var tmp_region_image = new Img("maptiles/no-mapimage.jpg",'.$size.','.$size.');';
	}
	?>
	var region_loc = new Icon(tmp_region_image);
	var all_images = [region_loc, region_loc, region_loc, region_loc, region_loc, region_loc];
	var marker = new Marker(all_images, new XYPoint(<?=$locX?>,<?=$locY?>));
	mapInstance.addMarker(marker);
	
	var map_marker_img = new Img("images/info.gif",<?=$infosize?>,<?=$infosize?>);
	var map_marker_icon = new Icon(map_marker_img);
	var mapWindow = new MapWindow("Region Name: <?=$regionName?><br><br>Coordinates: <?=$locX?>,<?=$locY?><br><br>Owner: <?=$firstN?> <?=$lastN?>",{closeOnMove: true});
	var all_images = [map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon];
	var marker = new Marker(all_images, new XYPoint(<?=$MarkerCoordX?>,<?=$MarkerCoordY?>));
	mapInstance.addMarker(marker, mapWindow);
<?
}
?>

}

function setZoom(size) {
  window.location.href="<?=SYSURL?>/app/map/?size="+size+"";
}


</SCRIPT>

<META content="MSHTML 6.00.2900.5512" name=GENERATOR></HEAD>
<BODY onload=loadmap()>
<DIV id=map-container style="z-index: 0;"></DIV>
<DIV id=map-nav>
<DIV id=map-nav-up style="z-index: 1;"><A href="javascript: mapInstance.panUp();">
<IMG alt=Up src="images/pan_up.gif"></A></DIV>
<DIV id=map-nav-down style="z-index: 1;"><A href="javascript: mapInstance.panDown();">
<IMG alt=Down src="images/pan_down.gif"></A></DIV>
<DIV id=map-nav-left style="z-index: 1;"><A href="javascript: mapInstance.panLeft();">
<IMG alt=Left src="images/pan_left.gif"></A></DIV>
<DIV id=map-nav-right style="z-index: 1;"><A href="javascript: mapInstance.panRight();">
<IMG alt=Right src="images/pan_right.gif"></A></DIV>
<DIV id=map-nav-center style="z-index: 1;"><A href="javascript: mapInstance.panOrRecenterToWORLDCoord(new XYPoint(<?=$mapstartX?>,<?=$mapstartY?>), true);">
<IMG alt=Center src="images/center.gif"></A></DIV>

<!-- START ZOOM PANEL-->
<? if($ALLOW_ZOOM==TRUE){ ?>
<DIV id=map-zoom-plus>
<? if($pluszoom==0){?>
<IMG alt="Zoom In" src="images/zoom_in_grey.gif">
<? } else{?>
<A href="javascript: setZoom(<?=$pluszoom?>);">
<IMG alt="Zoom In" src="images/zoom_in.gif"></A>
<? } ?>
</DIV>
<DIV id=map-zoom-minus>
<? if($minuszoom==0){?>
<IMG alt="Zoom In" src="images/zoom_out_grey.gif">
<? } else{?>
<A href="javascript: setZoom(<?=$minuszoom?>);">
<IMG alt="Zoom Out" src="images/zoom_out.gif"></A>
<? } ?>
</DIV>
<? } ?>
<!-- END ZOOM PANEL-->
</DIV>
</BODY>