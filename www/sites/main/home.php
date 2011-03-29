<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery-1.3.1.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        //Execute the slideShow
        slideShow();
    });

    function slideShow() {

        //Set the opacity of all images to 0
        $('#gallery_slideshow a').css({opacity: 0.0});

        //Get the first image and display it (set it to full opacity)
        $('#gallery_slideshow a:first').css({opacity: 1.0});

        //Set the caption background to semi-transparent
        $('#gallery_slideshow .caption').css({opacity: 0.7});

        //Resize the width of the caption according to the image width
        $('#gallery_slideshow .caption').css({width: $('#gallery_slideshow a').find('img').css('width')});

        //Get the caption of the first image from REL attribute and display it
        $('#gallery_slideshow .content').html($('#gallery_slideshow a:first').find('img').attr('rel'))
                .animate({opacity: 0.7}, 400);

        //Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
        setInterval('gallery()', 6000);
    }

    function gallery() {

        //if no IMGs have the show class, grab the first image
        var current = ($('#gallery_slideshow a.show') ? $('#gallery_slideshow a.show') : $('#gallery_slideshow a:first'));

        //Get next image, if it reached the end of the slideshow, rotate it back to the first image
        var next = ((current.next().length) ? ((current.next().hasClass('caption')) ? $('#gallery_slideshow a:first') : current.next()) : $('#gallery_slideshow a:first'));

        //Get next image caption
        var caption = next.find('img').attr('rel');

        //Set the fade in effect for the next image, show class has higher z-index
        next.css({opacity: 0.0})
                .addClass('show')
                .animate({opacity: 1.0}, 1000);

        //Hide the current image
        current.animate({opacity: 0.0}, 1000)
                .removeClass('show');

        //Set the opacity to 0 and height to 1px
        $('#gallery_slideshow .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });

        //Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
        $('#gallery_slideshow .caption').animate({opacity: 0.7}, 100).animate({height: '50px'}, 500);

        //Display the content
        $('#gallery_slideshow .content').html(caption);


    }

</script>

<div id="content">
    <div id="home_content">
        <h2><? echo $webui_welcome; ?> <?= SYSNAME ?></h2>
        <? echo $webui_home_page; ?>
    </div>
    <div id="gallery_slideshow">
        <a href="#" class="show">
            <img src="<?= SYSURL ?>images/gallery/image1thumbnail.jpg" width="169" height="169" title=""
                 alt="<?= SYSNAME ?>" rel="<h3><?= SYSNAME ?></h3><? echo $webui_slideshow_comment01; ?>"/>
        </a>

        <a href="#">
            <img src="<?= SYSURL ?>images/gallery/image2thumbnail.jpg" width="169" height="169" title=""
                 alt="<?= SYSNAME ?>" rel="<h3><?= SYSNAME ?></h3><? echo $webui_slideshow_comment02; ?>"/>
        </a>

        <a href="#">
            <img src="<?= SYSURL ?>images/gallery/image3thumbnail.jpg" width="169" height="169" title=""
                 alt="<?= SYSNAME ?>" rel="<h3><?= SYSNAME ?></h3><? echo $webui_slideshow_comment03; ?>"/>
        </a>

        <a href="#">
            <img src="<?= SYSURL ?>images/gallery/image4thumbnail.jpg" width="169" height="169" title=""
                 alt="<?= SYSNAME ?>" rel="<h3><?= SYSNAME ?></h3><? echo $webui_slideshow_comment04; ?>"/>
        </a>

        <a href="#">
            <img src="<?= SYSURL ?>images/gallery/image5thumbnail.jpg" width="169" height="169" title=""
                 alt="<?= SYSNAME ?>" rel="<h3><?= SYSNAME ?></h3><? echo $webui_slideshow_comment01; ?>"/>
        </a>

        <div class="caption">
            <div class="content"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
