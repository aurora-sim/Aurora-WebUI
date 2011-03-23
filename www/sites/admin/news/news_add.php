<? ////////////////////////////////// ADMIN ///////////////////////////////////////


if($_SESSION[ADMINUID]){
		
} else {
echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
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
window.location.href=\"index.php?page=loginscreen\";
// -->
</script>";
}


////////////////////////////////// ADMIN END /////////////////////////////////// ?><body>
<TABLE CELLPADDING="2" CELLSPACING="0" WIDTH=95%>
	<TR><TD ALIGN="right" bgcolor="#0066FF">
		<div align="center"><B>Create News </B>        </div></TD>
	</TR></TABLE><BR>

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

<FORM name="update" method="post" action="index.php?page=news_add">
<INPUT type='hidden' name='insert' value='1'>
<INPUT type='hidden' name='id' value='<?=$id?>'>
<BR> 
<FONT COLOR=#666666>

<!-- ###################################################################### -->
<br />
<table width="90%" align="center" cellpadding="2" cellspacing="3" bgcolor="#4DA2E3">
  <tr>
    <td><font color="#FFFFFF"><b> Title:<br />
            <input name="title" value="<?=$title?>" style="width:100%" type="text" maxlength="45" />
    </b></font></td>
  </tr>
</table>
<!-- ###################################################################### -->
<CENTER>
<TABLE CELLSPACING=1 CELLPADDING=0 BGCOLOR=#7F9DB9 WIDTH=90% HEIGHT=200>
	<TR><TD BGCOLOR=#FFFFFF>
<TEXTAREA NAME=message STYLE='WIDTH:100%; HEIGHT:350; background-color:#F96F73'><?=$message?></TEXTAREA><BR>
<? INCLUDE("editor/message.php"); ?>
	</TD></TR>
</TABLE>
<!-- ######################################################################## -->
<br />
</CENTER>
<TABLE CELLPADDING=0 WIDTH=95%><TR><TD ALIGN=right>
	<INPUT TYPE="submit" VALUE="Create News" STYLE="BACKGROUND-COLOR: #336EB2; BORDER: 1 solid #FFFFFF; color: #FFFFFF; font-family: Verdana; font-size: 8pt; font-weight: bold; HEIGHT: 20">
</TD></TR></TABLE>



