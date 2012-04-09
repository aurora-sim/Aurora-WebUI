<?php
use Aurora\Addon\WebUI\Configs;
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}
if(isset($_POST['userdata']) && $_POST['userdata'] == 'set'){
	Configs::d()->EditUser(
		$_POST['userid'],
		$_POST['name'],
		$_POST['email'],
		new Aurora\Addon\WebUI\RLInfo(
			$_POST['rlname'],
			$_POST['street'],
			$_POST['zip'],
			$_POST['city'],
			$_POST['country']
		),
		isset($_POST['status']) ? ($_POST['status'] == 1 ? 1 : -1) : null
	);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	header('Location: ' . SYSURL . 'index.php?page=adminedit&userid=' . $_POST['userid']);
	exit;
}

$profile = Configs::d()->GetProfile('',$_GET['userid']);

$profileTXT   = $profile->AboutText();
$profileImage = $profile->Image() === '00000000-0000-0000-0000-000000000000' ? SYSURL . 'app/agent/info.jpg' : Configs::d()->GridTexture($profile->Image());
$created      = $profile->Created();
$uuid         = $profile->PrincipalID();
$name         = $accName = $profile->Name();
$diff         = $_SERVER['REQUEST_TIME'] - $created;
$type         = $profile->CustomType();
$email        = $profile->Email();
$active       = $profile->UserLevel() >= 0;

$rlname = $street = $zip = $city = $country = '';
if($profile->RLInfo() !== null){
	$rlname       = $profile->RLInfo()->Name();
	$street       = $profile->RLInfo()->Address();
	$zip          = $profile->RLInfo()->Zip();
	$city         = $profile->RLInfo()->City();
	$country      = $profile->RLInfo()->Country();
}
$date         = date("D d M Y - g:i A", $created);

?>



<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_manage; ?></h5></div>   
	<div id="managepanel">
		<div id="info">
			<p><?php echo $webui_admin_edit_manage_info; ?></p>
		</div>
		<div id="annonce10">
			<form name="form1" method="post" action="index.php?page=adminedit">
				<input type="hidden" name="userdata" value="set" />
				<input type="hidden" name="userid" value="<?php echo $uuid ?>" />
				<table>
					<tr>
						<td class="odd" width="50%"><?php echo $webui_admin_edit_manage_userid; ?></td>
						<td class="odd"><?php echo $uuid ?></td>
					</tr>            
					<tr>
						<td class="even"><?php echo $webui_admin_edit_manage_avatar_name; ?></td> 
						<td class="even"><input style="width:99%" name="name" type="text" id="name" value="<?php echo $name?>"</td>
					</tr>
					<tr>
						<td class="even"><? echo $webui_admin_edit_manage_real_name; ?></td>
						<td class="even">
							<input style="width:99%" name="rlname" type="text" id="fname" value="<?php echo $rlname?>" />
						</td>
					</tr>
					<tr>
						<td class="even"><?php echo $webui_admin_edit_manage_real_street; ?></td>
						<td class="even"><input style="width:99%" name="street" type="text" id="street" value="<?php echo $street ?>" /></td>
					</tr>
					<tr>
						<td class="odd"><?php echo $webui_admin_edit_manage_real_zip; ?></td>
						<td class="odd"><input style="width:99%" name="zip" type="text" id="city" value="<?php echo $zip ?>" size="8" /></td>
					</tr>
					<tr>                            
						<td class="even"><?php echo $webui_admin_edit_manage_real_city; ?></td>
						<td class="even"><input style="width:99%" name="city" type="text" id="street2" value="<?php echo $city ?>" /></td>                    
					</tr>
					<tr>
						<td class="odd"><?php echo $webui_admin_edit_manage_real_country; ?></td>
						<td class="odd">
							<select style="width:100%" class="box" wide="25" name="country">
<?php foreach(Globals::i()->DBLink->Query(array('name'), C_COUNTRY_TBL, null, array('name'=>true)) as $COUNTRYDB){ ?>
	<option <?php if($country == $COUNTRYDB){ echo"selected";} ?> value="<?php echo $COUNTRYDB ?>"><?php echo $COUNTRYDB ?></option>
<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="even"><?php echo $webui_admin_edit_manage_real_email; ?></td>
						<td class="even"><input style="width:99%" name="email" type="text" id="email" value="<?php echo $email ?>" /></td>
					</tr>
					<tr>
						<td class="even"><?php echo $webui_admin_edit_manage_currentstatus; ?></td>
						<td class="even"><?php
	if($active==1){
		echo '<font COLOR="#00FF00">',$webui_admin_edit_manage_active,'</font>';
	}else{
		echo '<font COLOR="#FF0000">',$webui_admin_edit_manage_inactive, '</font>';
	}
?></td>
					</tr>
					<tr>
						<td class="odd"><?php echo $webui_admin_edit_manage_setstatus; ?></td>
						<td class="odd">
							<select name="status">
								<option value="1"<?php if($active==1){?> selected <?php }?>><?php echo $webui_admin_edit_manage_active; ?></option> 
								<option value="0"<?php if($active!=1){?> selected <?php }?>><?php echo $webui_admin_edit_manage_inactive; ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="odd">
							<div align="center">
								<input type="submit" name="Submit2" value="<?php echo $webui_admin_edit_manage_savechanges; ?>" />
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
