<table 	width="90%" height="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td bgcolor="#336EB2" valign="top"><table width="100%" cellpadding="2" cellspacing="0" border="0">
      <tr>
        <td colspan="2" bgcolor="#1F5BA1"><div align="center"><font color="#FFFFFF" class="style2"><b><font size="3">News History </font><br />
                      <br />
        </b></font></div></td>
        </tr>
      <?

$DbLink = new DB;
$DbLink->query("SELECT id,title,message,time from ".C_NEWS_TBL." ORDER BY time DESC");

$count=0;
while(list($id, $title, $message, $time) = $DbLink->next_record())
	{
$count++;

if (strlen($title) > 92) {
$title = substr($title, 0, 64);
$title .= "...";
} 

$TIMES=date("D d M",$time);
?>
      <tr>
        <td width="79"><b>
          <?=$TIMES?>
        </b></td>
        <td width="557"><b><font color="#CCCCCC">
          <?=$title?>
        </font></b> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><?=$message?></td>
      </tr>
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <?
	}
$DbLink->clean_results();
$DbLink->close();
?>
    </table></td>
  </tr>
</table>
