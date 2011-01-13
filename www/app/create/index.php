<?
include("../../settings/config.php");
include("../../settings/mysql.php");

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

if ($_GET[aktion] == "") {
    if ($_POST[action] == "") {
?>
        <style type="text/css">
            <!--
            .box {
                font-size: 12px;
                height: 20;
            }
            -->
        </style>
<?
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

            -->
        </SCRIPT>
        <SCRIPT>

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
        <FORM name=form ACTION="index.php?page=create" METHOD="POST">

            <title><?= SYSNAME ?> Create Account</title>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                    <td colspan="2" valign="top"><span class="styleTopTitle">
                    <?= SYSNAME ?>
                    Create Account</span></td>
        </tr>
        <tr>
            <td colspan="2" valign="top"><hr></td>
        </tr>
    </table>


    <table width="100%" height="410" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td valign="top">
                <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                    <? if ($_SESSION[ERROR]) {
                    ?>
                        <tr>
                            <td colspan="2" bgcolor="#E95249"><div align="center"><?= $_SESSION[ERROR] ?></div></td>
                        </tr>
                    <? } else {
                    ?>
                        <br>
                    <? } ?>
                    <td><span class="styleTopTitle">Step One: Account Information</span></td>

                    <tr>

                        <td width="176" bgcolor="#999999"><?= SYSNAME ?> First name*</td>
                        <td width="410" bgcolor="#CCCCCC"><input class="box" OnBlur="checkFirstName(this.value)" name="accountfirst" type="text" size="25" maxlength="15" value="<?= $_SESSION[ACCFIRST] ?>"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#999999"><?= SYSNAME ?> Last name*</td>
                        <td bgcolor="#CCCCCC">
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
                                <?
                                }
                                ?>
                            </select>
                            <? } else {
                            ?>
                                <input class="box" OnBlur="checkLastName(this.value)" name="accountlast" type="text" size="25" maxlength="15" value="<?= $_SESSION[ACCLAST] ?>" />

                            <? } ?>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#999999"><?= SYSNAME ?> Password*</td>
                        <td bgcolor="#CCCCCC"><input class="box" name="wordpass" type="password" size="25" maxlength="15"></td>
                    </tr>
                    <? if ($REGIOCHECK == "0") {
 ?>
                                <tr>
                                    <td bgcolor="#999999">Start Region* </td>
                                    <td bgcolor="#CCCCCC"><select class="box" wide="25" name="startregion">
                                <?
                                $DbLink->query("SELECT regionName,regionHandle FROM " . C_REGIONS_TBL . " ORDER BY regionName ASC ");
                                while (list($RegionName, $RegionHandle) = $DbLink->next_record()) {
                                ?>
                                    <option value="<?= $RegionHandle ?>"><?= $RegionName ?></option>
<? } ?>
                            </select></td>
                    </tr>
                    <?
                            }
                            if ($ADRESSCHECK == "1") {
                    ?>
                                <tr>
                                    <td bgcolor="#999999">First Name * </td>
                                    <td bgcolor="#CCCCCC"><input class="box" name="firstname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEF] ?>"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#999999">Last Name * </td>
                                    <td bgcolor="#CCCCCC"><input class="box" name="lastname" type="text" size="25" maxlength="15" value="<?= $_SESSION[NAMEL] ?>"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#999999">Address*</td>
                                    <td bgcolor="#CCCCCC"><input class="box" name="adress" type="text" size="50" maxlength="60" value="<?= $_SESSION[ADRESS] ?>"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#999999">Zip*</td>
                                    <td bgcolor="#CCCCCC"><input class="box" name="zip" type="text" size="25" maxlength="15" value="<?= $_SESSION[ZIP] ?>"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#999999">City*</td>
                                    <td bgcolor="#CCCCCC"><input class="box" name="city" type="text" size="25" maxlength="15" value="<?= $_SESSION[CITY] ?>"></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#999999">Country*</td>
                                    <td bgcolor="#CCCCCC"><select class="box" wide="25" name="country" value="<?= $_SESSION[COUNTRY] ?>">
                                <?
                                $DbLink->query("SELECT name FROM " . C_COUNTRY_TBL . " ORDER BY name ASC ");
                                while (list($COUNTRYDB) = $DbLink->next_record()) {
                                ?>
                                    <option>
<?= $COUNTRYDB ?>
                                </option>
                                <?
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td bgcolor="#999999">Date of Birth* </td>
                        <td bgcolor="#CCCCCC"><table cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td><select name='tag' <?
                                if ($status == 1 and $monat == '')
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
                                        <select name='monat' <?
                                                    if ($status == 1 and $monat == '')
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
                                        <select name='jahr' <?
                                                    if ($status == 1 and $jahr == '')
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
                                        </select>                      </td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td bgcolor="#999999">Email*</td>
                        <td bgcolor="#CCCCCC"><input class="box" name="email" type="text" size="40" maxlength="40" value="<?= $_SESSION[EMAIL] ?>"></td>
                    </tr>
                    <tr>
                        <td bgcolor="#999999">Confirm Email* </td>
                        <td bgcolor="#CCCCCC"><input class="box" name="emaic" type="text" size="40" maxlength="40" ></td>
                    </tr>

                </table>

    </table>

    <?
                                                }

                                                $DbLink = new DB;
                                                $DbLink->query("SELECT table_name FROM information_schema.tables WHERE table_schema = '" . C_DB_NAME . "' AND table_name = '" . C_WI_APPEARANCE_TBL . "';");
                                                list($found) = $DbLink->next_record();

                                                if ($found) {
    ?>
                                                    <table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                                                            <td>
                                                                <br>
                                                                <br>
                                                                <span class="styleTopTitle">Step Two: First Appearance</span></td>
            <?
                                                    $DbLink = new DB;
                                                    $DbLink->query("SELECT Enabled,Picture,ArchiveName FROM " . C_WI_APPEARANCE_TBL . "");
                                                    while (list($Enabled, $Picture, $ArchiveName) = $DbLink->next_record()) {
                                                        if ($Enabled == 'true') {
            ?>

                                                            <tr>
                                                            <tr>
                                                                <td width="45%" valign="top"><br>
                                                                    <br>
                                                                    <table border="0" align="center" cellpadding="5" cellspacing="0">
                                                                        <tr>
                                                                            <td bgcolor="#FFFFFF">
                                                                                <a onclick="showdate('<? echo $ArchiveName; ?>')"> <? echo $ArchiveName; ?></a>
                                                                            </td>
                                                                            <td bgcolor="#FFFFFF"><div align="center">
                                                                                    <img src="<? echo $Picture; ?>" onclick="showdate('<? echo $ArchiveName; ?>')" />
                                                                                </div></td>
                                                                        </tr>
                                                                    </table></td>
                                                            </tr>
            <? }
                                                    } ?>

                                                    <td bgcolor="#999999">First Appearance</td>
                                                    <td bgcolor="#CCCCCC"><input class="box" name="appearance" type="text" size="25" maxlength="15" value="<?= $_SESSION[APPEARANCE] ?>"></td>
                                                    </tr>
                                                </table>
                                                </tr>
                                            </table>
<? } ?>




                                                <table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                    <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">

                                                        <td bgcolor="#FFFFFF">&nbsp;</td>
                                                        <td bgcolor="#FFFFFF">
                                                            <span class="styleTopTitle">Step Three: Recaptcha</span>
                                                            <!-- Choice: red (default), white, blackglass, clean -->
                                                            <script type="text/javascript">var RecaptchaOptions = {theme : 'red'};</script>


                <?
                                                require_once('recaptchalib.php');
                                                $publickey = "6Lf_MQQAAAAAAIGLMWXfw2LWbJglGnvEdEA8fWqk"; // you got this from the signup page
                                                echo recaptcha_get_html($publickey);
                ?>
                                            </td>
                                        </table>
                                        </tr>
                                    </table>                                
                                    <table width="100%" height="10" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                        <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">

                                            <td bgcolor="#FFFFFF">&nbsp;</td>
                                            <td bgcolor="#FFFFFF">
                                                <div align="right" id ="down">

                                                    <INPUT type="hidden" name="action" value="check">
                                                    <INPUT name="submit" TYPE="submit" style="font-family:Verdana; font-size:11px; WIDTH:150; HEIGHT:19; BORDER: 1 solid #000000; COLOR: #000000; BACKGROUND-COLOR: cccccc" onFocus="this.style.backgroundColor='#CCCCCC'" onBlur="this.style.backgroundColor='#FFFFFF'" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseout="this.style.backgroundColor='#CCCCCC'" value='Create my Account'>
                                                </div></td>

                                        </table>
                                        </tr>
                                        <a name="bottom"></a> <!-- For jumping to the bottom of the page after you select an appearance -->
                                    </table>


                                </FORM>
















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

                                                if (($_SESSION[PASSWD] == '') or ($_SESSION[EMAIC] == '') or ($_SESSION[EMAIL] == '') or ($_SESSION[CITY] == '') or ($_SESSION[ZIP] == '') or ($_SESSION[ADRESS] == '') or ($_SESSION[NAMEL] == '') or ($_SESSION[NAMEF] == '') or ($_SESSION[ACCFIRST] == '') or ($_SESSION[ACCLAST] == '')) {

                                                    if ($_SESSION[EMAIC] == '') {
                                                        $_SESSION[ERROR] = "Please confirm your email";
                                                    }
                                                    if ($_SESSION[PASSWD] == '') {
                                                        $_SESSION[ERROR] = "Please enter your Password";
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
                                                } else {

                                                    $DbLink->query("SELECT FirstName FROM " . C_USERS_TBL . " WHERE FirstName ='$_SESSION[ACCFIRST]' and LastName ='$_SESSION[ACCLAST]'");
                                                    list($NAMECHECK1) = $DbLink->next_record();

                                                    $DbLink->query("SELECT FirstName FROM " . C_USERS_TBL . " WHERE FirstName ='$_SESSION[ACCFIRSTL]' and LastName='$_SESSION[ACCLAST]'");
                                                    list($NAMECHECK2) = $DbLink->next_record();

                                                    $DbLink->query("SELECT emailadress FROM " . C_WIUSR_TBL . " WHERE emailadress='$_SESSION[EMAIL]'");
                                                    list($EMAILCHECK) = $DbLink->next_record();

                                                    $DbLink->query("SELECT agentIP FROM " . C_USRBAN_TBL . " WHERE agentIP='$userIP'");
                                                    list($IPCHECK) = $DbLink->next_record();


                                                    if ($EMAILCHECK) {
                                                        $_SESSION[ERROR] = "This email address is already in use";
                                                        echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
                                                    } else if ($NAMECHECK1) {
                                                        $_SESSION[ERROR] = "This account name is already in use";
                                                        echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
                                                    } else if ($NAMECHECK2) {
                                                        $_SESSION[ERROR] = "This account name is already in use";
                                                        echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
                                                    } else if ($IPCHECK) {
                                                        $_SESSION[ERROR] = "This IP adress is banned";
                                                        echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
                                                    } else {

                                                        if ($_SESSION[EMAIL] == $_SESSION[EMAIC]) {

                                                            $_SESSION[ACTION] = "THX";
                                                            $_SESSION[ERROR] = "";

                                                            echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create&aktion=ok';
// -->
</script>";
                                                        } else {
                                                            $_SESSION[ERROR] = "Email confirmation not correct";
                                                            echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
                                                        }
                                                    }
                                                }
                                            }
                                        } else if ($_GET[aktion] == "ok") {

                                            if (($_SESSION[PASSWD] == '') or ($_SESSION[EMAIC] == '') or ($_SESSION[EMAIL] == '') or ($_SESSION[CITY] == '') or ($_SESSION[ZIP] == '') or ($_SESSION[ADRESS] == '') or ($_SESSION[NAMEL] == '') or ($_SESSION[NAMEF] == '') or ($_SESSION[ACCFIRST] == '')) {

                                            } else {
                                                if (($_SESSION[ERROR] == '') and ($_SESSION[ACTION] == 'THX')) {
                                                    $passneu = $_SESSION[PASSWD];
                                                    $passwordHash = md5(md5($passneu) . ":");

                                                    $DbLink->query("SELECT FirstName FROM " . C_USERS_TBL . " where FirstName ='$_SESSION[ACCFIRST]' and LastName ='$_SESSION[ACCLAST]' ");
                                                    list($USERCHECK) = $DbLink->next_record();

                                                    $DbLink->query("SELECT FirstName FROM " . C_USERS_TBL . " where FirstName ='$_SESSION[ACCFIRSL]' and LastName ='$_SESSION[ACCLAST]' ");
                                                    list($USERCHE2CK) = $DbLink->next_record();


                                                    if (($USERCHECK) or ($USERCHE2CK)) {
                                                        $_SESSION[ERROR] = "User already exists in Database";
                                                        echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
 -->
< /script>";
                                                    } else {

// CODE generator
                                                        function code_gen($cod="") {
// ######## CODE LENGTH ########
                                                            $cod_l = 10;
// ######## CODE LENGTH ########
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
                                                        $found[0] = json_encode(array('Method' => 'CreateAccount', 'WebPassword' => WIREDUX_PASSWORD,
                                                                    'First' => $_SESSION[ACCFIRST], 'Last' => $_SESSION[ACCLAST],
                                                                    'Email' => $_SESSION[EMAIL],
                                                                    'HomeRegion' => $_SESSION[REGIONID],
                                                                    'PasswordHash' => $passwordHash,
                                                                    'PasswordSalt' => $passwordSalt));
                                                        $do_post_request = do_post_request($found);
                                                        $recieved = json_decode($do_post_request);


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
                                                    }
                                                } else {

                                                    echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
 -->
< /script>";
                                                }
                                            }
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
                                                                <td bgcolor="#FFFFFF"><blockquote>
                                                                        <p><br>
                                                                            <br>
                                                                            Account successfully created; to login, you need to click on the link which was sent to your email address <br>
                                                                            <br>
<?= SYSNAME ?> First Name: <b><?= $_SESSION[ACCFIRST] ?></b>
                                            <br />
<?= SYSNAME ?> Last Name:  <b><?= $_SESSION[ACCLAST] ?></b>
                                            <br>
                                            E-mail:
<?= $_SESSION[EMAIL] ?>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </p>
                                    </blockquote></td>
                            </tr>
                        </table></td>
                </tr>
            </table>
<?
                                            session_unset();
                                            session_destroy();
                                        }
?>
