<?php
if(isset($_SESSION['ADMINID'])){

    $DbLink = new DB;

    if($_POST['Submitreg'] == $webui_admin_settings_save_bouton){
	    $DbLink->query("UPDATE " . C_ADM_TBL . " SET startregion='".cleanQuery($_POST['region'])."'");
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET adress='".cleanQuery($_POST['adressset'])."',region='".cleanQuery($_POST['regtyp'])."',startregion='".cleanQuery($_POST['region'])."'");
    }

    if($_POST['Submit2'] == $webui_admin_settings_save_bouton){
        if($_POST['lastname'] != ""){
            $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " Where name='".cleanQuery($_POST['lastname'])."'");
            list($checkname) = $DbLink->next_record();
            if (!$checkname) {
                $DbLink->query("INSERT INTO " . C_NAMES_TBL . " (name,active)VALUES('".cleanQuery($_POST['lastname'])."','1')");
            }
        }
    }

    if ($_POST['Submit3'] == $webui_admin_settings_save_bouton){
        $DbLink->query("UPDATE " . C_NAMES_TBL . " SET active='0' WHERE name='".cleanQuery($_POST['deactivelast'])."'");
    }

    if ($_POST['Submit4'] == $webui_admin_settings_save_bouton){
        $DbLink->query("UPDATE " . C_NAMES_TBL . " SET active='1' WHERE name='".cleanQuery($_POST['activatelast'])."'");
    }

    if ($_POST['Submit5'] == $webui_admin_settings_save_bouton){
        $DbLink->query("DELETE FROM " . C_NAMES_TBL . " WHERE name='".cleanQuery($_POST['delname'])."'");
    }

    if ($_POST['Submitnam2'] == $webui_admin_settings_activate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET lastnames='1'");
    }

    if ($_POST['Submitnam2'] == $webui_admin_settings_desactivate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET lastnames='0'");
    }

    if ($_POST['allowRegistrationSubmit'] == $webui_admin_settings_activate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET allowRegistrations='1'");
    }

    if ($_POST['allowRegistrationSubmit'] == $webui_admin_settings_desactivate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET allowRegistrations='0'");
    }

    if ($_POST['verifyusersSubmit'] == $webui_admin_settings_activate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET verifyUsers='1'");
    }

    if ($_POST['verifyusersSubmit'] == $webui_admin_settings_desactivate_bouton){
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET verifyUsers='0'");
    }

	if ($_POST['Submitage'] == "Activate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET ForceAge='1'");
    }

    if ($_POST['Submitage'] == "Deactivate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET ForceAge='0'");
    }

    $DbLink->query("SELECT lastnames,region,startregion,adress,allowRegistrations,verifyUsers,ForceAge FROM " . C_ADM_TBL . "");
    list($LASTNMS, $REGIOCHECK, $STARTREGION, $ADRESSCHECK, $ALLOWREGISTRATION, $VERIFYUSERS, $FORCEAGE) = $DbLink->next_record();
?>

<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_settings; ?></h5></div>
	<div id="adminsettings">
		<div id="info"><p><?php echo $webui_admin_settings_info; ?></p></div>
		<form id="form41" name="form41" method="post" action="index.php?page=adminsettings">
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
				</tr>
					<td class="odd" width="50%"><?php echo $webui_admin_settings_startregion; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="region">
<?php
	$DbLink->query("SELECT RegionName,RegionUUID FROM " . C_REGIONS_TBL . " where !(Flags & 512) && !(Flags & 1024) ORDER BY RegionName ASC ");

	while(list($RegionName, $RegionUUID) = $DbLink->next_record()){
		echo '<option value="', $RegionUUID, '" ', ($STARTREGION == $RegionUUID ? 'selected' : ''), '>', $RegionName, '</option>',"\n";
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
						<input type="submit" name="Submitreg" value="<?php echo $webui_admin_settings_save_bouton; ?>" />
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
					<td class="even"><input type="text" name="lastname" /> <input type="submit" name="Submit2" value="<?php echo $webui_admin_settings_save_bouton; ?>" /></td>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_settings_deslastname; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="deactivelast">
<?php
	$DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC ");
	while (list($NAMEDB) = $DbLink->next_record()) {
?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<input type="submit" name="Submit3" value="<?php echo $webui_admin_settings_save_bouton; ?>" />
					</td>
				</tr>
				<tr>
					<td class="even"><?php echo $webui_admin_settings_realastname; ?></td>
					<td class="even">
						<select class="box" wide="25" name="activatelast">
<?php
	$DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=0 ORDER BY name ASC ");
	while (list($NAMEDB) = $DbLink->next_record()){
?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<input type="submit" name="Submit4" value="<?php echo $webui_admin_settings_save_bouton; ?>" />
					</td>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_settings_delete; ?></td>
					<td class="odd">
						<select class="box" wide="25" name="delname">
<?php
	$DbLink->query("SELECT name FROM " . C_NAMES_TBL . " ORDER BY name ASC ");
	while (list($NAMEDB) = $DbLink->next_record()){
?>
							<option><?php echo $NAMEDB ?></option>
<?php } ?>
						</select>
						<input type="submit" name="Submit5" value="<?php echo $webui_admin_settings_save_bouton; ?>" />
					</td>
				</tr>
				<tr>
					<td class="even"><span class="Stil4">Restrict age to 18 or older</span></td>
					<td class="even"><input type="submit" name="Submitage" value="<?php echo ($FORCEAGE == 0) ? 'Activate' : 'Deactivate'; ?>" /></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<? } ?>
