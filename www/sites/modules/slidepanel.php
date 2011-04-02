<div id="panel">
<div id="switchers">
<table id="options">
  <tr>

<? if($displayTemplateSelector) { ?>


    <td>Templates : </td>
    <td>
      <form method="post" action="">
        <div>
          <select name="template">
            <option class="template1">Default</option>
            <option class="template2">White</option>
            <option class="template3">Astra</option>
          </select>
        </div>
      </form>
    </td> <? } ?>

<? if($displayStyleSwitcher) { ?>
    <td>Styles : </td>
    <td>
      <a href="<?php echo $actuel; ?>?style=style1">
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style1/style1.png" alt=""/>
      </a>
    </td>
    <td>
      <a href="<?php echo $actuel; ?>?style=style2">
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style2/style2.png" alt=""/>
      </a>
    </td>
    <td>
      <a href="<?php echo $actuel; ?>?style=style3">
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style3/style3.png" alt=""/>
      </a>
    </td> <? } ?>

<? if($displayStyleSizer) { ?>   
    <td>Size : </td>
    <td><a href="templates/default/resizesite.php?s=small">S</a></td>
    <td><a href="templates/default/resizesite.php?s=medium">M</a></td>
    <td><a href="templates/default/resizesite.php?s=large">L</a></td>
    <? } ?>

<? if($displayFontSizer) { ?>   
    <td>Font : </td>
    <td><a href="templates/default/resizefont.php?f=font12">S</a></td>
    <td><a href="templates/default/resizefont.php?f=font14">M</a></td>
    <td><a href="templates/default/resizefont.php?f=font18">L</a></td>
    <? } ?>
  </tr>
</table>
</div>
</div>

<p class="slide"><a href="#" class="btn-slide">Options</a></p>
