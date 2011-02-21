<div id="content">
<h2><?= SYSNAME ?>: <? echo $webui_news_history; ?></h2>
<div id="newshistory">
<!-- <div id="info"><p><? echo $webui_news_info ?></p></div> -->
<table>
  <tr>
    <td>
      <table>
        <tr>
          <td colspan="2">
            <div align="center">
              <strong><? echo $webui_news_history; ?></strong>
            </div>
          </td>
        </tr>
        <?
          $DbLink = new DB;
          $DbLink->query("SELECT id,title,message,time from ".C_NEWS_TBL." ORDER BY time DESC");
          $count=0;
        
          while(list($id, $title, $message, $time) = $DbLink->next_record()) {
            $count++;
            
            if (strlen($title) > 92) {
              $title = substr($title, 0, 64);
              $title .= "...";
            }
            $TIMES=date("D d M",$time);
        ?>
      
        <tr>
          <td width="100"><b><?=$TIMES?></b></td>
          <td><b><?=$title?></b></td>
        </tr>
      
        <tr>
          <td></td>
          <td><?=$message?></td>
        </tr>
      
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <? } $DbLink->clean_results(); $DbLink->close(); ?>
      </table>
    </td>
  </tr>
</table>
</div>
</div>
