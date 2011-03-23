<table cellSpacing=0 cellPadding=0 width="100%" border=0 valign="top">
  <tbody>
      <tr>
        <TD class=gridbox_tl><IMG height=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" width=5></TD>
        <TD class=gridbox_t><IMG height=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" width=5></TD>
        <TD class=gridbox_tr><IMG height=5 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" width=5></TD>
      </tr>
      
      <tr>
          <td class=gridbox_l></td>
          
          <td class=black_content vAlign=top align=left>
              <strong><?=SYSNAME?>: <? echo $webui_news; ?></strong>
              <div id=GREX style="MARGIN: 5px 0px 0px">
                  <img height=1 src="<?= SYSURL ?>loginscreen/images/icons/spacer.gif" width=1>
              </div>
              
              <table class=newslist cellSpacing=0 cellPadding=0>
                  <tbody>
                  <?
                    //NEWS SYSTEM
                    $DbLink->query("SELECT id,title,time FROM ".C_NEWS_TBL." order by time DESC LIMIT 4");
                    for($w = 0; $w < 4; $w++)
                    {
                        if(list($ID,$NEWS,$TIME) = $DbLink->next_record())
                        {
                    ?>
                  
                  <tr <? if(($w % 2)){echo"class=odd";}else{echo"class=even";}?>>
                      <td class=boxtext vAlign=top>
                          <a href="<?=SYSURL?>index.php?page=news&scr=<?=$ID?>" target="_blank"><?=$NEWS?></a>
                      </td>
                      
                      <td class=boxtext vAlign=top noWrap width="1%">
                          <?=date("D d M g:i A",$TIME)?>
                      </td>
                  </tr>
                  <? }
                  else
                  {
                      ?>

                  <tr <? if(($w % 2)){echo"class=odd";}else{echo"class=even";}?>>
                      <td class=boxtext vAlign=top>
                          <span style="color:<? if(($w % 2)){echo"#000000";}else{echo"#151515";}?>">no news</span>
                      </td>

                      <td class=boxtext vAlign=top noWrap width="1%">
                          
                      </td>
                  </tr>
                  <?
                  }
                  } ?>
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
