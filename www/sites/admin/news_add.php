<?
////////////////////////////////// ADMIN ///////////////////////////////////////
if($_SESSION[ADMINID]){
} else {
echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=hometest\";
// -->
</script>";
}

if($_POST[insert] == '1')
{
////////////////////////////////// ADMIN ///////////////////////////////////////
	//$date = date("Y-m-d H:i:s");
	$DbLink = new DB;
	$DbLink->query("INSERT INTO ".C_NEWS_TBL." SET title='".cleanQuery($_POST[title])."',message='".cleanQuery($_POST[message])."',  time=".time());
	$DbLink->close();

	echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=news\";
// -->
</script>";
}
////////////////////////////////// ADMIN END /////////////////////////////////// 
?>

<body>

<div id="content">
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_admin_create_news; ?></h5></div>

    <div id="createnews">
    <!-- <div id="info"><p><? echo $webui_admin_create_news_info ?></p></div> -->
        
    <?
    $DbLink = new DB;
    $DbLink->query("SELECT id,title,message from ".C_NEWS_TBL." WHERE id = '".cleanQuery($_GET[editid])."'");

	  if ($DbLink->num_rows() != 0)
	  {
		  list($id,$title,$message) = $DbLink->next_record(); 
	  }
	  
    $DbLink->clean_results();
    $DbLink->close();
    ?>

    <form name="update" method="post" action="index.php?page=news_add">
      <input type='hidden' name='insert' value='1'>
      <input type='hidden' name='id' value='<?=$id?>'>

      <!-- ###################################################################### -->

      <table>
        <tr>
          <td>
            <? echo $webui_admin_news_title; ?>:
          </td>
          <td>
            <input name="title" value="<?=$title?>" size="136" type="text" maxlength="255" />
          </td>
        </tr>
      </table>
    
      <!-- ###################################################################### -->

      <table>
        <tr>
          <td>
            <textarea NAME=message STYLE='WIDTH:100%; HEIGHT:350px'><?=$message?></textarea>
          </td>
        </tr>
      </table>

      <!-- ######################################################################## -->

      <div align="center">
        <input type="submit" name="Submit" value="<? echo $webui_admin_create_news; ?>" /> 
      </div>
    </form>
  </div>
</div>
