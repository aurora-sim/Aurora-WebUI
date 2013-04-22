<?php
include("../settings/config.php");
include("../languages/translator.php");
?>

<html lang="en">
<head>
<meta charset="utf-8">
    <title><?php echo SYSNAME; ?>: <?php echo $webui_world_map; ?></title>
    <meta name="keywords" content="{SystemName}" />
    <meta name="description" content="{SystemName}"/>
    <link rel="shortcut icon" href="../images/icons/favicon.ico" />
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key="></script>
    <script type="text/javascript" src="../javascripts/jquery/jquery.min.js"></script>
    <script src="../map/slmapapi.php"></script>
    <link rel="stylesheet" type="text/css" href="../map/slmapapi.css" />
    <style type="text/css">#map-container {width: 100%; height: 100%;}</style>

    <script type="text/javascript">
    function loadmap(){
        var coords = {'x' : <?php  echo $mapstartX; ?> + 0.5, 'y' : <?php echo $mapstartY; ?> + 0.5},
        mapInstance = new SLURL.Map(document.getElementById('map-container'), {'overviewMapControl':true});
        mapInstance.centerAndZoomAtSLCoord(new SLURL.XYPoint(coords.x, coords.y), 3);}
    $(document).ready(loadmap);
    </script>
</head>

<body><div id = "map-container"></div></body></html>