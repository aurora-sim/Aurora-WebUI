<style type="text/css">
<!--
#scr {
  position:absolute;
  height:100%;
  width:100%;
  margin:0;
  padding:0;
  overflow:auto;
}
-->
</style>
<?
$DbLink = new DB;
if($_GET[id]){
$DbLink->query("SELECT content FROM ".C_PAGE_TBL." WHERE id='$_GET[id]'");
}else{
if($ERROER){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=smodul&id=1&btn=1&ERROR=$ERROER';
// -->
</script>";
}else{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=smodul&id=1&btn=1';
// -->
</script>";
}
}
 
 
list($content) = $DbLink->next_record();
?>
 
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">   
	<div style="height:100%;">
    <?=$content?>    
	</div>
	</td>
  </tr>
</table>
