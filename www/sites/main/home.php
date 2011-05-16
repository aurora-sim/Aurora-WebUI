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

<? include("sites/modules/steps123.php"); ?>

<div id="annonce7"><h3><? echo $webui_welcome; ?> <?= SYSNAME ?></h3><? echo $webui_home_page; ?></div>
<div id="annonce10"><p><? echo $webui_home_page_warning; ?></p></div>

<? include("sites/modules/infos123.php"); ?>

</div>
