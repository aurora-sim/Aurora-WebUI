<?
include("../languages/translator.php");

if($_GET[regio]==""){
$ORDERBY=" ORDER by regionName ASC";
}else if($_GET[regio]=="name"){
$ORDERBY=" ORDER by regionName ASC";
}else if($_GET[regio]=="x"){
$ORDERBY=" ORDER by locX ASC";
}else if($_GET[regio]=="y"){
$ORDERBY=" ORDER by locY ASC";
}
?>
<TABLE width="300" height="120" border=0 cellPadding=0 cellSpacing=0>
  <TBODY>
  <TR>
    <TD vAlign=top align=right>
      <TABLE width=100% height="100" border=0 cellPadding=0 cellSpacing=0>
        <TBODY>
        <TR>          
          <td class=gridbox_tl><img height=5 width=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_t><img height=5 width=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_tr><img height=5 width=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" alt=""></td>
        </TR>
        <TR>
          <TD class=gridbox_l></TD>
          <TD class=black_content>
	  
            <TABLE cellSpacing=0 cellPadding=1 width="300" border=0>
              <TBODY>
              <TR>
                <TD width="55%" align=left class=regiontoptext>
                  <a style="cursor:pointer" onclick="document.location.href='?regio=name'">
                  <strong><? echo $webui_regionbox; ?>:</strong></a>
                </TD>
                <TD width="20%" align=left class=regiontoptext>
                  <div align="left">
                    <a style="cursor:pointer" onclick="document.location.href='?regio=x'"><strong>X</strong></a>
                  </div>
                </TD>
                <TD width="20%" align=right class=regiontoptext>
                  <div align="left">
                    <a style="cursor:pointer" onclick="document.location.href='?regio=y'"><strong>Y</strong></a>
                  </div>
                </TD>
              </TR>
		     	</TBODY>
			</TABLE>
      
      <DIV id=GREX style="MARGIN: 1px 0px 0px">
        <IMG height=1 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" width=1>
      </DIV>
            
			<div style=" border:hidden; color:#ffffff; padding:0px; width:300px; height:160px; overflow:auto; ">
			<?
        $w=0;
			  $DbLink->query("SELECT regionName,locX,locY FROM ".C_REGIONS_TBL." $ORDERBY ");
			  while(list($regionName,$locX,$locY) = $DbLink->next_record()){
			  $w++;
			?>
			
			  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
          <TBODY>
          <TR <? if($w==2){$w=0; echo"class=even";}else{echo"class=odd";}?>>
            <TD width="55%" align=left vAlign=top noWrap class=regiontext>
				      <a style="cursor:pointer" onclick="document.location.href='secondlife://<?=$regionName?>/128/128/50'">
  				    <u><?=$regionName?></u></font>
	   			  </TD>
            <TD width="20%" align=left vAlign=top noWrap class=regiontext><div align="left"><?=$locX/256?></div></TD>
            <TD width="20%" align=left vAlign=top noWrap class=regiontext><div align="left"><?=$locY/256?></div></TD>
          </TR>
			    </TBODY>
        </TABLE>
        <? } ?>
      </div>
    </TD>
    <TD class=gridbox_r></TD></TR>
    <TR>
      <TD class=gridbox_bl></TD>
      <TD class=gridbox_b></TD>
      <TD class=gridbox_br></TD>
    </TR>
  </TBODY>
</TABLE>
</TD>
</TR>
</TBODY>
</TABLE>
