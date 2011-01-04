<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 valign="top">
  <TBODY>
  <TR>
    <TD class=gridbox_tl><IMG height=5 
      src="images/login_screens/spacer.gif" 
      width=5></TD>
    <TD class=gridbox_t><IMG height=5 
      src="images/login_screens/spacer.gif" 
      width=5></TD>
    <TD class=gridbox_tr><IMG height=5 
      src="images/login_screens/spacer.gif" 
      width=5></TD></TR>
  <TR>
    <TD class=gridbox_l></TD>
    <TD class=black_content vAlign=top align=left><STRONG><?=SYSNAME?> News:</STRONG> 
      <DIV id=GREX style="MARGIN: 5px 0px 0px"><IMG height=1 
      src="images/login_screens/spacer.gif" 
      width=1></DIV>
      <TABLE class=newslist cellSpacing=0 cellPadding=0>
        <TBODY>
		<?
		$w=0;
		//NEWS SYSTEM
		$DbLink->query("SELECT id,title,time FROM ".C_NEWS_TBL." order by time DESC LIMIT 4");
		while(list($ID,$NEWS,$TIME) = $DbLink->next_record()){
		$w++;
		?>
        <TR <? if($w==2){ $w=0; echo"bgColor=#000000";}else{echo"bgColor=#151515";}?>>
          <TD class=boxtext vAlign=top><a href="<?=SYSURL?>/index.php?page=gridstatus&scr=<?=$ID?>" target="_blank"><?=$NEWS?></a></TD>
          <TD class=boxtext vAlign=top noWrap width="1%">
		   <?
			$TIMES=date("D d M g:i A",$TIME);
		   ?>
		  </TD>
          <TD class=boxtext vAlign=top noWrap width="1%"><?=$TIMES?></TD>
        </TR>
		<? } ?></TBODY></TABLE></TD>
    <TD class=gridbox_r></TD></TR>
  <TR>
    <TD class=gridbox_bl></TD>
    <TD class=gridbox_b></TD>
    <TD class=gridbox_br></TD></TR></TBODY></TABLE>