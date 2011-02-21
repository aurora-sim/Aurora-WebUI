<?php
$DbLink = new DB;
$DbLink->query("SELECT id,title,message,time from ".C_NEWS_TBL." ORDER BY time DESC LIMIT 6");
while(list($id, $title, $message, $TIME) = $DbLink->next_record()) {

if (strlen($title) > 92) {$title = substr($title, 0, 62);
$title .= "...";
}

if($_GET[scr] != "") { 
  echo "<script language='javascript'> window.location.href='index.php?page=gridstatus&btn=3#".$_GET[scr]."';</script>"; 
}
?>



<div id="content">

  <h2><?= SYSNAME ?>: <? echo $webui_news; ?> </h2>
  
  <div id="news">

	<!-- <div id="info"><p><? echo $webui_news_info ?></p></div> -->

  <table>
    <tr>
      <td width="33%"><? echo $webui_news; ?></td>
      <td width="33%"></td>
      <td width="34%">
          <a href="index.php?page=newshistory"><? echo $webui_history; ?></a>
      </td>
    </tr>
    <tr>
      <td width="20%"><? $TIMES=date("D d M g:i A",$TIME); echo" $TIMES"; ?></td>
      <td width="80%" colspan="2"><a name=<?=$id?>></a><?=$title?></td>
    </tr>
    <tr>
      <td width="100%" colspan="3"><?=$message?></td>
    </tr>
  </table>
  </div>
<? } ?>
</div>
