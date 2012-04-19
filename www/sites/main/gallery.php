<!--
	1 ) Reference to the files containing the JavaScript and CSS.
	These files must be located on your server.
-->

<script type="text/javascript" src="javascripts/highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="javascripts/highslide/highslide.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="javascripts/highslide/highslide-ie6.css" />
<![endif]-->



<!--
    2) Optionally override the settings defined at the top
    of the highslide.js file. The parameter hs.graphicsDir is important!
-->

<script type="text/javascript">
    hs.graphicsDir = 'javascripts/highslide/graphics/';
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.fadeInOut = true;
    hs.dimmingOpacity = 0.9;
    hs.outlineType = 'glossy-dark';
    hs.wrapperClassName = 'dark';
    hs.captionEval = 'this.thumb.alt';
    hs.marginBottom = 105; // make room for the thumbstrip and the controls
    hs.numberPosition = 'caption';

    // Add the slideshow providing the controlbar and the thumbstrip
    hs.addSlideshow({
        //slideshowGroup: 'group1',
        interval: 5000,
        repeat: false,
        useControls: true,
        overlayOptions: {
            className: 'text-controls',
            position: 'bottom center',
            relativeTo: 'viewport',
            offsetY: -60
        },
        thumbstrip: {
            position: 'bottom center',
            mode: 'horizontal',
            relativeTo: 'viewport'
        }
    });
</script>

<!-- 3) Put the thumbnails inside a div for styling -->

<div id="content">
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_gallery; ?></h5></div>
    <div id="gallery">
        <div id="info"><p><? echo $webui_gallery_info; ?></p></div>
        <div class="highslide-gallery" style="width: 100%; margin: auto" align="center">
        <!--
      	4) This is how you mark up the thumbnail images with an anchor tag around it.
	      The anchor's href attribute defines the URL of the full-size image. Given the captionEval
	      option is set to 'this.img.alt', the caption is grabbed from the alt attribute of
	      the thumbnail image.
        -->
        <?
          $DbLink->query("SELECT picture,picturethumbnail,description FROM " . C_GALLERY_TBL . " Where active='1' ORDER BY rank ASC ");
          while (list($picture, $picturethumbnail, $description) = $DbLink->next_record()) {
        ?>
        <a class='highslide' href='images/gallery/<?= $picture ?>' onclick="return hs.expand(this)">
        <img src='images/gallery/<?= $picturethumbnail ?>' alt='<?= $description ?>'/></a>
        <? } ?>
      </div>
    </div>
</div>
