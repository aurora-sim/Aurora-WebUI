<div id="panel">
<div id="switchers">
<table id="options">
  <tr>
    <? if($displayTemplateSelector) { ?>
    <td>Templates : </td>
    <td>
      <form method="post" action="post">
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
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style1/style1.png" alt="style1" title="style1" />
      </a>
    </td>
    <td>
      <a href="<?php echo $actuel; ?>?style=style2">
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style2/style2.png" alt="style2" title="style2" />
      </a>
    </td>
    <td>
      <a href="<?php echo $actuel; ?>?style=style3">
        <img src="<?php echo $SITE_URL . $TEMPLATES; ?>templates/default/style3/style3.png" alt="style3" title="style3" />
      </a>
    </td> <? } ?>

    <? if($displayStyleSizer) { ?>
    <td>Size : </td>
    <td><button id="s">S</button></td>
    <td><button id="m">M</button></td>
    <td><button id="l">L</button></td>
    <? } ?>
    
    <? if($displayFontSizer) { ?>   
    <td>Font : </td>   
    <td><button id="down">-</button></td>
    <td><button id="reset">R</button></td>
    <td><button id="up">+</button></td>
    <? } ?>

  </tr>
</table>
</div>
</div>

<div class="slide"><a href="#" class="btn-slide">Options</a></div>

<? if($displayStyleSizer) { ?>
<script type="text/javascript">
  $("#s").click(function(){
  $("#topcontainer").animate({width: "870px"}, 500 ); 
  $("#container").animate({width: "850px"}, 500 );
  $("#content").animate({width: "830px"}, 500 );   
  $("#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5").animate({width: "130px"}, 500 ); 
  });
       
  $("#m").click(function(){
    $("#topcontainer").animate({width: "920px"}, 500 );
    $("#container").animate({width: "900px"}, 500 );
    $("#content").animate({width: "880px"}, 500 );
    $("#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5").animate({width: "140px"}, 500 ); 
  });

  $("#l").click(function(){
    $("#topcontainer").animate({width: "970px"}, 500 );
    $("#container").animate({width: "950px"}, 500 );
    $("#content").animate({width: "930px"}, 500 );
    $("#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5").animate({width: "150px"}, 500 ); 
  }); 
</script>
<? } ?>
