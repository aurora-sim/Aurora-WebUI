<?
if($_SESSION[ADMINUID] == $ADMINCHECK){

$DbLink = new DB;
if($_POST[userdata]=="set"){
$DbLink->query("SELECT PrincipalID FROM ".C_USERS_TBL." WHERE FirstName='$_POST[accfirst]' and LastName='$_POST[acclast]'");
list($CHECKUSER) = $DbLink->next_record();

$DbLink->query("UPDATE ".C_WIUSR_TBL." SET 
realname1 ='$_POST[fname]',
realname2 ='$_POST[lname]',
adress1 ='$_POST[street]',
zip1 ='$_POST[zip]',
city1 ='$_POST[city]',
country1 ='$_POST[country]',
emailadress ='$_POST[email]'
WHERE UUID='$_POST[uuid]'");

if($CHECKUSER == ''){

$DbLink->query("UPDATE ".C_USERS_TBL." SET 
FirstName ='$_POST[accfirst]',
LastName ='$_POST[acclast]'
WHERE PrincipalID='$_POST[uuid]'");
}

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=edit&userid=".$_POST[uuid]."';
// -->
</script>";
}

if($_POST[state]=="set"){
$DbLink->query("SELECT PrincipalID,FirstName,LastName,Created FROM ".C_USERS_TBL." WHERE PrincipalID='$_POST[uuid]'");
list($uuid,$username,$lastname,$created) = $DbLink->next_record();

if($_POST[active] !=3){
if($_POST[status]==0){
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET active='$_POST[status]' WHERE UUID='$_POST[uuid]'");
}else{
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET active='$_POST[status]' WHERE UUID='$_POST[uuid]'");
}
}else{
if($_POST[status]==1){
$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE UUID='$_POST[uuid]'"); 
}
}

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=edit&userid=".$_POST[uuid]."';
// -->
</script>";
 
}

$DbLink->query("SELECT PrincipalID,FirstName,LastName FROM ".C_USERS_TBL." WHERE PrincipalID='$_GET[userid]'");
list($uuid,$accfirst,$acclast) = $DbLink->next_record();

$DbLink->query("SELECT realname1,realname2,adress1,zip1,city1,country1,emailadress FROM ".C_WIUSR_TBL." WHERE UUID='$_GET[userid]'");
list($firstnm,$lastnm,$street,$zip,$city,$country,$email) = $DbLink->next_record();

$DbLink->query("SELECT a.active,(SELECT info FROM ".C_CODES_TBL." b WHERE b.uuid = a.uuid ) as confirm FROM ".C_WIUSR_TBL." a where UUID='$_GET[userid]'");
list($active,$confirm) = $DbLink->next_record(); 

if($confirm == 'confirm'){
$active=3;
} 
?>
<style type="text/css">
<!--
.Stil3 {font-size: 16px; font-weight: bold; }
.Stil4 {font-size: 16px}
.style1 {
	font-size: 2px;
	color: #FFFFFF;
}
.style2 {
	color: #666666;
	font-weight: bold;
}
.box {	font-size: 12px;
	height: 20;	
}
-->
</style>

<table>
  <tr>
    <td><div align="center" class="Stil3"></div></td>
  </tr>
  <tr>
    <td>
	<table>
      <tr>
        <td><table>
		<form name="form1" method="post" action="index.php?page=edit">
		<input type="hidden" name="userdata" value="set" />
		<input type="hidden" name="uuid" value="<?=$uuid?>" />
		  <tr>
		    <td class="style2">USERID</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="2" bgcolor="#CCCCCC"><?=$uuid?></td>
		    </tr>
		  <tr>
		    <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
		    </tr>
		  <tr>
		    <td class="style2">Account first name</td>
		    <td class="style2">Account last name </td>
		    </tr>
		  <tr>
		    <td bgcolor="#CCCCCC" class="style2">
			<input style="width:70%" name="accfirst" type="text" id="accfirst" value="<?=$accfirst?>" />			</td>
		    <td bgcolor="#CCCCCC" class="style2">
			<input style="width:70%" name="acclast" type="text" id="acclast" value="<?=$acclast?>" />			</td>
		    </tr>
		  <tr>
		    <td bgcolor="#CCCCCC" class="style2">&nbsp;</td>
		    <td bgcolor="#CCCCCC" class="style2">&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="2" bordercolor="#ECE9D8" bgcolor="#FFFFFF" class="style1">.</td>
		    </tr>
		  <tr>
            <td width="296" class="style2">Real first name</td>
            <td width="298" class="style2">Real last name</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><input style="width:70%" name="fname" type="text" id="fname" value="<?=$firstnm?>" /></td>
            <td bgcolor="#CCCCCC"><input style="width:70%" name="lname" type="text" id="lname" value="<?=$lastnm?>" /></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
            </tr>
          <tr>
            <td class="style2">Street</td>
            <td class="style2">City</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><input style="width:70%" name="street" type="text" id="street" value="<?=$street?>" /></td>
            <td bgcolor="#CCCCCC"><input name="zip" type="text" id="city" value="<?=$zip?>" size="8" />
              <input name="city" type="text" id="street2" value="<?=$city?>" /></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
            </tr>
          <tr>
            <td class="style2">Country</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC">
              <select class="box" wide="25" name="country">
                <?
	  $DbLink->query("SELECT name FROM ".C_COUNTRY_TBL." ORDER BY name ASC ");
	  while(list($COUNTRYDB) = $DbLink->next_record())
	  {
	  ?>
                <option <? if($country == $COUNTRYDB){ echo"selected";} ?> value="<?=$COUNTRYDB?>"><?=$COUNTRYDB?></option>
      <?	
	  }
      ?>
              </select></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
		  <tr>
		    <td colspan="2" bgcolor="#FFFFFF"><span class="style1">.</span></td>
		    </tr>
		  <tr>
            <td><span class="style2">Email</span></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC"><input style="width:70%" name="email" type="text" id="email" value="<?=$email?>" /></td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
            </tr>
          <tr>
            <td colspan="2" bgcolor="#CCCCCC"><div align="center">
              <input type="submit" name="Submit2" value="Save Changes" />
            </div>              </td>
            </tr>
			</form>
          <tr>
            <td colspan="2" bgcolor="#FFFFFF" class="style1">.</td>
            </tr>
          <tr>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#CCCCCC">
			<table width="376" border="0" cellpadding="4" cellspacing="3" bordercolor="#FFFF00" bgcolor="#FFFFFF">
            <form name="form1" method="post" action="index.php?page=edit">
			  <tr>
                <td width="218" bgcolor="#999999"><span class="Stil4">Current Status:</span></td>
                <td width="282"><span class="Stil4"><span class="Stil3">
                  <? if($active==1){echo"<FONT COLOR=#00FF00>Active</FONT>";}
				  else if($active==3){echo"<FONT COLOR=#FF0000>Not Confirmed</FONT>";}
				  else{echo"<FONT COLOR=#FF0000>Inactive</FONT>";}?>
                </span></span></td>
              </tr>
              <tr>
                <td bgcolor="#999999"><span class="Stil4">Set Status:</span></td>
                <td><span class="Stil4">
                  <input type="hidden" name="state" value="set" />
                  <input type="hidden" name="uuid" value="<?=$uuid?>" />
				  <input type="hidden" name="active" value="<?=$active?>" />
                  <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </span></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td><div align="right">
                  <input type="submit" name="Submit" value="Save Status" />
                </div></td>
              </tr>
			</form>
            </table></td>
            </tr>
          <tr>
            <td bgcolor="#CCCCCC">&nbsp;</td>
            <td bgcolor="#CCCCCC">&nbsp;</td>
          </tr>

        </table></td>
        </tr>

    </table>
      <br />
      <br>
      <br>
      <br></td></tr>
</table>

<?
}
?>
