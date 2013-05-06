<?
////////////////////////////////// ADMIN ///////////////////////////////////////
if ($_SESSION[ADMINID]) {} 
else {echo "<script language=\"javascript\">
<!-- window.location.href=\"index.php?page=home\"; // --></script>";}

$DbLink = new DB;

if ($_GET[delete] == 1) {
    $DbLink->query("DELETE from " . C_NEWS_TBL . " WHERE (id = '" . cleanQuery($_GET[id]) . "')");
}
////////////////////////////////// ADMIN END ///////////////////////////////////
?>


<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_admin_edit_loginscreen; ?></h5></div>
        
  <div class="clear"></div>

  <div id="loginscreen_manager">

  <div id="info">
    <p><? echo $webui_admin_loginscreen_info ?></p>
  </div>
            
            
  <div id="ContentNewsLeft"><strong><? echo $webui_admin_news_online ?> :</strong></div>
            
  <div id="ContentNewsRight">
    <a href="index.php?page=news_add"><? echo $webui_admin_create_news ?></a>
  </div>
            
  <div class="clear"></div>

  <div id="news_online">
    <table>
      <tr>
        <td><b><? echo $webui_admin_news_title ?></b></td>
        <td><b><? echo $webui_admin_news_date ?></b></td>
        <td colspan=2></td>
      </tr>

      <?
        $DbLink->query("SELECT id,title,time from " . C_NEWS_TBL . " ORDER BY time DESC");
        while (list($id, $title, $TIME) = $DbLink->next_record())
        {
          if (strlen($title) > 67)
          {
            $title = substr($title, 0, 32);
            $title .= "...";
          }
        ?>
        
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        
        <td><?= $title ?></td>
        <td><? $TIMES = date("l M d Y", $TIME); ?></td>
        <td><a href=index.php?page=news_edit&editid=<?= $id ?>><? echo $webui_admin_news_edit ?></a></td>
        <td><a href=index.php?page=adminloginscreen&delete=1&id=<?= $id ?>><? echo $webui_admin_news_delete ?></a></td>
        
        <tr><td colspan="4"><hr /></td></tr>
      <? } ?>

        </table>
        </div>
    </div>
</div>
