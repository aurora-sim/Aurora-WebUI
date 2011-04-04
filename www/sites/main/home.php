<div id="content">
<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
<div id="ContentHeaderCenter">


<?php if($showScrollingText) { ?>

      
    <div id="date">
     <?php $date = date("d-m-Y");
    $heure = date("H:i");
    Print("$webui_before_date $date $webui_after_date $heure");
    ?>
    </div>

<?php } ?>


</div>
<div id="ContentHeaderRight"><h5><? echo $webui_home; ?></h5></div>
<? echo $webui_home_page; ?>
</div>
