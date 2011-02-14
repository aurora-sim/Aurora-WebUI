<div id="content">
  <!--<img src="<? echo WIREDUX_TEXTURE_SERVICE."/index.php?method=MapTexture&zoom=10&x=9850&y=9850"; ?>" width="1000" height="1000" />-->
  <h2><?= SYSNAME ?>: <? echo $wiredux_world_map ?> <a <?= "onclick=\"window.open('".SYSURL."app/map/','mywindow','width=1000,height=1000')\"" ?>>Full Screen </a></h2>
    <div id="region_map">
      <iframe src="<?=SYSURL?>/app/map/index.php" frameborder="0" width="100%" height="100%">
        <p>Your browser does not support iframes.</p>
      </iframe>
    </div>
</div>
