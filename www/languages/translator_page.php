<!-- Test Translation  -->
<div>
    <?php echo $webui_actual_language; ?>
    <?
      foreach ($languages as $langCode => $langName) {
        if ($langCode != $webui_language_code) {
        echo ' <a href="?page='.$_GET[page].'&btn='.$_GET[btn].'&lang=' . $langCode . '">
               <img src="images/flags/flag-' . $langCode . '.png" alt=" ' . $langName . '" title=" ' . $langName . '" /></a>';
        }
      } 
    ?>
</div>

