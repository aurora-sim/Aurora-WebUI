<?

if($_GET[code]){
$DbLink = new DB;

$DbLink->query("SELECT UUID FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
list($UUID) = $DbLink->next_record();
}

if($UUID){
$WERROR="Thank you, your account is now active and ready to use.";

$DbLink->query("SELECT passwordSalt FROM ".C_WIUSR_TBL." WHERE UUID='$UUID'");
list($passwordHash) = $DbLink->next_record();
	
$DbLink->query("UPDATE ".C_AUTH_TBL." SET passwordHash='$passwordHash' WHERE UUID='$UUID'");	
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET passwordHash='$passwordHash', passwordSalt='',active='1' WHERE UUID='$UUID'");	
$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");

}else{
$WERROR="This isnt a valid code or maybe the code was older than 24h";
}
?>

<table width="100%" height="425" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1">Activate Account</p></td>
                </tr>
              </table>
              <br />
              <table width="79%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
                <tr>
                <td valign="top"><br>
                  <br>
                  <? if($WERROR){?>
				  <font color="FF0000"><?=$WERROR?></font><br>
				  <? } ?>
                  <br>
                </tr>
              </table></td>
            </tr>
        </table>
