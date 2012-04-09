<?php
use Aurora\Addon\WebUI\Configs;
use Aurora\Framework\RegionFlags;
require_once('recaptchalib.php');
$DbLink            = new DB;
$webuicid          = Configs::d()->WebUIClientImplementationData();
$adminsetting      = $webuicid['adminsetting'];
$ADRESSCHECK       = $adminsetting['adress'];
$REGIOCHECK        = $adminsetting['region'];
$ALLOWREGISTRATION = $adminsetting['allowRegistrations'];
$VERIFYUSERS       = $adminsetting['verifyUsers'];
$FORCEAGE          = $adminsetting['ForceAge'];

//GET IP ADRESS
$userIP = 'This user has no ip';
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else if(isset($_SERVER['REMOTE_ADDR'])){
	$userIP = $_SERVER['REMOTE_ADDR'];
}

if($ALLOWREGISTRATION == '1'){
	if ($_POST['action'] == ''){
		$_SESSION['PASSWD'] = '';
		$_SESSION['EMAIC']  = '';


	function printLastNames(){
		$DbLink = new DB;
		$webuicid     = Configs::d()->WebUIClientImplementationData();
		$adminsetting = $webuicid['adminsetting'];
		$LASTNAMESC   = $adminsetting['lastnames'];
		if ($LASTNAMESC == "1") {
			echo "<div class=\"roundedinput\"><select id=\"register_input\" wide=\"25\" name=\"accountlast\">";
			$DbLink->query("SELECT DISTINCT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC ");
			while (list($NAMEDB) = $DbLink->next_record()) {
				echo '<option value="', $NAMEDB, '">',$NAMEDB, '</option>',"\n";
			}
			echo "</select></div>";
		} else {
			echo "<div class=\"roundedinput\"><input minlength=\"3\" require=\"true\" label=\"accountlast_label\" id=\"register_input\" name=\"accountlast\" type=\"text\" size=\"25\" maxlength=\"15\" value=\"$_SESSION[ACCLAST]\" /></div>";
		}
	}

	function displayRegions(){
		echo "<div class=\"roundedinput\"><select require=\"true\" label=\"startregion_label\" id=\"register_input\" wide=\"25\" name=\"startregion\">";
		foreach(Configs::d()->GetRegions(RegionFlags::DefaultRegion | RegionFlags::RegionOnline) as $region) {
			$RegionHandle = $region->RegionID();
			$RegionName = $region->RegionName();
			echo "<option value=\"$RegionHandle\">$RegionName</option>";
		}
		echo "</select></div>";
	}

	function displayCountry(){
		$DbLink = new DB;
		echo "<div class=\"roundedinput\"><select require=\"true\" label=\"country_label\" id=\"register_input\" wide=\"25\" name=\"country\" value=\"$_SESSION[COUNTRY]\">";
		$DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC ");
		echo "<option></option>";
		while (list($COUNTRYDB) = $DbLink->next_record()) {
			echo "<option>$COUNTRYDB</option>";
		}
		echo "</select></div>";
	}

	function displayDOB(){
		echo
			'<div id="birthday" class="roundedinput"><table><tr><td>',
			'<select label="dob_label" id="birthday_input" require="true" name="tag" class="', (($status == 1 and $monat == '') ? 'red' : 'black'), '">',
				'<option></option>',"\n"
		;
		for ($i = 1; $i <= 31; $i++){
			echo '<option value="',$i, '" ', (($tag == $i) ? 'selected ' : ''),  '>', $i, '</option>',"\n";
		}
		echo
			'</select>',
			'<select label="dob_label" id="birthday_input" require="true" name="monat" class="', (($status == 1 and $monat == '') ? 'red' : 'black'), '">',
				'<option></option>',"\n"
		;
		for ($i = 1; $i <= 12; $i++){
			echo '<option value="',$i, '" ', (($monat == $i) ? 'selected ' : ''),  '>', $i, '</option>',"\n";
		}
		echo
			'</select>',
			'<select label="dob_label" id="birthday_input" require="true" name="jahr" class="', (($status == 1 and $jahr == '') ? 'red' : 'black'), '">',
				'<option></option>',"\n"
		;
		$jetzt = getdate();
		$jahr1 = $jetzt['year'];

		for ($i = 1920; $i <= $jahr1; $i++) {
			echo '<option value="',$i, '" ', (($jahr == $i) ? 'selected ' : ''),  '>', $i, '</option>',"\n";
		}
		echo '</select></td></tr></table></div>';
	}

	function displayDefaultAvatars(){
		$AvatarArchives = Configs::d()->GetAvatarArchives();
		if ($AvatarArchives->count() > 0){
			echo "<tr><td colspan=\"2\" valign=\"top\">";
			$checked = false;
			foreach($AvatarArchives as $avarch){
				echo
					'<div class="avatar_archive_screenshot"><label for="',$avarch->Name(),'" >', $avarch->Name(), '</label>',
					'<input type="radio" id="', $avarch->Name(), '" name="AvatarArchive" value="', $avarch->Name() , '"'
				;
				if ((isset($_SESSION['AVATARARCHIVE']) && $_SESSION["AVATARARCHIVE"] == $avarch->Name()) || (isset($_SESSION['AVATARARCHIVE']) === false && $checked === false)){
					echo "checked />";
					$checked = true;
				}
				echo ' /><label for="', $avarch->Name(), '" ><br><img src="', Configs::d()->GridTexture($avarch->Snapshot()), '" /></label></div>';
			}
			echo '</td></tr>',"\n";
		}
	}

?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_register; ?></h5></div>
	<div id="register">
		<div id="annonce10">
			<form ACTION="index.php?page=register" METHOD="POST" onsubmit="if (!validate(this)) return false;">
				<table>
					<tr><td class="error" colspan="2" align="center" id="error_message"><?php echo (isset($_SESSION['ERROR']) ? $_SESSION['ERROR'] : ''), (isset($_GET['ERROR']) ? $_GET['ERROR'] : ''); ?></td></tr>
					<tr>
						<td class="even" width="52%"><span id="accountfirst_label"><? echo $webui_avatar_first_name ?>*</span></td>
						<td class="even">
							<div class="roundedinput">
								<input minlength="3" id="register_input" require="true" label="accountfirst_label" name="accountfirst" type="text" size="25" maxlength="15" value="<?php echo $_SESSION['ACCFIRST'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="odd"><span id="accountlast_label"><?php echo $webui_avatar_last_name; ?>*</span></td>
						<td class="odd"><?php printLastNames()?></td>
					</tr>
					<tr>
						<td class="even"><span id="wordpass_label"><?php echo $webui_password ?>*</span></td>
						<td class="even">
							<div class="roundedinput">
								<input minlength="8" compare="wordpass2" require="true" label="wordpass_label" id="register_input" name="wordpass" type="password" size="25" maxlength="15">
							</div>
						</td>
					</tr>
					<tr>
						<td class="odd"><span id="wordpass2_label"><?php echo $webui_confirm ?> <?php echo $webui_password ?>*</span></td>
						<td class="odd">
							<div class="roundedinput">
								<input minlength="8" require="true" label="wordpass2_label" id="register_input" name="wordpass2" type="password" size="25" maxlength="15">
							</div>
						</td>
					</tr>

<?php if ($REGIOCHECK == "0") { ?>
					<tr>
						<td class="even"><span id="startregion_label"><?php echo $webui_start_region ?>*</span></td>
						<td class="even"><?php displayRegions();	?></td>
					</tr>

<?php } ?>
<?php if ($ADRESSCHECK == "1") { ?>
					<tr>
						<td class="odd"><span id="firstname_label"><?php echo $webui_first_name ?>*</span></td>
						<td class="odd">
							<div class="roundedinput">
								<input require="true" label="firstname_label" id="register_input" name="firstname" type="text" size="25" maxlength="15" value="<?php echo $_SESSION['NAMEF'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="even"><span id="lastname_label"><?php echo $webui_last_name ?>*</span></td>
						<td class="even">
							<div class="roundedinput">
								<input require="true" label="lastname_label" id="register_input" name="lastname" type="text" size="25" maxlength="15" value="<?php echo $_SESSION['NAMEL'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="odd"><span id="adress_label"><?php echo $webui_address ?>*</span></td>
						<td class="odd">
							<div class="roundedinput">
								<input require="true" label="adress_label" id="register_input" name="adress" type="text" size="50" maxlength="50" value="<?php echo $_SESSION['ADRESS'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="even"><span id="zip_label"><?php echo $webui_zip_code ?>*</span></td>
						<td class="even">
							<div class="roundedinput">
								<input require="true" label="zip_label" id="register_input" name="zip" type="text" size="25" maxlength="15" value="<?php echo $_SESSION['ZIP'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="odd"><span id="city_label"><?php echo $webui_city ?>*</span></td>
						<td class="odd">
							<div class="roundedinput">
								<input require="true" label="city_label" id="register_input" name="city" type="text" size="25" maxlength="15" value="<?php echo $_SESSION['CITY'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="even"><span id="country_label"><?php echo $webui_country ?>*</span></td>
						<td class="even"><?php displayCountry(); ?></td>
					</tr>
					<tr>
						<td class="odd"><span id="dob_label"><?php echo $webui_date_of_birth ?>*</span></td>
						<td class="odd"><?php displayDOB(); ?></td>
					</tr>

<?php } ?>
<?php if ($FORCEAGE == "1"){ ?>
					<tr>
						<td class="odd"><span id="dob_label"><?php echo $webui_date_of_birth ?>*</span></td>
						<td class="odd"><?php displayDOB(); ?></td>
					</tr>

<?php } ?>
					<tr>
						<td class="odd"><span id="email_label"><?php echo $webui_email ?>*</span></td>
						<td class="odd">
							<div class="roundedinput">
								<input compare="emaic" require="true" label="email_label" id="register_input" name="email" type="text" size="40" maxlength="40" value="<?php echo $_SESSION['EMAIL'] ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td class="even"><span id="emaic_label"><?php echo $webui_confirm ?> <?php echo $webui_email ?>*</span></td>
						<td class="even">
							<div class="roundedinput">
								<input require="true" label="emaic_label" id="register_input" name="emaic" type="text" size="40" maxlength="40" value="<?php echo $_SESSION['EMAIC'] ?>" >
							</div>
						</td>
					</tr>

<?php displayDefaultAvatars(); ?>
<?php if( file_exists( WEBUI_INSTALL_PATH . 'TOS.php')){ ?>
					<tr>
						<td class="even" colspan="2">
							<div style="width:100%;height:300px;overflow:auto;"><?php include(WEBUI_INSTALL_PATH . 'TOS.php'); ?></div>
						</td>
					</tr>
					<tr>
						<td colspan="2" valign="top" class="odd">
							<input label="agree_label" require="true" type="checkbox" name="Agree_with_TOS" id="agree" value="1" />
							<label for="agree"><span id="agree_label"><?php echo $site_terms_of_service_agree?></span></label>
						</td>
					</tr>
<?php } ?>
					<tr>
						<td class="even">
							<div class="center">
<?php
		echo "<script type=\"text/javascript\">var RecaptchaOptions = {theme : '".$template_captcha_color."'};</script>";
		echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
?>
							</div>
						</td>
						<td class="even">
							<div class="center">
								<input type="hidden" name="action" value="check" />
								<button id="register_bouton" name="submit" type="submit"><?php echo $webui_create_new_account ?></button>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php }else if($_POST['action'] == 'check'){
		$_SESSION['ACCFIRST']      = $_POST['accountfirst'];
		$_SESSION['ACCFIRSL']      = strtolower($_POST['accountfirst']);
		$_SESSION['ACCLAST']       = $_POST['accountlast'];
		$_SESSION['AVATARARCHIVE'] = $_POST['AvatarArchive'];

		if ($ADRESSCHECK == "1") {
			$_SESSION['NAMEF']     = $_POST['firstname'];
			$_SESSION['NAMEL']     = $_POST['lastname'];
			$_SESSION['ADRESS']    = $_POST['adress'];
			$_SESSION['ZIP']       = $_POST['zip'];
			$_SESSION['CITY']      = $_POST['city'];
			$_SESSION['COUNTRY']   = $_POST['country'];
		}else{
			$_SESSION['NAMEF']     = "none";
			$_SESSION['NAMEL']     = "none";
			$_SESSION['ADRESS']    = "none";
			$_SESSION['ZIP']       = "00000";
			$_SESSION['CITY']      = "none";
			$_SESSION['COUNTRY']   = "none";
		}

		if ($REGIOCHECK == "0") {
			$_SESSION['REGIONID']  = $_POST['startregion'];
		} else {
			$startRegions = Configs::d()->GetRegions(RegionFlags::DefaultRegion | RegionFlags::RegionOnline);
			if($startRegions->count() > 0){
				$_SESSION['REGIONID'] = $startRegions->current()->RegionID();
			}else{
				$_SESSION['ERROR'] = 'No startup regions were found, contact grid operator';
				header('Location: index.php?page=register');
				exit;
			}
		}

		$_SESSION['EMAIL']         = $_POST['email'];
		$_SESSION['EMAIC']         = $_POST['emaic'];
		$_SESSION['PASSWD']        = $_POST['wordpass'];
		$_SESSION['PASSWD2']       = $_POST['wordpass2'];

		$tag                       = $_POST['tag'];
		$monat                     = $_POST['monat'];
		$jahr                      = $_POST['jahr'];

		$tag2                      = date('d', $_SERVER['REQUEST_TIME']);
		$monat2                    = date('m', $_SERVER['REQUEST_TIME']);
		$jahr2                     = date('Y', $_SERVER['REQUEST_TIME']);

		$jahr2                     = $jahr2 - 18;
		$agecheck1                 = $tag + $monat + $jahr;
		$agecheck2                 = $tag2 + $monat2 + $jahr2;

		if ($FORCEAGE == "1" && $agecheck1 > $agecheck2){
			session_unset();
			session_destroy();
			$_SESSION = array();
			header("Location: Index.php?page=register&ERROR=Sorry, you must be 18 to sign up.");
			exit;
		}

		$resp = recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY,
			$_SERVER['REMOTE_ADDR'],
			$_POST['recaptcha_challenge_field'],
			$_POST['recaptcha_response_field']
		);

		if (!$resp->is_valid){
			$_SESSION['ERROR'] = "The reCAPTCHA wasn't entered correctly. Please try it again.";
			header('Location: index.php?page=register');
			exit;
		}else if(
			$_SESSION['PASSWD']   != $_SESSION['PASSWD2'] ||
			$_SESSION['PASSWD']   == '' ||
			$_SESSION['PASSWD2']  == '' ||
			$_SESSION['EMAIC']    == '' ||
			$_SESSION['EMAIL']    == '' ||
			$_SESSION['CITY']     == '' ||
			$_SESSION['ZIP']      == '' ||
			$_SESSION['ADRESS']   == '' ||
			$_SESSION['NAMEL']    == '' ||
			$_SESSION['NAMEF']    == '' ||
			$_SESSION['ACCFIRST'] == '' ||
			$_SESSION['ACCLAST']  == ''
		){
			if($_SESSION['EMAIC'] == '') {
				$_SESSION['ERROR'] = 'Please confirm your email';
			}
			if($_SESSION['PASSWD'] != $_SESSION['PASSWD2']) {
				$_SESSION['ERROR'] = 'Passwords do not match.';
			}
			if($_SESSION['PASSWD'] == '') {
				$_SESSION['ERROR'] = 'Please enter your Password';
			}
			if($_SESSION['PASSWD2'] == '') {
				$_SESSION['ERROR'] = 'Please enter your Password Confirm';
			}
			if($_SESSION['EMAIL'] == '') {
				$_SESSION['ERROR'] = 'Please enter your Email address';
			}
			if($_SESSION['CITY'] == '') {
				$_SESSION['ERROR'] = 'Please enter your City';
			}
			if($_SESSION['ZIP'] == '') {
				$_SESSION['ERROR'] = 'Please enter your ZIP';
			}
			if($_SESSION['ADRESS'] == '') {
				$_SESSION['ERROR'] = 'Please enter your address';
			}
			if($_SESSION['NAMEL'] == '') {
				$_SESSION['ERROR'] = 'Please enter your real last name';
			}
			if($_SESSION['NAMEF'] == '') {
				$_SESSION['ERROR'] = 'Please enter your real first name';
			}
			if($_SESSION['ACCFIRST'] == "") {
				$_SESSION['ERROR'] = "Please enter a first name for your account";
			}
			if($_SESSION['ACCLAST'] == "") {
				$_SESSION['ERROR'] = "Please enter a last name for your account";
			}

			header('Location: index.php?page=register');
			exit;
		}else if($_SESSION['EMAIL'] != $_SESSION['EMAIC']){
			$_SESSION['ERROR'] = "Email confirmation not correct";
			header('Location: index.php?page=register');
			exit;
		}else if(Configs::d()->CheckIfUserExists(
			$_SESSION['ACCFIRST'] . ' ' . $_SESSION['ACCLAST']
		)){
			$_SESSION['ERROR'] = "User already exists in Database";
			header('Location: index.php?page=register');
			exit;
		}else{
			// CODE generator
			function code_gen($cod="") {
				$cod_l = 10;
				$zeichen = "abcdefghijklmnopqrstuvwxyz0123456789";
				$array_b = str_split($zeichen, 1);

				for ($i = 0; $i < $cod_l; $i++) {
					$z = mt_rand(0, 35);
					$cod .= $array_b[$z];
				}
				return $cod;
			}

			$code = code_gen();

			$userLevel = ($VERIFYUSERS == 0) ? 0 : -1;

			try{
				$recieved = Configs::d()->CreateAccount(
					$_SESSION['ACCFIRST'] . ' ' . $_SESSION['ACCLAST'],
					$_SESSION['PASSWD'],
					$_SESSION['EMAIL'],
					$_SESSION['REGIONID'],
					$userLevel,
					isset($_POST['jahr'], $_POST['monat'], $_POST['tag']) ? $_POST['jahr'] . '-' . $_POST['monat'] . '-' . $_POST['tag'] : '1970-01-01',
					$_SESSION['NAMEF'],
					$_SESSION['NAMEL'],
					$_SESSION['ADRESS'],
					$_SESSION['CITY'],
					$_SESSION['ZIP'],
					$_SESSION['COUNTRY'],
					$userIP
				);
			}catch(Exception $e){
				$_SESSION['ERROR'] = 'Unknown error. Please try again later.';
				header('Location: index.php?page=register');
				exit;
			}

			list($userInfo, $activationCode) = $recieved;
			if(!($userInfo instanceof \Aurora\Addon\WebUI\GridUserInfo)){
				$_SESSION['ERROR'] = 'Unknown error. Please try again later.';
				header('Location: index.php?page=register');
				exit;
			}

			if($do_email_verification){
				$DbLink = new DB;
				//-----------------------------------MAIL--------------------------------------
				$date_arr = getdate();
				$date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
				$sendto = $_SESSION['EMAIL'];
				$subject = "Account Activation from " . SYSNAME;
				$body .= "Your account was successfully created at " . SYSNAME . ".\n";
				$body .= "Your first name: $_SESSION[ACCFIRST]\n";
				$body .= "Your last name:  $_SESSION[ACCLAST]\n";
				$body .= "Your password:  $_SESSION[PASSWD]\n\n";
				$body .= "In order to login, you need to confirm your email by clicking this link within $deletetime hours:";
				$body .= "\n";
				$body .= "" . SYSURL . "/index.php?page=activate&code=$code";
				$body .= "\n\n\n";
				$body .= "Thank you for using " . SYSNAME . "";
				$header = "From: " . SYSMAIL . "\r\n";
				$mail_status = @mail($sendto, $subject, $body, $header);

				//-----------------------------MAIL END --------------------------------------
				// insert code
				$UUIDC = $userInfo->PrincipalID();
				$DbLink->query("INSERT INTO " . C_CODES_TBL . " (code,UUID,info,email,time)VALUES('$code','$UUIDC','confirm','".cleanQuery($_SESSION['EMAIL'])."'," . $_SERVER['REQUEST_TIME'] . ")");
				// insert code end
			}
?>
<div id="content">
<h2><?php echo $webui_successfully; ?></h2>
  <div id="info">
  	<p><?php echo $webui_successfully_info; ?></p><br />
    <p><?php echo SYSNAME ?> <?php echo $webui_avatar_first_name ?>: <b><?php echo $_SESSION['ACCFIRST'] ?></b></p><br />
    <p><?php echo SYSNAME ?> <?php echo $webui_avatar_last_name ?>:  <b><?php echo $_SESSION['ACCLAST'] ?></b></p><br />
    <p><?php echo SYSNAME ?> <?php echo $webui_email ?>: <?php echo $_SESSION[EMAIL] ?></b></p><br />
	</div>
</div>

<?php
			session_unset();
			session_destroy();
		}
	}
}else{ ?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_register; ?></h5></div>
	<div id="alert">
		<p><?php echo $webui_registrations_disabled; ?></p>
	</div>
</div>

<?php } ?>
