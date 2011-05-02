<div id="validator">
  <?php if($displayW3c) { ?>
    <a href="http://validator.w3.org/check?uri=referer">
      <img src="<?=$images_path?>valid-xhtml10.png" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
  <?php } ?>
  
  <?php if($displayRss) { ?>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
      <img src="<?=$images_path?>valid-css.png" alt="Valid CSS!" /></a>
  <?php } ?>
</div>

