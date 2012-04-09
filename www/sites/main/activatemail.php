<?php
use Aurora\Framework\QueryFilter;
$UUID   = null;
$WERROR = "This isnt a valid code or maybe the code was older than 24h";

if(isset($_GET['code'])){
	$filter = new QueryFilter;
	$filter->andFilters['code'] = $_GET['code'];
	$filter->andFilters['info'] = 'emailconfirm';

	list($UUID, $EMAIL) = Globals::i()->DBLink->Query(array(
		'UUID',
		'email'
	), C_CODES_TBL, $filter);
	if(isset($UUID, $EMAIL)){
		if (Configs::d()->SaveEmail( $UUID, $EMAIL)){
			$WERROR="Thank you, your email address was changed";
			Globals::i()->DBLink->Delete(C_CODES_TBL, $filter);
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