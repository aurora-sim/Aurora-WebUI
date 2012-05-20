<table cellSpacing=0 cellPadding=0 width="100%" border=0 valign="top">
  <tbody>
      <tr>
          <td class=gridbox_tl><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_t><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt=""></td>
          <td class=gridbox_tr><img height=5 width=5 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" alt=""></td>
      </tr>
      
      <tr>
          <td class=gridbox_l></td>
          
          <td class=black_content vAlign=top align=left>
              <strong><?php echo SYSNAME ?>: <? echo $webui_news; ?></strong>
              <div id=GREX style="MARGIN: 5px 0px 0px">
                  <img height=1 src="<?php echo SYSURL; ?>loginscreen/images/icons/spacer.gif" width=1>
              </div>
              
              <table class=newslist cellSpacing=0 cellPadding=0>
                  <tbody>
<?php
	use Aurora\Addon\WebAPI\Configs;
	//NEWS SYSTEM
	
	$news = Configs::d()->NewsFromGroupNotices(0, 4);
	for($w = 0; $w < 4; $w++)
	{
		if($news->valid())
		{
			$item = $news->current();
			$ID = $item->NoticeID();
			$NEWS = $item->Subject();
			$TIME = $item->Timestamp();
?>
                  <tr <? if(($w % 2)){echo"class=even";}else{echo"class=odd";}?>>
                      <td class=boxtext vAlign=top>
                          <a href="<?php echo SYSURL; ?>index.php?page=news&scr=<?=$ID?>" target="_blank"><?php echo $NEWS ?></a>
                      </td>
                      
                      <td class=boxtext vAlign=top noWrap width="1%">
                          <?=date("D d M g:i A",$TIME)?>
                      </td>
                  </tr>
<?php
			$news->next();
		}else{
?>
                  <tr <? if(($w % 2)){echo"class=even";}else{echo"class=odd";}?>>
                      <td class=boxnotext vAlign=top>
                         <? echo $webui_no_news; ?>
                      </td>

                      <td class=boxnotext vAlign=top noWrap width="1%">
                          
                      </td>
                  </tr>
<?php
		}
	}
?>
                  </tbody>
              </table>
          </td>
          <td class=gridbox_r></td>
      </tr>
      
      <tr>
        <TD class=gridbox_bl></TD>
        <TD class=gridbox_b></TD>
        <TD class=gridbox_br></TD>
      </tr>
  </tbody>
</table>
