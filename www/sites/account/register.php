<?php
$DbLink = new DB;
$DbLink->query("SELECT adress,region,allowRegistrations,verifyUsers,ForceAge FROM " . C_ADM_TBL . "");
list($ADRESSCHECK, $REGIOCHECK,$ALLOWREGISTRATION,$VERIFYUSERS,$FORCEAGE) = $DbLink->next_record();

//GET IP ADRESS
if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
    $userIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} elseif ($_SERVER["REMOTE_ADDR"]) {
    $userIP = $_SERVER["REMOTE_ADDR"];
} else {
    $userIP = "This user has no ip";
}

if($ALLOWREGISTRATION == '1')
{

if ($_POST[action] == "") {
    $_SESSION[PASSWD] = "";
    $_SESSION[EMAIC] = "";
	
	
function printLastNames()
{
	$DbLink = new DB;
	$DbLink->query("SELECT lastnames FROM " . C_ADM_TBL . "");
	list($LASTNAMESC) = $DbLink->next_record();
	if ($LASTNAMESC == "1") {
		echo "<div class=\"roundedinput\"><select id=\"register_input\" wide=\"25\" name=\"accountlast\">";
		$DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC ");
		while (list($NAMEDB) = $DbLink->next_record()) {
			echo "<option>$NAMEDB</option>";
		}
		echo "</select></div>";
	} else {
		echo "<div class=\"roundedinput\"><input minlength=\"3\" require=\"true\" label=\"accountlast_label\" id=\"register_input\" name=\"accountlast\" type=\"text\" size=\"25\" maxlength=\"15\" value=\"$_SESSION[ACCLAST]\" /></div>";
	}
}


function displayRegions()
{
	$DbLink = new DB;
	echo "<div class=\"roundedinput\"><select require=\"true\" label=\"startregion_label\" id=\"register_input\" wide=\"25\" name=\"startregion\">";
	$DbLink->query("SELECT RegionName,RegionUUID FROM " . C_REGIONS_TBL . " ORDER BY RegionName ASC ");
	while (list($RegionName, $RegionHandle) = $DbLink->next_record()) {
		echo "<option value=\"$RegionHandle\">$RegionName</option>";
	}
	echo "</select></div>";
}


function displayCountry()
{
	$DbLink = new DB;
	echo "<div class=\"roundedinput\"><select require=\"true\" label=\"country_label\" id=\"register_input\" wide=\"25\" name=\"country\" value=\"$_SESSION[COUNTRY]\">";
	$DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC ");
	echo "<option></option>";
	while (list($COUNTRYDB) = $DbLink->next_record()) {
		echo "<option>$COUNTRYDB</option>";
	}
	echo "</select></div>";
}


function displayDOB()
{	
	echo "<div id=\"birthday\" class=\"roundedinput\"><table><tr><td>";
	 
	if ($status == 1 and $monat == '')
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='tag' class='red'>"; 
	else
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='tag' class='black'>"; 
	echo "<option></option>";
	for ($i = 1; $i <= 31; $i++) 
	{
		echo("<OPTION VALUE=\"$i\" ");
		if ($tag == $i)
			echo("selected ");
		echo(">$i");
	}
	echo "</select>";

	if ($status == 1 and $monat == '')
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='monat' class='red'>"; 
	else
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='monat' class='black'>"; 
	echo "<option></option>";
	for ($i = 1; $i <= 12; $i++) 
	{
		echo("<OPTION VALUE=\"$i\" ");
		if ($monat == $i)
			echo("selected ");
		echo(">$i");
	}
	echo "</select>";
	if ($status == 1 and $jahr == '')
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='jahr' class='red'>"; 
	else
		echo "<select label=\"dob_label\" id=\"birthday_input\" require=\"true\" name='jahr' class='black'>"; 
	echo "<option></option>";
	$jetzt = getdate();
	$jahr1 = $jetzt["year"];

	for ($i = 1920; $i <= $jahr1; $i++) {
		echo("<OPTION VALUE=\"$i\" ");
		if ($jahr == $i)
			echo("selected ");
		echo(">$i");
	}
	echo "</select></td></tr></table></div>";
}


function displayDefaultAvatars()
{
	$found = array();
	$found[0] = json_encode(array('Method' => 'GetAvatarArchives', 'WebPassword' => md5(WIREDUX_PASSWORD)));
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);

	if ($recieved->{'Verified'} == "true")
	{
		$names = explode(",", $recieved->{'names'});
		$snapshot = explode(",", $recieved->{'snapshot'});
		$count = count($names);
		echo "<tr><td colspan=\"2\" valign=\"top\">";
		for ($i = 0; $i < $count; $i++)
		{
			echo "<div class=\"avatar_archive_screenshot\"><label for=\"$names[$i]\" >$names[$i]</label>";
			echo "<input type=\"radio\" id=\"$names[$i]\" name=\"AvatarArchive\" value=\"$names[$i]\"";
			if (($_SESSION["AVATARARCHIVE"] == $names[$i]) || (($i == 0) && ($_SESSION["AVATARARCHIVE"] == "")))
			{
				echo "checked />";
			}
			echo "<label for=\"$names[$i]\" ><br><img src=\"".WIREDUX_TEXTURE_SERVICE."/index.php?method=GridTexture&uuid=".$snapshot[$i]."\" /></div>";
		}
		echo "</td></tr>";
	}
}
	
?>
    <div id="content">
    
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_register; ?></h5></div>
      
    <div id="register">
        <form ACTION="index.php?page=register" METHOD="POST" onsubmit="if (!validate(this)) return false;">
            <table>
                <tr><td class="error" colspan="2" align="center" id="error_message"><?=$_SESSION[ERROR];?><?=$_GET[ERROR]?></td></tr>
                <tr>
                    <td class="even" width="52%"><span id="accountfirst_label"><? echo $webui_avatar_first_name ?>*</span></td>
                    <td class="even">
                        <div class="roundedinput">
                          <input minlength="3" id="register_input" require="true" label="accountfirst_label" name="accountfirst" type="text" size="25" maxlength="15" value="<?= $_SESSION[ACCFIRST] ?>">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="odd"><span id="accountlast_label"><? echo $webui_avatar_last_name; ?>*</span></td>
                    <td class="odd">
                      <?=printLastNames()?>
                    </td>
                </tr>

                <tr>
                    <td class="even"><span id="wordpass_label"><? echo $webui_password ?>*</span></td>
                    <td class="even">
                        <div class="roundedinput">
                          <input minlength="6" compare="wordpass2" require="true" label="wordpass_label" id="register_input" name="wordpass" type="password" size="25" maxlength="15">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="odd"><span id="wordpass2_label"><? echo $webui_confirm ?> <? echo $webui_password ?>*</span></td>
                    <td class="odd">
                      <div class="roundedinput">
                        <input minlength="6" require="true" label="wordpass2_label" id="register_input" name="wordpass2" type="password" size="25" maxlength="15">
                      </div>
                    </td>
                </tr>
                
                <? if ($REGIOCHECK == "0") { ?>
                
                <tr>
                    <td class="even"><span id="startregion_label"><? echo $webui_start_region ?>*</span></td>
                    <td class="even">
                        <? displayRegions();	?>
                    </td>
                </tr>
                
                <? } if ($ADRESSCHECK == "1") { ?>
				<tr>
					<td class="odd"><span id="firstname_label"><? echo $webui_first_name ?>*</span></td>
					<td class="odd">
						<div class="roundedinput">
              <input require="true" label="firstname_label" id="register_input" name="firstname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEF] ?>">
            </div>
					</td>
				</tr>

				<tr>
					<td class="even"><span id="lastname_label"><? echo $webui_last_name ?>*</span></td>
					<td class="even">
						<div class="roundedinput">
              <input require="true" label="lastname_label" id="register_input" name="lastname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEL] ?>">
            </div>
					</td>
				</tr>

				<tr>
					<td class="odd"><span id="adress_label"><? echo $webui_address ?>*</span></td>
					<td class="odd">
						<div class="roundedinput">
              <input require="true" label="adress_label" id="register_input" name="adress" type="text" size="50" maxlength="50" value="<?= $_SESSION[ADRESS] ?>">
            </div>
					</td>
				</tr>

				<tr>
					<td class="even"><span id="zip_label"><? echo $webui_zip_code ?>*</span></td>
					<td class="even">
						<div class="roundedinput">
              <input require="true" label="zip_label" id="register_input" name="zip" type="text" size="25" maxlength="15" value="<?= $_SESSION[ZIP] ?>">
            </div>
					</td>
				</tr>
				<tr>
					<td class="odd"><span id="city_label"><? echo $webui_city ?>*</span></td>
					<td class="odd">
						<div class="roundedinput">
              <input require="true" label="city_label" id="register_input" name="city" type="text" size="25" maxlength="15" value="<?= $_SESSION[CITY] ?>">
            </div>
					</td>
				</tr>
				<tr>
					<td class="even"><span id="country_label"><? echo $webui_country ?>*</span></td>
					<td class="even">
						<? displayCountry(); ?>
                    </td>
                </tr>
                <tr>
                    <td class="odd"><span id="dob_label"><? echo $webui_date_of_birth ?>*</span></td>
                    <td class="odd">
                        <? displayDOB(); ?>
                    </td>
                </tr>
                
                <? }else if ($FORCEAGE == "1"){ ?>
                
                <tr>
                    <td class="odd"><span id="dob_label"><? echo $webui_date_of_birth ?>*</span></td>
                    <td class="odd">
                        <? displayDOB(); ?>
                    </td>
                </tr>
                
                <? } ?>
                
				<tr>
					<td class="odd"><span id="email_label"><? echo $webui_email ?>*</span></td>
					<td class="odd">
          	<div class="roundedinput">
              <input compare="emaic" require="true" label="email_label" id="register_input" name="email" type="text" size="40" maxlength="40" value="<?= $_SESSION[EMAIL] ?>">
            </div>
          </td>
				</tr>
				<tr>
					<td class="even"><span id="emaic_label"><? echo $webui_confirm ?> <? echo $webui_email ?>*</span></td>
					<td class="even">
						<div class="roundedinput">
              <input require="true" label="emaic_label" id="register_input" name="emaic" type="text" size="40" maxlength="40" value="<?= $_SESSION[EMAIC] ?>" >
            </div>  
          </td>
				</tr>
				
        <? displayDefaultAvatars(); ?>
        <? if( file_exists( $_SERVER{'DOCUMENT_ROOT'} . "/TOS.txt"))  { ?>
				
        <tr>
					<td class="odd"><input label="agree_label" require="true" type="checkbox" name="Agree_with_TOS" id="agree" value="1" />
            <label for="agree"><span id="agree_label"><?=$site_terms_of_service_agree?></span></label>
          </td>
					<td class="odd">
            <div style="width:450px;height:300px;overflow:auto;">
              <pre><? include("tos.txt"); ?></pre>
            </div>
          </td>
        </tr>
        
        <? } ?>
				
        <tr>
          <td class="even">
            <div class="center">
              <? 
                echo "<script type=\"text/javascript\">var RecaptchaOptions = {theme : '".$template_captcha_color."'};</script>"; ?>
                <? require_once('recaptchalib.php');
                $publickey = "6Lf_MQQAAAAAAIGLMWXfw2LWbJglGnvEdEA8fWqk"; // you got this from the signup page
                echo recaptcha_get_html($publickey);
              ?>
            </div>
          </td>

          <td class="even">
            <div class="center">
              <input type="hidden" name="action" value="check">
              <button id="register_bouton" name="submit" type="submit"><? echo $webui_create_new_account ?></button>
              <!-- <input id="register_bouton" name="submit" TYPE="submit" value='<? //echo $webui_create_new_account ?>'> -->
            </div>
          </td>
        </tr>
      </table>
		</form>
	</div>
</div>
<? } else if ($_POST[action] == "check") 
{
	$_SESSION[ACCFIRST] = $_POST[accountfirst];
	$_SESSION[ACCFIRSL] = strtolower($_POST[accountfirst]);
	$_SESSION[ACCLAST] = $_POST[accountlast];
	$_SESSION[AVATARARCHIVE] = $_POST[AvatarArchive];

	if ($ADRESSCHECK == "1") {
		$_SESSION[NAMEF] = $_POST[firstname];
		$_SESSION[NAMEL] = $_POST[lastname];
		$_SESSION[ADRESS] = $_POST[adress];
		$_SESSION[ZIP] = $_POST[zip];
		$_SESSION[CITY] = $_POST[city];
		$_SESSION[COUNTRY] = $_POST[country];
	} else {
		$_SESSION[NAMEF] = "none";
		$_SESSION[NAMEL] = "none";
		$_SESSION[ADRESS] = "none";
		$_SESSION[ZIP] = "00000";
		$_SESSION[CITY] = "none";
		$_SESSION[COUNTRY] = "none";
	}

	if ($REGIOCHECK == "0") {
		$_SESSION[REGIONID] = $_POST[startregion];
	} else {
		$DbLink->query("SELECT startregion FROM " . C_ADM_TBL . "");
		list($adminregion) = $DbLink->next_record();
		$_SESSION[REGIONID] = $adminregion;
	}
	
	$_SESSION[EMAIL] = $_POST[email];
	$_SESSION[EMAIC] = $_POST[emaic];
	$_SESSION[PASSWD] = $_POST[wordpass];
	$_SESSION[PASSWD2] = $_POST[wordpass2];

	$tag = $_POST[tag];
	$monat = $_POST[monat];
	$jahr = $_POST[jahr];

	$tag2 = date("d", time());
	$monat2 = date("m", time());
	$jahr2 = date("Y", time());

	$jahr2 = $jahr2 - 18;
	$agecheck1 = $tag + $monat + $jahr;
	$agecheck2 = $tag2 + $monat2 + $jahr2;
	
	if ($FORCEAGE == "1")
	{
		if ($agecheck1 > $agecheck2)
		{
			session_unset();
			session_destroy();
			$_SESSION = array();
			header("Location: Index.php?page=register&ERROR=Sorry, you must be 18 to sign up.");
			exit();
		}
	}
	
	require_once('recaptchalib.php');
	$privatekey = "6Lf_MQQAAAAAAB2vCZraiD2lGDKCkWfULvhG4szK";
	$resp = recaptcha_check_answer($privatekey,
					$_SERVER["REMOTE_ADDR"],
					$_POST["recaptcha_challenge_field"],
					$_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
		$_SESSION[ERROR] = "The reCAPTCHA wasn't entered correctly. Please try it again.";
		echo "<script language='javascript'>
		   <!--
		   window.location.href='index.php?page=register';
		   -->
		   </script>";
	} else if (($_SESSION[PASSWD] != $_SESSION[PASSWD2]) or ($_SESSION[PASSWD] == '') or ($_SESSION[PASSWD2] == '') or ($_SESSION[EMAIC] == '') or ($_SESSION[EMAIL] == '') or ($_SESSION[CITY] == '') or ($_SESSION[ZIP] == '') or ($_SESSION[ADRESS] == '') or ($_SESSION[NAMEL] == '') or ($_SESSION[NAMEF] == '') or ($_SESSION[ACCFIRST] == '') or ($_SESSION[ACCLAST] == '')) {

		if ($_SESSION[EMAIC] == '') {
			$_SESSION[ERROR] = "Please confirm your email";
		}

		if ($_SESSION[PASSWD] != $_SESSION[PASSWD2]) {
			$_SESSION[ERROR] = "Passwords do not match.";
		}

		if ($_SESSION[PASSWD] == '') {
			$_SESSION[ERROR] = "Please enter your Password";
		}

		if ($_SESSION[PASSWD2] == '') {
			$_SESSION[ERROR] = "Please enter your Password Confirm";
		}

		if ($_SESSION[EMAIL] == '') {
			$_SESSION[ERROR] = "Please enter your Email address";
		}

		if ($_SESSION[CITY] == '') {
			$_SESSION[ERROR] = "Please enter your City";
		}

		if ($_SESSION[ZIP] == '') {
			$_SESSION[ERROR] = "Please enter your ZIP";
		}

		if ($_SESSION[ADRESS] == '') {
			$_SESSION[ERROR] = "Please enter your address";
		}

		if ($_SESSION[NAMEL] == '') {
			$_SESSION[ERROR] = "Please enter your real last name";
		}

		if ($_SESSION[NAMEF] == '') {
			$_SESSION[ERROR] = "Please enter your real first name";
		}

		if ($_SESSION[ACCFIRST] == "") {
			$_SESSION[ERROR] = "Please enter a first name for your account";
		}

		if ($_SESSION[ACCLAST] == "") {
			$_SESSION[ERROR] = "Please enter a last name for your account";
		}

		echo "<script language='javascript'>
		  <!--
				window.location.href='index.php?page=register';
				// -->
				</script>";
	} 
	else if ($_SESSION[EMAIL] != $_SESSION[EMAIC]) {
		$_SESSION[ERROR] = "Email confirmation not correct";
		echo "<script language='javascript'>

		 <!--
				 window.location.href='index.php?page=register';
			   // -->
			   </script>";
	} else {
		$passneu = $_SESSION[PASSWD];
		$passwordHash = md5(md5($passneu) . ":");

		$found = array();
		$found[0] = json_encode(array('Method' => 'CheckIfUserExists', 'WebPassword' => md5(WIREDUX_PASSWORD), 'Name' => cleanQuery($_SESSION[ACCFIRST].' '.$_SESSION[ACCLAST])));
		$do_post_requested = do_post_request($found);
		$recieved = json_decode($do_post_requested);

		// echo '<pre>';
		// var_dump($recieved);
		// var_dump($do_post_requested);
		// echo '</pre>';

		if ($recieved->{'Verified'} != "False") {
			$_SESSION[ERROR] = "User already exists in Database";
			echo "<script language='javascript'>
				<!--
				window.location.href='index.php?page=register';
				-->
				</script>";
		} else {

			// CODE generator
			function code_gen($cod="") {
				$cod_l = 10;
				$zeichen = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9";
				$array_b = explode(",", $zeichen);

				for ($i = 0; $i < $cod_l; $i++) {
					srand((double) microtime() * 1000000);
					$z = rand(0, 35);
					$cod .= "" . $array_b[$z] . "";
				}
				return $cod;
			}

			$code = code_gen();
			
			$userLevel = -1;
			if($VERIFYUSERS == 0)
				$userLevel = 0;

			$found = array();
			$found[0] = json_encode(array('Method' => 'CreateAccount', 'WebPassword' => md5(WIREDUX_PASSWORD),
						'Name' => cleanQuery($_SESSION[ACCFIRST].' '.$_SESSION[ACCLAST]),
						'Email' => cleanQuery($_SESSION[EMAIL]),
						'HomeRegion' => cleanQuery($_SESSION[REGIONID]),
						'PasswordHash' => cleanQuery($passneu),
						'PasswordSalt' => cleanQuery($passwordSalt),
						'AvatarArchive' => cleanQuery($_SESSION[AVATARARCHIVE]),
						'UserLevel' => cleanQuery($userLevel),
						'RLFisrtName' => cleanQuery($_SESSION[NAMEF]),
						'RLLastName' => cleanQuery($_SESSION[NAMEL]),
						'RLAdress' => cleanQuery($_SESSION[ADRESS]),
						'RLCity' => cleanQuery($_SESSION[CITY]),
						'RLZip' => cleanQuery($_SESSION[ZIP]),
						'RLCountry' => cleanQuery($_SESSION[COUNTRY]),
						'RLDOB' => cleanQuery($tag . "/" . $monat . "/" . $jahr),
						'RLIP' => cleanQuery($userIP)
						));
						
						
			$do_post_requested = do_post_request($found);
			$recieved = json_decode($do_post_requested);

			
			// echo '<pre>';
			// var_dump($recieved);
			// var_dump($do_post_requested);
			// echo '</pre>';

			if ($recieved->{'Verified'} == "true") {
				$DbLink = new DB;
				$DbLink->query("insert into ". C_USERS_RL_TBL . " (
				principal_id, 
				first_name, 
				last_name, 
				address, 
				city, 
				zip, 
				country, 
				dob, 
				ip_address
				) VALUES (
				'".cleanQuery($recieved->{'UUID'})."',
				'".cleanQuery($_SESSION[NAMEF])."',
				'".cleanQuery($_SESSION[NAMEL])."',
				'".cleanQuery($_SESSION[ADRESS])."',
				'".cleanQuery($_SESSION[CITY])."',
				'".cleanQuery($_SESSION[ZIP])."',
				'".cleanQuery($_SESSION[COUNTRY])."',
				'".$jahr."/".$tag."/".$monat."', 
				'$userIP');");
			
				//-----------------------------------MAIL--------------------------------------
				$date_arr = getdate();
				$date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
				$sendto = $_SESSION[EMAIL];
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
				$mail_status = mail($sendto, $subject, $body, $header);

				//-----------------------------MAIL END --------------------------------------
				// insert code
				$UUIDC = $recieved->{'UUID'};
				$DbLink->query("INSERT INTO " . C_CODES_TBL . " (code,UUID,info,email,time)VALUES('$code','$UUIDC','confirm','".cleanQuery($_SESSION[EMAIL])."'," . time() . ")");
				// insert code end
?>
<div id="content">
<h2><? echo $webui_successfully; ?></h2>
  <div id="info">
  	<p><? echo $webui_successfully_info; ?></p><br />
    <p><?= SYSNAME ?> <? echo $webui_avatar_first_name ?>: <b><?= $_SESSION[ACCFIRST] ?></b></p><br />
    <p><?= SYSNAME ?> <? echo $webui_avatar_last_name ?>:  <b><?= $_SESSION[ACCLAST] ?></b></p><br />
    <p><?= SYSNAME ?> <? echo $webui_email ?>: <?= $_SESSION[EMAIL] ?></b></p><br />
	</div>
</div>

<?
  session_unset();
	session_destroy();
	 }
   
   else {
    echo "<script language='javascript'>
		      <!--
		      window.alert('Unknown error. Please try again later.');
		      window.location.href='index.php?page=register';
		      -->
					< /script>";
			  }
      }
    }
  }
}

else { ?>

<div id="content">

<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
<div id="ContentHeaderCenter"></div>
<div id="ContentHeaderRight"><h5><? echo $webui_register; ?></h5></div> 

  <div id="alert">
    <p><? echo $webui_registrations_disabled; ?></p>
  </div>
</div>

<? } ?>
