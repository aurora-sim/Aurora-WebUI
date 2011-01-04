<?
if ($_SESSION[USERID] == "") {
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
} else {
$DbLink = new DB;

$DbLink->query("SELECT region FROM " . C_ADM_TBL . "");
list($REGIOCHECK) = $DbLink->next_record();

if (($REGIOCHECK == "0") or ($REGIOCHECK == "1")) {
$DbLink->query("SELECT HomeRegionID FROM " . C_GRIDUSER_TBL . " WHERE UserID='$_SESSION[USERID]'");
list($oldregionid) = $DbLink->next_record();

$DbLink->query("SELECT regionName FROM " . C_REGIONS_TBL . " WHERE uuid='$oldregionid'");
list($oldregionname) = $DbLink->next_record();

$DbLink->query("SELECT emailadress FROM " . C_WIUSR_TBL . " WHERE UUID='$_SESSION[USERID]'");
list($oldemail) = $DbLink->next_record();

$DbLink->query("SELECT username,lastname FROM " . C_WIUSR_TBL . " WHERE UUID='$_SESSION[USERID]'");
list($firstName, $lastName) = $DbLink->next_record();

if ($_POST[Submit1] == "Save") {
$startregion = $_POST[region];

$DbLink->query("SELECT uuid FROM " . C_REGIONS_TBL . " WHERE regionName='$startregion' ");
list($homeid) = $DbLink->next_record();

$DbLink->query("UPDATE " . C_GRIDUSER_TBL . " SET HomeRegionID ='$homeid' WHERE UserID='$_SESSION[USERID]' ");
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=change&btn=2';
// -->
</script>";
}
}

if ($_POST[Submit2] == "Save") {
if ($_POST[passnew] == $_POST[passvalid]) {
$password = md5(md5($_POST[passnew]) . ":");
$passwold = md5(md5($_POST[passold]) . ":");

$DbLink->query("SELECT passwordHash FROM " . C_AUTH_TBL . " WHERE UUID='$_SESSION[USERID]'");
list($pwss) = $DbLink->next_record();

if ($pwss == $passwold) {
$DbLink->query("UPDATE " . C_AUTH_TBL . " SET passwordHash='$password' WHERE UUID='$_SESSION[USERID]' ");
$DbLink->query("UPDATE " . C_WIUSR_TBL . " SET passwordHash='$password' WHERE UUID='$_SESSION[USERID]' ");

session_unset();
session_destroy();
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
} else {
$ERRORS = "<font color=white><b>Password doesnt match the password in the Database</b></font>";
}
} else {
$ERRORS = "<font color=white><b>Check new passwords validation Failed</b></font>";
}
}

if ($_POST[Submit3] == "Save") {
// Check if the new email address isn't empty
if ($_POST[emailnew] <> "") {
// First set the email in the Users table of Wiredux
$DbLink->query("UPDATE " . C_WIUSR_TBL . " SET emailadress='" . $_POST[emailnew] . "' WHERE UUID='$_SESSION[USERID]' ");

// CODE generator
function code_gen($cod="") {
// ######## CODE LENGTH ########
$cod_l = 10;
// ######## CODE LENGTH ########
$zeichen = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9";
$array_b = explode(",", $zeichen);
for ($i = 0;
$i < $cod_l;
$i++) {
srand((double) microtime() * 1000000);
$z = rand(0, 35);
$cod .= "" . $array_b[$z] . "";
}
return $cod;
}

$code = code_gen();
// CODE generator

$image = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 0, 0, 0, 0, 0, 0, 0, 0);
$UUID = $_SESSION[USERID];

$DbLink->query("INSERT INTO " . C_CODES_TBL . " (code,UUID,info,email,time)VALUES('$code','$UUID','confirm','$_POST[emailnew]'," . time() . ")");

//-----------------------------------MAIL--------------------------------------
$date_arr = getdate();
$date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
$sendto = $_POST[emailnew];
$subject = "Email change from " . SYSNAME;
$body = "In order to login, you need to confirm your email by clicking this link within 24 hours:";
$body .= "\n";
$body .= "" . SYSURL . "/index.php?page=activatemail&code=$code";
$body .= "\n\n\n";
$body .= "Thank you for using " . SYSNAME . "";
$header = 'From: OSGrid Webmaster <noreply@osgrid.org>' . "\r\n";
$mail_status = mail($sendto, $subject, $body, $header);
//-----------------------------MAIL END --------------------------------------
$ERRORS2 = "<font color=white><b>An email has been send to confirm the new email</b></font>";
} else {
$ERRORS2 = "<font color=white><b>Can't have an empty emailaddress</b></font>";
}
}

if ($_POST[Submit4] == "Save")
{
    $firstName = $_POST[nameFirstNew];
    $lastName = $_POST[nameLastNew]; //Save us from checking the db for it
        $DbLink->query("UPDATE " . C_USERS_TBL . " SET FirstName='$_POST[nameFirstNew]',LastName = '$_POST[nameLastNew]' WHERE PrincipalID='$_SESSION[USERID]' ");
        $DbLink->query("UPDATE " . C_WIUSR_TBL . " SET username='$_POST[nameFirstNew]',lastname = '$_POST[nameLastNew]' WHERE UUID='$_SESSION[USERID]' ");
}
?>
<style type="text/css">
    <!--
    .Stil1 {
        font-size: 18px;
        font-weight: bold;
    }
    .box {	font-size: 12px;
           height: 20;
    }
    -->
</style>
<table width="100%" height="425" border="0" align="center">
    <tr>
        <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                    <td><p align="center" class="Stil1">Change Account</p>                  </td>
                </tr>
            </table>
            <br>
            <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
<? if (($REGIOCHECK == "0") or ($REGIOCHECK == "1")) { ?>
                <tr>
                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change home region </strong></div></td>
                </tr>
                <form name="form1" method="post" action="index.php?page=change">
                    <tr>
                        <td valign="top" bgcolor="#FFFFFF">Old Region: </td>
                        <td valign="top" bgcolor="#FFFFFF"><?= $oldregionname ?></td>
                    </tr>
                    <tr>
                        <td width="47%" valign="top" bgcolor="#FFFFFF">Start Region:  </td>
                        <td width="53%" valign="top" bgcolor="#FFFFFF"><select class="box" wide="25" name="region">
                                <?
                                $DbLink->query("SELECT regionName FROM " . C_REGIONS_TBL . " ORDER BY regionName ASC ");
                                while (list($NAMERGN) = $DbLink->next_record()) {
                                ?>
                                <option>
                                <?= $NAMERGN ?>
                                </option>
                                <?
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#666666">&nbsp;</td>
                        <td valign="top" bgcolor="#FFFFFF">
                            <input type="submit" name="Submit1" value="Save">                  </td>
                    </tr>
                </form>
<? } ?>
                            </table>
                            <BR>
                            <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change Password </strong></div></td>
                                </tr>
<? if ($ERRORS) { ?>
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><?= $ERRORS ?></div></td>
                                </tr>
<? } ?>
                                <form name="form1" method="post" action="index.php?page=change">
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">Old password </td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passold"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">New password </td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passnew"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">Validate password </td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="password" name="passvalid"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#666666">&nbsp;</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="submit" name="Submit2" value="Save"></td>
                                    </tr>
                                </form>
                            </table>
                            <BR>
                            <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change Email </strong></div></td>
                                </tr>
<? if ($ERRORS2) { ?>
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><?= $ERRORS2 ?></div></td>
                                </tr>
<? } ?>
                                <form name="form1" method="post" action="index.php?page=change">
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">Old Email</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="text" size="40" value="<?= $oldemail ?>" name="emailold"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">New Email</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="text" size="40" name="emailnew"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#666666">&nbsp;</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="submit" name="Submit3" value="Save"></td>
                                    </tr>
                                </form>
                            </table>
                            <BR>
                            <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Change Name </strong></div></td>
                                </tr>
<? if ($ERRORS2) { ?>
                                <tr>
                                    <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><?= $ERRORS2 ?></div></td>
                                </tr>
<? } ?>
                                <form name="form1" method="post" action="index.php?page=change">
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">New First Name</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="text" size="40" name="nameFirstNew" value ="<? echo $firstName; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF">New Last Name</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="text" size="40" name="nameLastNew" value ="<? echo $lastName; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#666666">&nbsp;</td>
                                        <td valign="top" bgcolor="#FFFFFF"><input type="submit" name="Submit4" value="Save"></td>
                                    </tr>
                                </form>
                            </table>
                        </td>
                    </tr>
                </table>
<? } ?>