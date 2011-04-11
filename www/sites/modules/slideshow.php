<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.cycle.all.2.74.js"></script>
<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.easing.compatibility.js"></script>
<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">

$(document).ready(function() {
    $('.slideshow')
    .before('<div id="nav">') 
    .cycle({
    fx:      '<?= $SlideShowStyle ?>', 
    timeout: '<?= $SlideShowTimeout ?>', 
    speed:   '<?= $SlideShowSpeed ?>',
    easing:  '<?= $SlideShowEaseing  ?>',
    delay:   '<?= $SlideShowDelay ?>',
    sync:    '<?= $SlideShowSync ?>',
    // next:    '<?= $SlideShowNext ?>',
    // prev:    '<?= $SlideShowPrev ?>',
    pause:   '<?= $SlideShowPause ?>',
    random:  '<?= $SlideShowRandom ?>',
    pager:   '<?= $SlideShowPager ?>'
    /* before:  onBefore, */ 
    /* after:    onAfter */
    /* speedIn:  2500, */
    /* speedOut: 500, */
	});

});
</script>


<?php if($displaySlideShow) { ?>
  <div class="slideshow">
    <img src="<?= SYSURL ?>images/gallery/login1.jpg" title="<? echo $webui_slideshow_comment01; ?>" alt="" />
  	<img src="<?= SYSURL ?>images/gallery/login2.jpg" title="<? echo $webui_slideshow_comment02; ?>" alt="" />
	 <img src="<?= SYSURL ?>images/gallery/login3.jpg" title="<? echo $webui_slideshow_comment03; ?>" alt="" />
  	<img src="<?= SYSURL ?>images/gallery/login4.jpg" title="<? echo $webui_slideshow_comment04; ?>" alt="" />
  	<img src="<?= SYSURL ?>images/gallery/login5.jpg" title="<? echo $webui_slideshow_comment05; ?>" alt="" />
  </div>
<?php } ?>
