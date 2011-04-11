<div id="content">
<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>

<div id="ContentHeaderCenter">
<?php if($displayDate) { ?>
    <div id="date">
     <?php $date = date("d-m-Y");
    $heure = date("H:i");
    Print("$webui_before_date $date $webui_after_date $heure");
    ?>
    </div>
<?php } ?>
</div>

<div id="ContentHeaderRight"><h5><? echo $webui_home; ?></h5></div>

<? include("sites/modules/steps123.php"); ?>

<div id="annonce7"><h3><p><? echo $webui_welcome; ?> <?= SYSNAME ?></h3><? echo $webui_home_page; ?><p></div>
<div id="annonce10"><p><? echo $webui_home_page_warning; ?></p></div>

<? include("sites/modules/infos123.php"); ?>

</div>
