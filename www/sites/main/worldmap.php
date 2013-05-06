<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key="></script>
<script src="worldmap/slmapapi.php"></script>
<link rel="stylesheet" type="text/css" href="worldmap/css/slmapapi.css" />
<style type="text/css">#map-container {width: 100%; height: 380px; color: #546368;}</style>

<script type="text/javascript">
    function loadmap(){
        var coords = {'x' : <?php echo $mapstartX; ?> + 0.5, 'y' : <?php echo $mapstartY; ?> + 0.5},
        mapInstance = new SLURL.Map(document.getElementById('map-container'), {'overviewMapControl':true});
        mapInstance.centerAndZoomAtSLCoord(new SLURL.XYPoint(coords.x, coords.y), 3);}
    $(document).ready(loadmap);
</script>

<div id="content">
    <div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?>: <?php echo $webui_world_map; ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight">
        <h5><a onClick="window.open('<?php echo SYSURL; ?>worldmap/','mywindow')" style="cursor:pointer; float:right; display:inline-block;"><?php echo $webui_fullscreen; ?></a></h5>
    </div>
    <div class="clear"></div>
    <div id = "map-container"></div>
</div>
