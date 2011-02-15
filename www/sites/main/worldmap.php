<div id="content">
  <h2><?= SYSNAME ?>: <? echo $wiredux_world_map ?> <a <?= "onclick=\"window.open('".SYSURL."app/map/index.php','mywindow','width=1000,height=1000')\"" ?>>Full Screen</a></h2>
    <div id="region_map">
      <iframe src="<?=SYSURL?>/app/map/index.php" frameborder="0" width="100%" height="100%">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
</div>
