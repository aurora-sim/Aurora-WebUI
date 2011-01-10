<? if($_GET[scr] != ""){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=gridstatus&btn=3#".$_GET[scr]."';
// -->
</script>";
} ?>

<div style="height:100%">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tbody>
    <tr>
      <td width="319"><div align="center" class="style2">
        <div align="right">News</div>
      </div></td>
      <td width="296"><div align="center" class="style2">
          <div align="right" class="Stil1"><a style="cursor:pointer" onclick="self.document.location.href='index.php?page=gridstatushistory'">History</a></div>
      </div></td>
    </tr>
  </tbody>
</table>
<?
$DbLink = new DB;
$DbLink->query("SELECT id,title,message,time from ".C_NEWS_TBL." ORDER BY time DESC LIMIT 6");
while(list($id, $title, $message, $TIME) = $DbLink->next_record())
	{

if (strlen($title) > 92) {
$title = substr($title, 0, 62);
$title .= "...";
} 



?>
<A name=<?=$id?>></A>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="5" bgcolor="#CCCCCC">
  <tr>
    <td><hr /><b>
	<?
	$TIMES=date("D d M g:i A",$TIME);
	echo" $TIMES";
	?> - <?=$title?></b><br><hr></td>
  </tr>
  <tr>
    <td><?=$message?><br><br>
</td>
  </tr>
</table>

<?
}
?>
</div>