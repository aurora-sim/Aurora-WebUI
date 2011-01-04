<?
if($_SESSION[ADMINUID] == $ADMINCHECK){
?>
<style type="text/css">
<!--
.Stil1 {font-size: 18px;font-weight: bold;}
.box {font-size: 12px;height: 20;}
.Stil4 {font-size: 14}
-->
</style>

<?
$DbLink = new DB;

if($_POST[Submit]=="Update"){
$DbLink->query("SELECT PrincipalID,FirstName,LastName,Email FROM ".C_USERS_TBL." ");
while(list($UUID,$username,$lastname,$email) = $DbLink->next_record()){

$DbLink2 = new DB;
$DbLink2->query("SELECT username FROM ".C_WIUSR_TBL." where UUID='$UUID'");
list($USRNM) = $DbLink2->next_record();

$DbLink3 = new DB;
$DbLink3->query("SELECT passwordHash, passwordSalt FROM ".C_AUTH_TBL." where UUID='$UUID'");
list($password, $passwordsalt) = $DbLink3->next_record();

if($USRNM){
}else{

$DbLink2->query("INSERT INTO ".C_WIUSR_TBL." (UUID,username,lastname,passwordHash,active, passwordSalt, realname1, realname2, adress1, zip1, city1, country1, emailadress, agentIP) VALUES ('$UUID','$username','$lastname','$password','1','$passwordsalt','','','','','','','$email','')");

$DbLink2->query("SELECT count(*) FROM ".C_USERS_TBL."");
list($CUSR) = $DbLink2->next_record();

$DbLink2->query("SELECT count(*) FROM ".C_WIUSR_TBL."");
list($CWIUSR) = $DbLink2->next_record();

if($CWIUSR==$CUSR){

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>"; 
}
}


}

}

?>
<table width="100%" height="100%" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1">Database update </p>                  </td>
                </tr>
              </table>

              <br />
              <br />
              <br />
              <table width="336" height="74" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td valign="top" bgcolor="#FFFFFF"><br />
                    <table width="255" height="31" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#999999">
                    <tr>
                      <td valign="top">If an update is needed, press the button..</td>
                    </tr>
                  </table>
                    <br />
                      <br />
                    <table width="177" height="32" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td bgcolor="#999999"><div align="center">
					  <br />
					  <? if($CUSR==CWIUSR){?>
					  <input type="submit" name="Submit" value="No update needed..." />
					   <? }else { ?>
                        <form id="form1" name="form1" method="post" action="index.php?page=updatedb">
                          <input type="submit" name="Submit" value="Update" />
                        </form>
						<? } ?>
                      </div></td>
                    </tr>
                  </table>
                  <br /></td>
                </tr>
              </table></td>
            </tr>
</table>
<?
}
?>