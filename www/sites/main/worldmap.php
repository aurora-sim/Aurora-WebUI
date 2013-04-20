<html lang="en">
<head>
<meta charset="utf-8">
    <title><?= SYSNAME ?>: <? echo $webui_world_map ?></title>
    <meta name="keywords" content="{SystemName}" />
    <meta name="description" content="{SystemName}"/>
    <link rel="shortcut icon" href="images/icons/favicon.ico" />
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key="></script>
    <script type="text/javascript" src="javascripts/jquery/jquery.min.js"></script>
    <script src="map/slmapapi.php"></script>
    <link rel="stylesheet" type="text/css" href="map/slmapapi.css" />

    <style type="text/css">
	    html, body, {width: 100%; height: 100%; margin: 0px; padding: 0px;}
		#map-container {width: 100%; height: 100%;}
    </style>

    <script type="text/javascript">
    function loadmap(){
        var coords = {'x' : <?  echo $webui_map_GridCenterX ?> + 0.5, 'y' : <? echo $webui_map_GridCenterY ?> + 0.5},
        mapInstance = new SLURL.Map(document.getElementById('map-container'), {'overviewMapControl':true});
        mapInstance.centerAndZoomAtSLCoord(new SLURL.XYPoint(coords.x, coords.y), 3);}
    $(document).ready(loadmap);
    </script>
</head>

<body><div id=map-container></div></body></html>