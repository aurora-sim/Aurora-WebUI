<? include("languages/translator.php"); ?>

<table cellSpacing=0 cellPadding=0 width="100%" border=0 valign="top">
  <tbody>
      <tr>
          <td class=gridbox_tl>
              <img height=5 src="images/login_screens/spacer.gif" width=5>
          </td>
          
          <td class=gridbox_t>
              <img height=5 src="images/login_screens/spacer.gif" width=5>
          </td>
          
          <td class=gridbox_tr>
              <img height=5 src="images/login_screens/spacer.gif" width=5>
          </td>
      </tr>
      
      <tr>
          <td class=gridbox_l></td>
          
          <td class=black_content vAlign=top align=left>
              <strong><?=SYSNAME?>: <? echo $webui_news; ?></strong>
              <div id=GREX style="MARGIN: 5px 0px 0px">
                  <img height=1 src="images/login_screens/spacer.gif" width=1>
              </div>
              
              <table class=newslist cellSpacing=0 cellPadding=0>
                  <tbody>
                  <?
                    $w=0;
                    //NEWS SYSTEM
                    $DbLink->query("SELECT id,title,time FROM ".C_NEWS_TBL." order by time DESC LIMIT 4");
                    while(list($ID,$NEWS,$TIME) = $DbLink->next_record()){
                    $w++;
                  ?>
                  
                  <tr <? if($w==2){ $w=0; echo"bgColor=#000000";}else{echo"bgColor=#151515";}?>>
                      <td class=boxtext vAlign=top>
                          <a href="<?=SYSURL?>/index.php?page=gridstatus&scr=<?=$ID?>" target="_blank"><?=$NEWS?></a>
                      </td>
                      
                      <td class=boxtext vAlign=top noWrap width="1%">
                          <? $TIMES=date("D d M g:i A",$TIME); ?>
                      </td>
                      
                      <td class=boxtext vAlign=top noWrap width="1%">
                          <?=$TIMES?>
                      </td>
                  </tr>
                  <? } ?>
                  </tbody>
              </table>
          </td>
          <td class=gridbox_r></td>
      </tr>
      
      <tr>
          <td class=gridbox_bl></td>
          <td class=gridbox_b></td>
          <td class=gridbox_br></td>
      </tr>
  </tbody>
</table>
