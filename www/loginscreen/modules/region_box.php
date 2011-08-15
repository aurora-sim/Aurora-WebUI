<?php
  include("../languages/translator.php");
  if($_GET[regio]==""){$ORDERBY=" ORDER by regionName ASC";}
  else if($_GET[regio]=="name"){$ORDERBY=" ORDER by regionName ASC";}
  else if($_GET[regio]=="x"){$ORDERBY=" ORDER by locX ASC";}
  else if($_GET[regio]=="y"){$ORDERBY=" ORDER by locY ASC";}
?>

<table width="300" height="120" border=0 cellPadding=0 cellSpacing=0>
  <tbody>
  <tr>
    <td vAlign=top align=right>
      <table width=100% height="100" border=0 cellPadding=0 cellSpacing=0>
        <tbody>
        <tr>          
          <td class=gridbox_tl><img height=5 width=5 src="<?php echo SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_t><img height=5 width=5 src="<?php echo SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_tr><img height=5 width=5 src="<?php echo SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
        </tr>
        <tr>
          <td class=gridbox_l></td>
          <td class=black_content>
	  
            <table cellSpacing=0 cellPadding=1 width="300" border=0>
              <tbody>
              <tr>
                <td width="55%" align=left class=regiontoptext>
                  <a style="cursor:pointer" onclick="document.location.href='?regio=name'">
                  <strong><?php echo $webui_regionbox; ?>:</strong></a>
                </td>
                <td width="20%" align=left class=regiontoptext>
                  <div align="left">
                    <a style="cursor:pointer" onclick="document.location.href='?regio=x'"><strong>X</strong></a>
                  </div>
                </td>
                <td width="20%" align=right class=regiontoptext>
                  <div align="left">
                    <a style="cursor:pointer" onclick="document.location.href='?regio=y'"><strong>Y</strong></a>
                  </div>
                </td>
              </tr>
		     	</tbody>
			</table>
      
      <div id=GREX style="MARGIN: 1px 0px 0px">
        <img height=1 src="<?php echo SYSURL ?>loginscreen/images/icons/spacer.gif" width=1>
      </div>
            
			<div style=" border:hidden; color:#ffffff; padding:0px; width:300px; height:160px; overflow:auto; ">
			<?php
        $w=0;
			  $DbLink->query("SELECT regionName,locX,locY FROM ".C_REGIONS_TBL." $ORDERBY ");
			  while(list($regionName,$locX,$locY) = $DbLink->next_record()){
			  $w++;
			?>
			
			  <table cellSpacing=0 cellPadding=0 width="100%" border=0>
          <tbody>
          <tr <?php if($w==2){$w=0; echo"class=even";}else{echo"class=odd";}?> >
            <td width="55%" align=left vAlign=top noWrap class=regiontext>
				      <a style="cursor:pointer" onclick="document.location.href='secondlife://<?php echo $regionName?>/128/128/50'">
  				    <u><?php echo $regionName?></u></font>
	   			  </td>
            <td width="20%" align=left vAlign=top noWrap class=regiontext><div align="left"><?php echo $locX/256?></div></td>
            <td width="20%" align=left vAlign=top noWrap class=regiontext><div align="left"><?php echo $locY/256?></div></td>
          </tr>
			    </tbody>
        </table>
        <?php } ?>
      </div>
    </td>
    <td class=gridbox_r></td></tr>
    <tr>
      <td class=gridbox_bl></td>
      <td class=gridbox_b></td>
      <td class=gridbox_br></td>
    </tr>
  </tbody>
</table>
</td>
</tr>
</tbody>
</table>
