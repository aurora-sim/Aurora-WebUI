<!-- Test Translation  -->
<div id="Translator_Module">
    <div class="textcolorwhite">
        <?
        foreach ($languages as $langCode => $langName) {
            if ($langCode != $wiredux_language_code) {
                echo ' <a href="?lang=' . $langCode . '"><img src="images/flags/flag-' . $langCode . '.png" alt=" ' . $langName . '" title=" ' . $langName . '" /></a>';
            }
        } ?>
        <?php echo $wiredux_actual_language; ?>
    </div></div>
