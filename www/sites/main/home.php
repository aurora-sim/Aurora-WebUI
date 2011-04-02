<div id="content">
<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
<div id="ContentHeaderCenter">
    
    <?php if($showScrollingText)
    { ?>
    <div class="horizontal_scroller" id="scrollercontrol">
      <div class="scrollingtext">
        <?php echo $scrollingTextMessage; ?>
      </div>
    </div>
    <?php } ?>
    
</div>

<div id="ContentHeaderRight"><h5><? echo $webui_home; ?></h5></div>



<? echo $webui_home_page; ?>
</div>





