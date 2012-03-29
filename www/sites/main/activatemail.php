<?php
$UUID   = null;
$WERROR = "This isnt a valid code or maybe the code was older than 24h";

if(isset($_GET['code'])){
	$DbLink = new DB;
	$DbLink->query("SELECT UUID, email FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET['code'])."' and info='emailconfirm'");
	list($UUID, $EMAIL) = $DbLink->next_record();
	if(isset($UUID, $EMAIL)){
		if (Configs::d()->SaveEmail( $UUID, $EMAIL)){
			$WERROR="Thank you, your email address was changed";
			$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET[code])."' and info='emailconfirm'");
		}
	}
}
?>

<table width="100%" border="0" align="center">
	<tr>
		<td valign="top">
			<table width="50%" border="0" align="center">
				<tr>
					<td><p align="center" class="Stil1" style="font-size:18px;font-weight:bold;">Activate New Email</p></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php echo $WERROR; ?></td>
	</tr>
</table>