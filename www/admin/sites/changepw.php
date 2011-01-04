<?
if($_SESSION[ADMINUID]){

$DbLink = new DB;
$DbLink->query("SELECT id,username,password FROM ".C_ADMIN_TBL." WHERE password='$_SESSION[ADMINUID]'");
list($adminid,$username,$adminpass) = $DbLink->next_record();

if($_POST[check]=="change"){
if($_POST[passnew]==$_POST[passvalid]){
$password = md5(md5($_POST[passnew]) . ":" );
$passwold = md5(md5($_POST[passold]) . ":" );

if($adminpass==$passwold){
$DbLink->query("UPDATE ".C_ADMIN_TBL." SET username='$_POST[usernamenew]',password='$password' WHERE id='$adminid'");

session_unset();
session_destroy();
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";

}else{
$ERROR="Password doesnt match with Password in Database";
}
}else{
$ERROR="Password validation doesnt match";
}



}

?>
<style type="text/css">
<!--
.Stil1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<table width="100%" height="100%" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1"> Change Admin Password</p>                  </td>
                </tr>
              </table>
              <br />
			  <form name="form1" method="post" action="index.php?page=changepw" /> 
              <table width="70%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
                <tr>
                  <td valign="top">
				  <? if($ERROR){ ?>
				  <table width="81%" border="0" align="center">
                    <tr>
                      <td bgcolor="#E95249"><div align="center"><?=$ERROR?></div></td>
                    </tr>
                  </table>
				  <? } ?>
                    <br>
                  <table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#999999">
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;&nbsp;New Username</td>
                      <td valign="top"><input type="text" name="usernamenew" value="<?=$username?>"></td>
                    </tr>
                    <tr>
                      <td width="48%">&nbsp;&nbsp;Old Password </td>
                      <td width="52%">
					  <input type="hidden" name="check" value="change" />
					  <input type="password" name="passold"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;&nbsp;New Password </td>
                      <td><input type="password" name="passnew"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;&nbsp;Validate New Password </td>
                      <td><input type="password" name="passvalid"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#999999">&nbsp;</td>
                      <td bgcolor="#999999"><input type="submit" name="Submit" value="Save"></td>
                    </tr>
                  </table>  
				  </form>                
                  <p align="left"><br />
                  <br />
                    </p>
                  </td></tr>
              </table></td>
            </tr>
</table>
<?
} else {
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}

?>