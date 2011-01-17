<?php
$DbLink = new DB;
$DbLink->query("SELECT adress,region FROM " . C_ADM_TBL . "");
list($ADRESSCHECK, $REGIOCHECK) = $DbLink->next_record();

//GET IP ADRESS
if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
    $userIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} elseif ($_SERVER["REMOTE_ADDR"]) {
    $userIP = $_SERVER["REMOTE_ADDR"];
} else {
    $userIP = "This user has no ip";
}
//GET IP ADRESS END

if ($_POST[action] == "") {
    $_SESSION[PASSWD] = "";
    $_SESSION[EMAIC] = "";
?>
    <SCRIPT type="text/javascript">
        <!--

        function showdate(val)
        {
            window.location='#bottom'
            form.appearance.value = val;
        }

        function checkFirstName(fname)
        {
            if ((fname < 4) || (fname.length > 15))
            {
                alert("Your first name needs to be\nmore then 4 chars and less\nthen 15 chars")
                form.submit.disabled=true
            }
            else
            {
                form.submit.disabled=false
            }

        }

        function checkLastName(lname)
        {
            if ((lname < 4) || (lname.length > 15))
            {
                alert("Your last name needs to be\nmore then 4 chars and less\nthen 15 chars")
                form.submit.disabled=true
            }
            else
            {
                form.submit.disabled=false
            }
        }

    </SCRIPT>
    <div id="content"><h2><?= SYSNAME ?>: Register</h2>


        <div id="register">

            <form ACTION="index.php?page=create" METHOD="POST">

                <table>
<? if ($_SESSION[ERROR]) { ?>


                        <tr>
                            <td class="error" colspan="2"> <div align="center"><?= $_SESSION[ERROR] ?></div></td>
                </tr>

<? } else { ?><? } ?>


                <tr>
                    <td class="even" width="50%"><?= SYSNAME ?> First name*</td>

                    <td class="even" width="50%">
                        <input id="register_input" name="accountfirst" OnBlur="checkFirstName(this.value)" type="text" size="25" maxlength="15" value="<?= $_SESSION[ACCFIRST] ?>">
                    </td>
                </tr>

                <tr>
                    <td class="odd"><?= SYSNAME ?> Last name*</td>

                    <td class="odd">
<?
    $DbLink->query("SELECT lastnames FROM " . C_ADM_TBL . "");
    list($LASTNAMESC) = $DbLink->next_record();

    if ($LASTNAMESC == "1") {
 ?>
                        <select class="box" wide="25" name="accountlast">
                            <?
                            $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC ");
                            while (list($NAMEDB) = $DbLink->next_record()) {
                            ?>

                                <option>
                                <?= $NAMEDB ?>
                            </option>

                            <? } ?>
                        </select>

                        <? } else {
 ?>

                            <input id="register_input" name="accountlast" OnBlur="checkLastName(this.value)" type="text" size="25" maxlength="15" value="<?= $_SESSION[ACCLAST] ?>" />

<? } ?>
                    </td>
                </tr>


                <tr>
                    <td bgcolor="#999999"><?= SYSNAME ?> Password*</td>
                    <td bgcolor="#CCCCCC"><input class="box" name="wordpass" type="password" size="25" maxlength="15"></td>
                </tr>
                <tr>
                    <td bgcolor="#999999"><?= SYSNAME ?> Password Confirm*</td>
                    <td bgcolor="#CCCCCC"><input class="box" name="wordpass2" type="password" size="25" maxlength="15"></td>
                </tr>


<? if ($REGIOCHECK == "0") { ?>


                            <tr>
                                <td class="odd"> Start Region*</td>
                                <td class="odd">
                                    <select id="register_input" wide="25" name="startregion">
                            <?
                            $DbLink->query("SELECT RegionName,RegionUUID FROM " . C_REGIONS_TBL . " ORDER BY regionName ASC ");
                            while (list($RegionName, $RegionHandle) = $DbLink->next_record()) {
                            ?>

                                <option value="<?= $RegionHandle ?>"><?= $RegionName ?></option>
<? } ?>
                        </select>
                    </td>
                </tr>

<? } if ($ADRESSCHECK == "1") { ?>


                            <tr>
                                <td class="even"> First Name*</td>
                                <td class="even">
                                    <input id="register_input" name="firstname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEF] ?>">
                                </td>
                            </tr>
                            <tr>

                                <td bgcolor="#999999"> Last Name*</td>
                                <td bgcolor="#CCCCCC">
                                    <input id="register_input" name="lastname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEL] ?>">
                                </td>
                            </tr>


                            <tr>
                                <td bgcolor="#999999"> Address*</td>
                                <td bgcolor="#CCCCCC">
                                    <input id="register_input" name="adress" type="text" size="50" maxlength="60" value="<?= $_SESSION[ADRESS] ?>">
                                </td>
                            </tr>


                            <tr>
                                <td bgcolor="#999999"> Zip*</td>
                                <td bgcolor="#CCCCCC">
                                    <input id="register_input" name="zip" type="text" size="25" maxlength="15" value="<?= $_SESSION[ZIP] ?>">
                                </td>
                            </tr>


                            <tr>
                                <td bgcolor="#999999"> City*</td>
                                <td bgcolor="#CCCCCC">
                                    <input id="register_input" name="city" type="text" size="25" maxlength="15" value="<?= $_SESSION[CITY] ?>">
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#999999"> Country*</td>
                                <td bgcolor="#CCCCCC">
                                    <select class="box" wide="25" name="country" value="<?= $_SESSION[COUNTRY] ?>">
                            <?
                            $DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC ");
                            while (list($COUNTRYDB) = $DbLink->next_record()) {
                            ?>

                                <option>
<?= $COUNTRYDB ?>
                            </option>
<? } ?>
                        </select></td>
                </tr>


                <tr>
                    <td bgcolor="#999999"> Date of Birth*</td>
                    <td bgcolor="#CCCCCC">

                        <table cellspacing="0" cellpadding="0" border="0">
                            <tr>
                                <td>
                                    <select name='tag' <? if ($status == 1 and $monat == '')
                                echo "class='red'"; else
                                echo "class='black'"; ?>>
                                        <?
                                        for ($i = 1; $i <= 31; $i++) {
                                            echo("<OPTION VALUE=\"$i\" ");
                                            if ($tag == $i
                                                )echo("selected ");
                                            echo(">$i");
                                        }
                                        ?>
                                    </select>

                                    <select name='monat' <? if ($status == 1 and $monat == '')
                                            echo "class='red'"; else
                                            echo "class='black'"; ?>>
                                        <?
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo("<OPTION VALUE=\"$i\" ");
                                            if ($monat == $i
                                                )echo("selected ");
                                            echo(">$i");
                                        }
                                        ?>
                                    </select>

                                    <select name='jahr' <? if ($status == 1 and $jahr == '')
                                            echo "class='red'"; else
                                            echo "class='black'"; ?>>
<?
                                        $jetzt = getdate();
                                        $jahr1 = $jetzt["year"];
                                        for ($i = 1920; $i <= $jahr1; $i++) {
                                            echo("<OPTION VALUE=\"$i\" ");
                                            if ($jahr == $i
                                                )echo("selected ");
                                            echo(">$i");
                                        }
?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                <? } ?>


                                    <tr>
                                        <td class="even"> Email*</td>
                                        <td class="even">
                                            <input id="register_input" name="email" type="text" size="40" maxlength="40" value="<?= $_SESSION[EMAIL] ?>"></td>
                                    </tr>


                                    <tr>
                                        <td class="odd"> Confirm Email*</td>
                                        <td class="odd">
                                            <input id="register_input" name="emaic" type="text" size="40" maxlength="40" ></td>
                                    </tr>
<?
                                    // commented out because I didn't get this working yet
                                    // $DbLink = new DB;
                                    // $DbLink->query("SELECT table_name FROM information_schema.tables WHERE table_schema = '" . C_DB_NAME . "' AND table_name = '" . C_WI_APPEARANCE_TBL . "';");
                                    // list($found) = $DbLink->next_record();
                                    // if ($found) {
?>
                                                                          <!-- <table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
                                                                                  <tr>
                                                                                          <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                                                                                                  <tr>
                                                                                                          <td>
                    										<br>
                    										<br>
                                                                                                                  <span class="styleTopTitle">Step Two: First Appearance</span>
                    									</td>
                    								</tr> -->
                <?
                                    // $DbLink = new DB;
                                    // $DbLink->query("SELECT Enabled,Picture,ArchiveName FROM " . C_WI_APPEARANCE_TBL . "");
                                    // while (list($Enabled, $Picture, $ArchiveName) = $DbLink->next_record()) {
                                    // if ($Enabled == 'true') {
                ?>

                                                                                                            <!--<tr>
                                                                                                                    <td width="45%" valign="top">
                    													<br>
                    													<br>
                                                                                                                            <table border="0" align="center" cellpadding="5" cellspacing="0">
                                                                                                                                    <tr>
                                                                                                                                            <td bgcolor="#FFFFFF">
                    																<a onclick="showdate('<? echo $ArchiveName; ?>')"> <? echo $ArchiveName; ?></a>
                    															</td>
                                                                                                                                            <td bgcolor="#FFFFFF">
                    																<div align="center">
                                                                                                                                                            <img src="<? echo $Picture; ?>" onclick="showdate('<? echo $ArchiveName; ?>')" />
                    																</div>
                    															</td>
                    														</tr>
                    													</table>
                    												</td>
                    											</tr> -->
<?
                                    // }
                                    // }
?>
                                                                                    <!-- <tr>
                                                        <td bgcolor="#999999">First Appearance</td>
                                                        <td bgcolor="#CCCCCC"><input class="box" name="appearance" type="text" size="25" maxlength="15" value="<?= $_SESSION[APPEARANCE] ?>"></td>
                                                    </tr>
                                                </table>
                                            </tr>
                                        </table> -->
                            <?
                                    // }
                            ?>

                        <tr>
                            <td class="even">
                                <center>
                                    <!-- Choice: red, white, blackglass, clean-->
                                    <script type="text/javascript">var RecaptchaOptions = {theme : 'blackglass'};</script>

<?
                                    require_once('recaptchalib.php');
                                    $publickey = "6Lf_MQQAAAAAAIGLMWXfw2LWbJglGnvEdEA8fWqk"; // you got this from the signup page
                                    echo recaptcha_get_html($publickey);
?></center>
                            </td>

                            <td class="even">
                                <center>
                                    <input type="hidden" name="action" value="check">
                                    <input id="register_bouton" name="submit" TYPE="submit" value='Create new Account'>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>

            </div></div>

<?
                                } else if ($_POST[action] == "check") {
                                    $_SESSION[ACCFIRST] = $_POST[accountfirst];
                                    $_SESSION[ACCFIRSL] = strtolower($_POST[accountfirst]);
                                    $_SESSION[ACCLAST] = $_POST[accountlast];
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

                                    $jahr = $jahr - 18;
                                    $jahr2 = $jahr2 - 18;
                                    $agecheck1 = $tag + $monat + $jahr;
                                    $agecheck2 = $tag2 + $monat2 + $jahr2;

                                    $DbLink->query("SELECT agentIP FROM " . C_USRBAN_TBL . " WHERE agentIP='$userIP'");
                                    list($IPCHECK) = $DbLink->next_record();
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
                    window.location.href='index.php?page=create';
                    // -->
                    </script>";

                                        if ($IPCHECK) {
                                            $_SESSION[ERROR] = "This IP adress is banned";
                                            echo "<script language='javascript'>
			<!--
				window.location.href='index.php?page=create';
			// -->
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
				window.location.href='index.php?page=create';
			// -->
			</script>";
                                        } else if ($_SESSION[EMAIL] != $_SESSION[EMAIC]) {
                                            $_SESSION[ERROR] = "Email confirmation not correct";
                                            echo "<script language='javascript'>
			<!--
				window.location.href='index.php?page=create';
			// -->
			</script>";
                                        } else {
                                            $passneu = $_SESSION[PASSWD];
                                            $passwordHash = md5(md5($passneu) . ":");

                                            $found = array();
                                            $found[0] = json_encode(array('Method' => 'CheckIfUserExists', 'WebPassword' => md5(WIREDUX_PASSWORD),
                                                        'First' => $_SESSION[ACCFIRST]
                                                        , 'Last' => $_SESSION[ACCLAST]));
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
						window.location.href='index.php?page=create';
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

                                                $found = array();
                                                $found[0] = json_encode(array('Method' => 'CreateAccount', 'WebPassword' => md5(WIREDUX_PASSWORD),
                                                            'First' => $_SESSION[ACCFIRST], 'Last' => $_SESSION[ACCLAST],
                                                            'Email' => $_SESSION[EMAIL],
                                                            'HomeRegion' => $_SESSION[REGIONID],
                                                            'PasswordHash' => $passneu,
                                                            'PasswordSalt' => $passwordSalt));
                                                $do_post_requested = do_post_request($found);
                                                $recieved = json_decode($do_post_requested);

                                                // echo '<pre>';
                                                // var_dump($recieved);
                                                // var_dump($do_post_requested);
                                                // echo '</pre>';

                                                if ($recieved->{'Verified'} == "true") {
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
                                                    $header = 'From: OSGrid Webmaster <noreply@osgrid.org>' . "\r\n";
                                                    $mail_status = mail($sendto, $subject, $body, $header);
                                                    //-----------------------------MAIL END --------------------------------------
                                                    // insert code
                                                    $UUIDC = $recieved->{'UUID'};
                                                    $DbLink->query("INSERT INTO " . C_CODES_TBL . " (code,UUID,info,email,time)VALUES('$code','$UUIDC','confirm','$_SESSION[EMAIL]'," . time() . ")");
                                                    // insert code end
?>
                                                    <table width="100%" height="410" border="0">
                                                        <tr>
                                                            <td valign="top"><br>
                                                                <br>
                                                                <br>
                                                                <table width="50%" border="0" align="center" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
                                                                    <tr>
                                                                        <td bgcolor="#FFFFFF"><div align="center"><strong>Account successfully created </strong></div></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td bgcolor="#FFFFFF">
                                                                            <blockquote>
                                                                                <p>
                                                                                    <br>
                                                                                    <br>
                                                    													Account successfully created; to login, you need to click on the link which was sent to your email address <br>
                                                                                    <br>
<?= SYSNAME ?> First Name: <b><?= $_SESSION[ACCFIRST] ?></b>
                                                    <br>
<?= SYSNAME ?> Last Name:  <b><?= $_SESSION[ACCLAST] ?></b>
                                                    <br>
                    													E-mail:
<?= $_SESSION[EMAIL] ?>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                </p>
                                            </blockquote>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

<?
                                                    session_unset();
                                                    session_destroy();
                                                } else {
                                                    echo "<script language='javascript'>
					<!--
						window.alert('Unknown error. Please try again later.');
						window.location.href='index.php?page=create';
					 -->
					< /script>";
                                                }
                                            }
                                        }
                                    }
                                }
?>