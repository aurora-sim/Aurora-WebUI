<?
if($_GET[code]){
$DbLink = new DB;

$DbLink->query("SELECT UUID, email FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
list($UUID, $EMAIL) = $DbLink->next_record();
}

if($UUID)
{
	$WERROR="Thank you, your email address was changed";
	$DbLink->query("UPDATE ".C_USERS_TBL." SET email='".$EMAIL."' WHERE UUID='".$UUID."' ");
	$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
}
else
{
	$WERROR="This isnt a valid code or maybe the code was older than 24h";
}
?>

<style type="text/css">
<!--
.Stil1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<table width="100%" height="425" border="0" align="center">
	<tr>
		<td valign="top"><table width="50%" border="0" align="center">
			<tr>
				<td><p align="center" class="Stil1">Activate New Email</p></td>
			</tr>
                        </table>
		</td>
	</tr>
</table>
<br />
<table width="79%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
	<tr>
		<td valign="top"><br>
			<br>
			<? if($WERROR){?>
			<font color="FF0000"><?=$WERROR?></font><br>
			<? } ?>
			<br>
		</td>
	</tr>
</table>
