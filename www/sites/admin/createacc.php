<? 
if($_SESSION[ADMINUID] == $ADMINCHECK){
if($_GET[action]==""){
if($_POST[action]==""){ ?>
<style type="text/css">
<!--
.box {
	font-size: 12px;
	height: 20;	
}
--> 
</style>
<?
$_SESSION[PASSWD]="";
$_SESSION[EMAIC]="";

$DbLink = new DB;
?>
<FORM ACTION="index.php?page=createacc" METHOD="POST">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td valign="top"><table width="600" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
                <? if($_SESSION[ERROR]){ ?>
				<tr>
                  <td colspan="2" bgcolor="#E95249"><div align="center"><?=$_SESSION[ERROR]?></div></td>
                </tr>
				<? } else{?>
				<br>
				<? } ?>
				
                <tr>
                  <td width="176" bgcolor="#999999"><?=SYSNAME?> Firstname*</td>
                    <td width="410" bgcolor="#CCCCCC"><input class="box" name="accountfirst" type="text" size="25" maxlength="15" value="<?=$_SESSION[ACCFIRST]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><?=SYSNAME?> Lastname*</td>
                  <td bgcolor="#CCCCCC">
					<select class="box" wide="25" name="accountlast">
                      <?
	  	  
	  $DbLink->query("SELECT name FROM ".C_NAMES_TBL." WHERE active=1 ORDER BY name ASC ");
	  while(list($NAMEDB) = $DbLink->next_record())
	  {
	  ?>
                      <option>
                        <?=$NAMEDB?>
                      </option>
                      <?	
	  }
      ?>
                  </select>
or this:
<input name="accountlast2" type="text" class="box" id="accountlast2" value="<?=$_SESSION[ACCLAST]?>" size="25" maxlength="15" />	  		      </td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><?=SYSNAME?> Password*</td>
                    <td bgcolor="#CCCCCC"><input class="box" name="wordpass" type="password" size="25" maxlength="15"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999">Start Region* </td>
				  <td bgcolor="#CCCCCC"><select class="box" wide="25" name="region">
                    <?   
	  $DbLink->query("SELECT RegionName,RegionUUID FROM ".C_REGIONS_TBL." ORDER BY RegionName ASC ");
	  while(list($RegionName,$RegionUUID) = $DbLink->next_record())
	  {
	  ?>
       <option value="<?=$RegionUUID?>"><?=$RegionName?></option>
      <?	
	  }
      ?>
                  </select></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>First Name  </em></td>
                    <td bgcolor="#CCCCCC"><input class="box" name="firstname" type="text" size="25" maxlength="15" value="<?=$_SESSION[NAMEF]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>Last Name  </em></td>
                    <td bgcolor="#CCCCCC">
					<input class="box" name="lastname" type="text" size="25" maxlength="15" value="<?=$_SESSION[NAMEL]?>">					</td>			
				</tr>
                <tr>
                  <td bgcolor="#999999"><em>Adress</em></td>
                    <td bgcolor="#CCCCCC"><input class="box" name="adress" type="text" size="50" maxlength="60" value="<?=$_SESSION[ADRESS]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>Zip</em></td>
                    <td bgcolor="#CCCCCC"><input class="box" name="zip" type="text" size="25" maxlength="15" value="<?=$_SESSION[ZIP]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>City</em></td>
                    <td bgcolor="#CCCCCC"><input class="box" name="city" type="text" size="25" maxlength="15" value="<?=$_SESSION[CITY]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>Country</em></td>
                  <td bgcolor="#CCCCCC"><select class="box" wide="25" name="country" value="<?=$_SESSION[COUNTRY]?>">
                    <?
	  $DbLink->query("SELECT name FROM ".C_COUNTRY_TBL." ORDER BY name ASC ");
	  while(list($COUNTRYDB) = $DbLink->next_record())
	  {
	  ?>
                    <option>
                      <?=$COUNTRYDB?>
                    </option>
                    <?	
	  }
      ?>
                  </select></td>
                </tr>
                <tr>
                  <td bgcolor="#999999"><em>Date of Birth</em></td>
                    <td bgcolor="#CCCCCC"><table cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><select class="box" name='tag' <? if ( $status == 1 and $monat == '' ) echo "class='red'"; else echo "class='black'"; ?>>
                          <? for($i=1; $i<=31; $i++)
		{
		echo("<OPTION VALUE=\"$i\" ");
		if($tag==$i)echo("selected ");
		echo(">$i");
		}
?>
                          </select>
                          <select class="box" name='monat' <? if ( $status == 1 and $monat == '' ) echo "class='red'"; else echo "class='black'"; ?>>
                            <? for($i=1; $i<=12; $i++)
		{
		echo("<OPTION VALUE=\"$i\" ");
		if($monat==$i)echo("selected ");
		echo(">$i");
		}
?>
                          </select>
                          <select class="box" name='jahr' <? if ( $status == 1 and $jahr == '' ) echo "class='red'"; else echo "class='black'"; ?>>
                            <?
	$jetzt = getdate();
	$jahr1 = $jetzt["year"];

	for($i=1920; $i<=$jahr1; $i++)
		{
		echo("<OPTION VALUE=\"$i\" ");
		if($jahr==$i)echo("selected ");
		echo(">$i");
		}
?>
                          </select>                      </td>
                      </tr>
                      </table></td>
                </tr>
                <tr>
                  <td bgcolor="#999999">Email*</td>
                    <td bgcolor="#CCCCCC"><input class="box" name="email" type="text" size="40" maxlength="40" value="<?=$_SESSION[EMAIL]?>"></td>
                </tr>
                <tr>
                  <td bgcolor="#999999">Validate Email* </td>
                    <td bgcolor="#CCCCCC"><input class="box" name="emaic" type="text" size="40" maxlength="40" ></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF">&nbsp;</td>
                  <td bgcolor="#FFFFFF"><div align="right">
				    <INPUT type="hidden" name="action" value="check">
                    <INPUT name="submit" TYPE="submit" style="font-family:Verdana; font-size:11px; WIDTH:150; HEIGHT:19; BORDER: 1 solid #000000; COLOR: #000000; BACKGROUND-COLOR: cccccc" onFocus="this.style.backgroundColor='#006666'" onBlur="this.style.backgroundColor='#FFFFFF'" onMouseOver="this.style.backgroundColor='#CCCCCC'" onMouseout="this.style.backgroundColor='#FFFFFF'" value='Create new Account'>
                  </div></td>
                </tr>
              </table></td></tr>
  </table>
</FORM>
<? }else if($_POST[action]=="check"){
$_SESSION[ACCFIRST] = $_POST[accountfirst];  
$_SESSION[ACCFIRSL] = strtolower($_POST[accountfirst]);
if($_POST[accountlast2] != ""){
$_SESSION[ACCLAST] = $_POST[accountlast2];
}else{
$_SESSION[ACCLAST] = $_POST[accountlast];
}

if($_POST[firstname] == ""){ $_SESSION[NAMEF] = "none"; }else{ $_SESSION[NAMEF] = $_POST[firstname]; }
if($_POST[lastname] == ""){ $_SESSION[NAMEL] = "none"; }else{ $_SESSION[NAMEL] = $_POST[lastname]; }
if($_POST[adress] == ""){ $_SESSION[ADRESS] = "none"; }else{ $_SESSION[ADRESS] = $_POST[adress]; }
if($_POST[zip] == ""){ $_SESSION[ZIP] = "000000"; }else{ $_SESSION[ZIP] = $_POST[zip]; }
if($_POST[city] == ""){ $_SESSION[CITY] = "none"; }else{ $_SESSION[CITY] = $_POST[city]; }
if($_POST[country] == ""){ $_SESSION[COUNTRY] = "none"; }else{ $_SESSION[COUNTRY] = $_POST[country]; }

$_SESSION[EMAIL] = $_POST[email];
$_SESSION[EMAIC] = $_POST[emaic];
$_SESSION[PASSWD] = $_POST[wordpass];
$_SESSION[REGION] = $_POST[region];


$tag= $_POST[tag];
$monat= $_POST[monat];
$jahr= $_POST[jahr];

$tag2=date("d",time());
$monat2=date("m",time());
$jahr2=date("Y",time());

$jahr=$jahr-18;
$jahr2=$jahr2-18;
$agecheck1=$tag+$monat+$jahr;
$agecheck2=$tag2+$monat2+$jahr2;

if(($_SESSION[PASSWD] == '')or($_SESSION[EMAIC] == '')or($_SESSION[EMAIL] == '')or($_SESSION[CITY] == '')or($_SESSION[ZIP] == '')or($_SESSION[ADRESS] == '')or($_SESSION[NAMEL] == '')or($_SESSION[NAMEF] == '')or($_SESSION[ACCFIRST] == '')){

if($_SESSION[EMAIC] == '') {
$_SESSION[ERROR]="Please enter the Email a secondtime to check";
}
if($_SESSION[PASSWD] == '') {
$_SESSION[ERROR]="Please enter a Password";
}
if($_SESSION[EMAIL] == '') {
$_SESSION[ERROR]="Please enter a Email Adress";
}
if($_SESSION[CITY] == '') {
$_SESSION[ERROR]="Please enter a City";
}
if($_SESSION[ZIP] == '') {
$_SESSION[ERROR]="Please enter a ZIP";
}
if($_SESSION[ADRESS] == '') {
$_SESSION[ERROR]="Please enter a Adress";
}
if($_SESSION[NAMEL] == '') {
$_SESSION[ERROR]="Please enter a Real Last name";
}
if($_SESSION[NAMEF] == '') {
$_SESSION[ERROR]="Please enter your Real First name";
}
if($_SESSION[ACCFIRST] == "") {
$_SESSION[ERROR]="Please enter a First name for your account";
}
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
// -->
</script>";
}else{
  
$DbLink->query("SELECT FirstName FROM ".C_USERS_TBL." WHERE FirstName ='$_SESSION[ACCFIRST]' and LastName ='$_SESSION[ACCLAST]'");
list($NAMECHECK1) = $DbLink->next_record();

$DbLink->query("SELECT LastName FROM ".C_USERS_TBL." WHERE FirstName ='$_SESSION[ACCFIRSTL]' and LastName ='$_SESSION[ACCLAST]'");
list($NAMECHECK2) = $DbLink->next_record();

$DbLink->query("SELECT Email FROM ".C_USERS_TBL." WHERE Email='$_SESSION[EMAIL]'");
list($EMAILCHECK) = $DbLink->next_record();

if($EMAILCHECK){
$_SESSION[ERROR]="This Email Adress is already Registered";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
// -->
</script>";
}else if($NAMECHECK1){
$_SESSION[ERROR]="This Accountname is already in use";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
// -->
</script>";
}else if($NAMECHECK2){
$_SESSION[ERROR]="This Accountname is already in use";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
// -->
</script>";
}else{

if($_SESSION[EMAIL]==$_SESSION[EMAIC]){

$_SESSION[ACTION]="THX";
$_SESSION[ERROR]="";

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc&action=ok';
// -->
</script>";

}else{
$_SESSION[ERROR]="Email Confirmation not correct";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
// -->
</script>";
}
}



}
}
}else if($_GET[action]=="ok"){

if(($_SESSION[PASSWD] == '')or($_SESSION[EMAIC] == '')or($_SESSION[EMAIL] == '')or($_SESSION[CITY] == '')or($_SESSION[ZIP] == '')or($_SESSION[ADRESS] == '')or($_SESSION[NAMEL] == '')or($_SESSION[NAMEF] == '')or($_SESSION[ACCFIRST] == '')){

}else{
if(($_SESSION[ERROR] == '') and ($_SESSION[ACTION] == 'THX')) {
	$passneu = $_SESSION[PASSWD];
	$passwordHash = md5(md5($passneu) . ":" );

	$DbLink->query("SELECT FirstName FROM ".C_USERS_TBL." where FirstName='$_SESSION[ACCFIRST]' and LastName='$_SESSION[ACCLAST]' ");
	list($USERCHECK) = $DbLink->next_record();

	$DbLink->query("SELECT FirstName FROM ".C_USERS_TBL." where FirstName='$_SESSION[ACCFIRSL]' and LastName='$_SESSION[ACCLAST]' ");
	list($USERCHE2CK) = $DbLink->next_record();
	
	
	if(($USERCHECK) or ($USERCHE2CK)){
	$_SESSION[ERROR]="User already exists in Database";
	echo "<script language='javascript'>
<!--
window.location.href='index.php?page=createacc';
 -->
< /script>";
	
	}else{
	
	

	
	$image= sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 0, 0, 0, 0, 0, 0, 0, 0 );
	$UUID = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
	 
	$DbLink->query("INSERT INTO ".C_USERS_TBL." 	(PrincipalID,ScopeID,FirstName,LastName,Email,ServiceURLs,Created,UserLevel,UserFlags,UserTitle)
	VALUES
('$UUID','00000000-0000-0000-0000-000000000000','$_SESSION[ACCFIRST]','$_SESSION[ACCLAST]','$_SESSION[EMAIL]','HomeURI= GatekeeperURI= InventoryServerURI= AssetServerURI=',".time().",'0','0','')   ");

$DbLink->query("INSERT INTO ".C_AUTH_TBL." 	(UUID,passwordHash,passwordSalt,webLoginKey,accountType)
	VALUES
('$UUID','$passwordHash','$passwordSalt','00000000-0000-0000-0000-000000000000','UserAccount')   ");	

  $DbLink->query("INSERT INTO ".C_GRIDUSER_TBL." 	(UserID,HomeRegionID,HomePosition,HomeLookAt,LastRegionID,LastPosition,LastLookAt,Online,Login,Logout)
	VALUES
('$UUID','$_SESSION[REGIONID]','<128,128,128>','<0,0,0>','00000000-0000-0000-0000-000000000000','<0,0,0>','<0,0,0>','false','0','0')   ");
	
	$DbLink->query("INSERT INTO ".C_WIUSR_TBL." 
	(UUID,username,lastname,passwordHash,passwordSalt,realname1,realname2,adress1,zip1,city1,country1,emailadress)
	VALUES
	('$UUID','$_SESSION[ACCFIRST]','$_SESSION[ACCLAST]','$passwordHash','$passwordSalt','$_SESSION[NAMEF]','$_SESSION[NAMEL]','$_SESSION[ADRESS]','$_SESSION[ZIP]','$_SESSION[CITY]','$_SESSION[COUNTRY]','$_SESSION[EMAIL]')  ");
	

//-----------------------------------MAIL--------------------------------------
	 $date_arr = getdate();
	 $date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
	 $sendto = $_SESSION[EMAIL];
	 $subject = "Account Password from ".SYSNAME;
	 $body = "Thanks $_SESSION[NAMEF] $_SESSION[NAMEL]\n\n";
	 $body .= "Your Account was successfully created at ".SYSNAME.".\n";
	 $body .= "\n\nYour Password for ".SYSNAME.":\n\n";
	 $body .= "$_SESSION[PASSWD]\n\n";
	 $body .= "$user\n\n";
	 $body .= "Thank you for using ".SYSNAME."";
	 $header = "From: " . SYSMAIL . "\r\n";
	 $mail_status = mail($sendto, $subject, $body, $header);
	//-----------------------------MAIL END --------------------------------------
}
}else{

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
 -->
< /script>";
}}

?>
<table width="100%" height="410" border="0">
  <tr>
    <td valign="top" bgcolor="#666666"><br>
        <br>
        <br>
      <table width="50%" border="0" align="center" cellpadding="3" cellspacing="2">
      <tr>
        <td bgcolor="#FFFFFF"><div align="center"><strong>Account Successfully Created </strong></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><blockquote>
          <p><br>
            <br>
            The account was successfully created <br>
            with the following Data:<br>
              <br>
              <?=SYSNAME?> First Name: <b><?=$_SESSION[ACCFIRST]?></b></p>
          <p>
            <?=SYSNAME?> Last Name:  <b><?=$_SESSION[ACCLAST]?>
            </b><br>            
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
}}else{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
} ?>
