<?php
use Aurora\Addon\WebUI\Configs;
use Aurora\Framework\RegionFlags;
use Aurora\Framework\QueryFilter;
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}

#region Update

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$update = array();

	if(isset($_POST['region'], $_POST['adressset'], $_POST['regtyp'])){
		$update['startregion'] = $_POST['region'];
		$update['adress']      = $_POST['adressset'];
		$update['region']      = $_POST['regtyp'];
	}

	#region Names

	if(isset($_POST['lastname']) && trim($_POST['lastname']) != ''){
		$filter = new QueryFilter;
		$filter->andFilters['name'] = $_POST['lastname'];
		if(count(Globals::i()->DBLink->Query(array('name'), C_NAMES_TBL, $filter)) == 0) {
			Globals::i()->DBLink->Insert(C_NAMES_TBL, array(
				'name'   => $_POST['lastname'],
				'active' => 1
			));
		}
	}

	if(isset($_POST['deactivelast']) && trim($_POST['deactivelast']) != ''){
		$filter = new QueryFilter;
		$filter->andFilters['name'] = $_POST['deactivelast'];
		Globals::i()->DBLink->Update(C_NAMES_TBL, array(
			'active' => 0
		), $filter);
	}
	if(isset($_POST['activatelast']) && trim($_POST['activatelast']) != ''){
		$filter = new QueryFilter;
		$filter->andFilters['name'] = $_POST['activatelast'];
		Globals::i()->DBLink->Update(C_NAMES_TBL, array(
			'active' => 1
		), $filter);
	}
	if(isset($_POST['delname']) && trim($_POST['delname']) != ''){
		$filter = new QueryFilter;
		$filter->andFilters['name'] = $_POST['delname'];
		Globals::i()->DBLink->Delete(C_NAMES_TBL, $filter);
	}

	if(isset($_POST['Submitnam2'])){
		if ($_POST['Submitnam2'] == $webui_admin_settings_activate_bouton){
			$update['lastnames'] = 1;
		}else if ($_POST['Submitnam2'] == $webui_admin_settings_desactivate_bouton){
			$update['lastnames'] = 0;
		}
	}

	#endregion

	if(isset($_POST['allowRegistrationSubmit'])){
		if($_POST['allowRegistrationSubmit'] == $webui_admin_settings_activate_bouton){
			$update['allowRegistrations'] = 1;
		}else if($_POST['allowRegistrationSubmit'] == $webui_admin_settings_desactivate_bouton){
			$update['allowRegistrations'] = 0;
		}
	}

	if(isset($_POST['verifyusersSubmit'])){
		if($_POST['verifyusersSubmit'] == $webui_admin_settings_activate_bouton){
			$update['verifyUsers'] = 1;
		}else if($_POST['verifyusersSubmit'] == $webui_admin_settings_desactivate_bouton){
			$update['verifyUsers'] = 0;
		}
	}

	if(isset($_POST['Submitage'])){
		if ($_POST['Submitage'] == "Activate") {
			$update['ForceAge'] = 1;
		}else if($_POST['Submitage'] == "Deactivate") {
			$update['ForceAge'] = 1;
		}
	}

	if(count($update) > 0){
		Globals::i()->DBLink->Update(C_ADM_TBL, $update);
	}
}

#endregion

list($LASTNMS, $REGIOCHECK, $STARTREGION, $ADRESSCHECK, $ALLOWREGISTRATION, $VERIFYUSERS, $FORCEAGE) = Globals::i()->DBLink->Query(array(
	'lastnames',
	'region',
	'startregion',
	'adress',
	'allowRegistrations',
	'verifyUsers',
	'ForceAge'
), C_ADM_TBL);
?>

<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_settings; ?></h5></div>
	<div id="adminsettings">
		<div id="info"><p><?php echo $webui_admin_settings_info; ?></p></div>
		<form id="form41" name="form41" method="post" action="index.php?page=adminsettings" style="clear:both;">
			<table>
				<tr>
					<td class="even" width="50%"><?php echo $webui_admin_settings_changeable; ?></td>
					<td class="even">
						<select wide="25" name="regtyp">
<?php
echo
	'<option value="0" ' . ($REGIOCHECK == '0' ? 'selected' : '') . '>', $webui_admin_settings_create_select, '</option>',"\n",
	'<option value="1" ' . ($REGIOCHECK == '1' ? 'selected' : '') . '>', $webui_admin_settings_edit_select, '</option>',"\n",
	'<option value="2" ' . ($REGIOCHECK == '2' ? 'selected' : '') . '>', $webui_admin_settings_adminonly_select, '</option>',"\n"
;
?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="odd" width="50%"><?php echo $webui_admin_settings_startregion; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="region">
<?php
foreach(Configs::d()->GetRegions(RegionFlags::RegionOnline, RegionFlags::Hyperlink | RegionFlags::Hidden) as $Region){
	echo '<option value="', $Region->RegionID(), '" ', ($STARTREGION == $Region->RegionID() ? 'selected' : ''), '>', $Region->RegionName(), '</option>',"\n";
}
?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="even"><?php echo $webui_admin_settings_require; ?></td>
					<td class="even">
						<select class="box" wide="25" name="adressset" >
<?php
echo
	'<option value="0" ', ($ADRESSCHECK == '0' ? 'selected' : ''), '>', $webui_admin_settings_yes_select, '</option>', "\n",
	'<option value="1" ', ($ADRESSCHECK == '1' ? 'selected' : ''), '>', $webui_admin_settings_no_select, '</option>', "\n"
;
?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_settings_allow; ?></td>
					<td class="odd"><input type="submit" name="allowRegistrationSubmit" value="<?php echo ($ALLOWREGISTRATION == 0) ? $webui_admin_settings_activate_bouton : $webui_admin_settings_desactivate_bouton; ?>" /></td>
				</tr>
				<tr>
					<td class="even"><?php echo $webui_admin_settings_verify; ?></td>
					<td class="even"><input type="submit" name="verifyusersSubmit" value="<?php echo ($VERIFYUSERS == 0) ? $webui_admin_settings_activate_bouton : $webui_admin_settings_desactivate_bouton; ?>" /></td>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_settings_activate; ?></td>
					<td class="odd"><input type="submit" name="Submitnam2" value="<?php echo ($LASTNMS == 0) ? $webui_admin_settings_activate_bouton : $webui_admin_settings_desactivate_bouton; ?>" /></td>
				</tr>
				<tr>
					<td class="even"><?php echo $webui_admin_settings_addlastname; ?></td>
					<td class="even"><input type="text" name="lastname" /></td>
				</tr>
				<tr>
					<td class="even"><span class="Stil4">Restrict age to 18 or older</span></td>
					<td class="even"><input type="submit" name="Submitage" value="<?php echo ($FORCEAGE == 0) ? 'Activate' : 'Deactivate'; ?>" /></td>
				</tr>
				<tr>
					<td class="odd" colspan="2"><div align="center"><button type="submit"><?php echo $webui_admin_settings_save_bouton; ?></button></div></td>
				</tr>
			</table>
		</form>
		<form id="form41" name="form41" method="post" action="index.php?page=adminsettings">
			<table>
				<tr>
					<td class="odd" width="50%"><?php echo $webui_admin_settings_deslastname; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="deactivelast">
<?php
$filter = new QueryFilter;
$filter->andFilters['active'] = 1;
foreach(Globals::i()->DBLink->Query(array('name'), C_NAMES_TBL, $filter, array('name'=>true)) as $NAMEDB){
?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<button type="submit"><?php echo $webui_admin_settings_save_bouton; ?></button>
					</td>
				</tr>
			</table>
		</form>
		<form id="form41" name="form41" method="post" action="index.php?page=adminsettings">
			<table>
				<tr>
					<td class="even" width="50%"><?php echo $webui_admin_settings_realastname; ?></td>
					<td class="even">
						<select class="box" wide="25" name="activatelast">
<?php
$filter = new QueryFilter;
$filter->andFilters['active'] = 0;
foreach(Globals::i()->DBLink->Query(array('name'), C_NAMES_TBL, $filter, array('name'=>true)) as $NAMEDB){
?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<button type="submit"><?php echo $webui_admin_settings_save_bouton; ?></button>
					</td>
				</tr>
			</table>
		</form>
		<form id="form41" name="form41" method="post" action="index.php?page=adminsettings">
			<table>
				<tr>
					<td class="odd" width="50%"><?php echo $webui_admin_settings_delete; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="delname">
<?php foreach(Globals::i()->DBLink->Query(array('name'), C_NAMES_TBL, null, array('name'=>true)) as $NAMEDB){ ?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<button type="submit"><?php echo $webui_admin_settings_save_bouton; ?></button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
