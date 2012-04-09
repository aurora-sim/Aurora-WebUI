<?php
use Aurora\Framework\QueryFilter;
$UUID = null;
$WERROR = $webui_invalid_code;
if(isset($_GET['code'])){
	$filter = new QueryFilter;
	$filter->andFilters['code'] = $_GET['code'];
	$filter->andFilters['info'] = 'confirm';

	list($UUID) = Globals::i()->DBLink->Query(array('UUID'), C_CODES_TBL, $filter);
	if(isset($UUID)){
		if(Configs::d()->Authenticated($UUID)){
			$WERROR= $webui_verified_account;
			Globals::i()->DBLink->Delete(C_CODES_TBL, $filter);
		}else{
			$WERROR = $webui_internal_error;
		}
	}
}
?>

<table width="100%" height="425" border="0" align="center">
	<tr>
		<td valign="top">
			<table width="50%" border="0" align="center">
				<tr>
					<td><p align="center" class="Stil1"><? echo $webui_activate_account ?></p></td>
				</tr>
			</table>
			<br />
			<table width="79%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
				<tr>
					<td valign="top">
						<br />
						<br />
<?php if(isset($WERROR)){ ?>
						<font color="FF0000"><?=$WERROR?></font>
						<br />
<?php } ?>
						<br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
