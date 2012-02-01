<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?>: <? echo $webui_world_map ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight">
  <h5><a <?= "onclick=\"window.open('".SYSURL."app/map/index.php','mywindow')\"" ?> style="float:right; display:inline-block;"><? echo $webui_fullscreen; ?></a></h5></div>

<div class="clear"></div>

  <div id="region_map">

    <iframe src="<?=SYSURL?>app/map/index.php" frameborder="0" width="100%" height="100%">
    <p>Your browser does not support iframes.</p>
  </iframe>
  </div>
</div>
