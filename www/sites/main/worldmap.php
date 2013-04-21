<div id="content">
  <div id="ContentHeaderLeft"><h5><p><?= SYSNAME ?></p></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><p><? echo $webui_world_map; ?></p></h5></div>
    <style type="text/css">
		#map-container {width: 100%; height: 445px;}
    </style>
  <div id="map-container">
  </div>
  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key="></script>
  <script src="map/slmapapi.php"></script>
  <link rel="stylesheet" type="text/css" href="map/slmapapi.css" />

  <script type="text/javascript">
    function loadmap(){
        var coords = {'x' : <?  echo $mapstartX ?> + 0.5, 'y' : <? echo $mapstartY ?> + 0.5},
        mapInstance = new SLURL.Map(document.getElementById('map-container'), {'overviewMapControl':true});
        mapInstance.centerAndZoomAtSLCoord(new SLURL.XYPoint(coords.x, coords.y), 3);}
    $(document).ready(loadmap);
  </script>
</div>