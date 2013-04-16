<?
if($_GET[code]){
$DbLink = new DB;

$DbLink->query("SELECT UUID, email FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET[code])."' and info='emailconfirm'");
list($UUID, $EMAIL) = $DbLink->next_record();
}

if($UUID)
{	
	$found = array();
	$found[0] = json_encode(array('Method' => 'SaveEmail', 'WebPassword' => md5(WEBUI_PASSWORD)
		, 'UUID' => cleanQuery($UUID)
		, 'Email' => cleanQuery($EMAIL)));
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);
	
	if ($recieved->{'Verified'} == 1) 
	{
		$WERROR="Thank you, your email address was changed";		
		$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET[code])."' and info='emailconfirm'");
	}
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
<table width="100%" border="0" align="center">
	<tr>
		<td valign="top"><table width="50%" border="0" align="center">
			<tr>
				<td><p align="center" class="Stil1">Activate New Email</p></td>
			</tr>
                        </table>
		</td>
	</tr>
	<tr>
		<td valign="top"><?=$WERROR?></td>
	</tr>
</table>