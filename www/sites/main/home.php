<div id="content">
<?php if($displayDate) { ?>
<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>

<div id="ContentHeaderCenter">
    <div id="date">
     <?php $date = date("d-m-Y");
    $heure = date("H:i");
    Print("$webui_before_date $date $webui_after_date $heure");
    ?>
    </div>
</div>
<div id="ContentHeaderRight"><h5><? echo $webui_home; ?></h5></div>
<?php } ?>
<div class="clear"></div>
    <?php
    if($_SESSION[NAME]) include("sites/modules/homeusers.php");
    else include("sites/modules/homevisitor.php");
    ?>

</div>
