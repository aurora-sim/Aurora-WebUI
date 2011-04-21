<?
include("../../settings/config.php");
include("../../settings/mysql.php");
include("../../settings/json.php");

$maxZoom = 8;
$sizes=array(1 => 4,
    2 => 8,
    3 => 16,
    4 => 32,
    5 => 64,
    6 => 128,
    7 => 256,
    8 => 512);

if($ALLOW_ZOOM == TRUE && $_GET[zoom])
{
	foreach ($sizes as $zoomUntested => $sizeUntested) 
	{
		if($zoomUntested == $_GET[zoom])
		{
		    $zoomSize = $sizeUntested;
		    $zoomLevel = $zoomUntested;
		}
		if($zoomUntested == 9-$_GET[zoom])
		{
		    $antiZoomSize = $sizeUntested;
		}
	}
}

if ($zoomLevel == 1) {
    $infosize = 4;
} else if ($zoomLevel == 2) {
    $infosize = 5;
} else if ($zoomLevel == 3) {
    $infosize = 7;
} else if ($zoomLevel == 4) {
    $infosize = 10;
} else if ($zoomLevel == 5) {
    $infosize = 10;
} else if ($zoomLevel == 6) {
    $infosize = 20;
} else if ($zoomLevel == 7) {
    $infosize = 30;
} else if ($zoomLevel == 8) {
    $infosize = 40;
}

if ($_GET[startx]) {
    $mapX = $_GET[startx];
} else {
    $mapX = $mapstartX;
}

if ($_GET[starty]) {
    $mapY = $_GET[starty];
} else {
    $mapY = $mapstartY;
}
?>

<head>
  <title><?= SYSNAME ?> World Map</title>
  <style type="text/css" media=all>@import url(map.css);</style>
  <script src="prototype.js" type="text/javascript"></script>
  <script src="effects.js" type="text/javascript"></script>
  <script src="mapapi.js" type="text/javascript"></script>

  <script type="text/javascript">
  function loadmap() 
  {
    <? if ($ALLOW_ZOOM == TRUE) { ?>    
        if (window.addEventListener)
        /** DOMMouseScroll is for mozilla. */
        window.addEventListener('DOMMouseScroll', wheel, false);
        /* IE/Opera. */
        window.onmousewheel = document.onmousewheel = wheel;
    <? } ?>

    mapInstance = new ZoomSize(<?= $zoomSize ?>);
    mapInstance = new WORLDMap(document.getElementById('map-container'), {hasZoomControls: true, hasPanningControls: true});
    mapInstance.centerAndZoomAtWORLDCoord(new XYPoint(<?= $mapX ?>,<?= $mapY ?>),1);
<?
  $DbLink = new DB;
  $DbLink->query("SELECT RegionUUID, RegionName,LocX,LocY,SizeX,SizeY,OwnerUUID,Info FROM " . C_REGIONS_TBL . " Order by LocX");
  while (list($uuid, $regionName, $locX, $locY, $sizeX, $sizeY, $owner, $info) = $DbLink->next_record()) {

  $DbLink1 = new DB;
  $DbLink1->query("SELECT FirstName,LastName FROM " . C_USERS_TBL . " where PrincipalID='".cleanQuery($owner)."'");
  list($firstN, $lastN) = $DbLink1->next_record();

  $MarkerCoordX = $locX;
  $MarkerCoordY = $locY;

  $regionSizeOffset = ($sizeX / 256) * 0.40;
  if ($display_marker == "tl") {
    $MarkerCoordX = ($MarkerCoordX / 256) - $regionSizeOffset;
    $MarkerCoordY = ($MarkerCoordY / 256) + $regionSizeOffset;
  }
  
  else if ($display_marker == "tr") {
    $MarkerCoordX = ($MarkerCoordX / 256) + $regionSizeOffset;
    $MarkerCoordY = ($MarkerCoordY / 256) + $regionSizeOffset;
  }
  
  else if ($display_marker == "dl") {
    $MarkerCoordX = ($MarkerCoordX / 256) - $regionSizeOffset;
    $MarkerCoordY = ($MarkerCoordY / 256) - $regionSizeOffset;
  }
  
  else if ($display_marker == "dr") {
    $MarkerCoordX = ($MarkerCoordX / 256) + $regionSizeOffset;
    $MarkerCoordY = ($MarkerCoordY / 256) - $regionSizeOffset;
  }
  
  $recieved = json_decode($info);
  $serverUrl = $recieved->{'serverURI'};
  $uuid = str_replace('-', '', $uuid);
  $filename = $serverUrl . "/index.php?method=regionImage" . $uuid;
  $mapTextureURL = WIREDUX_TEXTURE_SERVICE.'/index.php?method=MapTexture&zoom='. $antiZoomSize .'&x=' . $mapX . '&y=' . $mapY;
  echo 'var tmp_region_image = new Img("' . $filename . '",' . $zoomSize * ($sizeX / 256) . ',' . $zoomSize * ($sizeY / 256) . ');';
  $url = "secondlife://" . $regionName . "/" . ($sizeX / 2) . "/" . ($sizeY / 2);
?>
var region_loc = new Icon(tmp_region_image);
var all_images = [region_loc, region_loc, region_loc, region_loc, region_loc, region_loc];
var marker = new Marker(all_images, new XYPoint(<?= (($locX / 256)) ?>,<?= (($locY / 256)) ?>));
mapInstance.addMarker(marker);

var map_marker_img = new Img("images/info.gif",<?= $infosize ?>,<?= $infosize ?>);
var map_marker_icon = new Icon(map_marker_img);
var mapWindow = new MapWindow("Region Name: <?= $regionName ?><br /><br />Coordinates: <?= $locX / 256 ?>,<?= $locY / 256 ?><br /><br />Size: <?= $sizeX ?>,<?= $sizeY ?><br><br>Owner: <?= $firstN ?> <?= $lastN ?><br><br><a href=<?= $url ?>>Teleport</a>",{closeOnMove: true});
var all_images = [map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon, map_marker_icon];
var marker = new Marker(all_images, new XYPoint(<?= $MarkerCoordX ?>,<?= $MarkerCoordY ?>));
mapInstance.addMarker(marker, mapWindow);
<? } ?>
}

function setZoom(size) {
  var a = mapInstance.getViewportBounds();
  var x = (a.xMin + a.xMax) / 2;
  var y = (a.yMin + a.yMax) / 2;
  window.location.href="<?= SYSURL ?>app/map/?zoom="+size+"&startx="+x+"&starty="+y;
}

function wheel(event){
  var delta = 0;
  if (!event) /* For IE. */
    event = window.event;
  if (event.wheelDelta) { /* IE/Opera. */
    delta = event.wheelDelta/120;
    /** In Opera 9, delta differs in sign as compared to IE.
    */
    if (window.opera)
      delta = -delta;
  }
  
  else if (event.detail) { /** Mozilla case. */
    /** In Mozilla, sign of delta is different than in IE.
    * Also, delta is multiple of 3.
    */
    delta = -event.detail/3;
  }
  
  /** If delta is nonzero, handle it.
  * Basically, delta is now positive if wheel was scrolled up,
  * and negative, if wheel was scrolled down.
  */
  if (delta)
    handle(delta);
        
  /** Prevent default actions caused by mouse wheel.
  * That might be ugly, but we handle scrolls somehow
  * anyway, so don't bother here..
  */
  if (event.preventDefault)
    event.preventDefault();
    event.returnValue = false;
}

function handle(delta) {
  if (delta == 1) { 
    <? if (($zoomLevel) < $maxZoom) { ?> setZoom(<?echo ($zoomLevel + 1); ?>);
    <? } ?>
  }
  
  else {
    <? if (($zoomLevel - 1) != 0) { ?>setZoom(<?echo ($zoomLevel - 1); ?>);<? } ?>
  }
}
</script>

</head>

<body class="webui" onload=loadmap()>

<div id=map-container style="z-index: 0;"></div>

<div id=map-nav>
  <div id=map-nav-up style="z-index: 1;"><a href="javascript: mapInstance.panUp();">
    <img alt=Up src="images/pan_up.png"></a>
  </div>
  
  <div id=map-nav-down style="z-index: 1;"><a href="javascript: mapInstance.panDown();">
    <img alt=Down src="images/pan_down.png"></a>
  </div>
  
  <div id=map-nav-left style="z-index: 1;"><a href="javascript: mapInstance.panLeft();">
    <img alt=Left src="images/pan_left.png"></a>
  </div>
  
  <div id=map-nav-right style="z-index: 1;"><a href="javascript: mapInstance.panRight();">
    <img alt=Right src="images/pan_right.png"></a>
  </div>
  
  <div id=map-nav-center style="z-index: 1;"><a href="javascript: mapInstance.panOrRecenterToWORLDCoord(new XYPoint(<?= $mapstartX ?>,<?= $mapstartY ?>), true);">
    <img alt=Center src="images/center.png"></a>
  </div>
  
  <!-- START ZOOM PANEL-->
  <? if ($ALLOW_ZOOM == TRUE) { ?>
    <div id=map-zoom-plus>
      <? if (($zoomLevel + 1) > $maxZoom) { ?>
        <img alt="Zoom In" src="images/zoom_in_grey.png">
        <? } else { ?>
          <a href="javascript: setZoom(<?= ($zoomLevel + 1) ?>);">
            <img alt="Zoom In" src="images/zoom_in.png">
          </a>
        <? } ?>
    </div>
    
    <div id=map-zoom-minus>
      <? if (($zoomLevel - 1) == 0) { ?>
        <img alt="Zoom In" src="images/zoom_out_grey.png">
        <? } else { ?>
          <a href="javascript: setZoom(<?= ($zoomLevel - 1) ?>);">
            <img alt="Zoom Out" src="images/zoom_out.png">
          </a>
        <? } ?>
    </div>
    <? } ?>
  <!-- END ZOOM PANEL-->
</div>
</body>
