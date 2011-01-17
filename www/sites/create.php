<?php
$DbLink = new DB;
$DbLink->query("SELECT adress,region FROM ".C_ADM_TBL."");
list($ADRESSCHECK,$REGIOCHECK) = $DbLink->next_record();

//GET IP ADRESS
if ($_SERVER["HTTP_X_FORWARDED_FOR"]) { $userIP = $_SERVER["HTTP_X_FORWARDED_FOR"];
} elseif ($_SERVER["REMOTE_ADDR"]) { $userIP = $_SERVER["REMOTE_ADDR"];
} else { $userIP="This user has no ip";}
//GET IP ADRESS END

if($_GET[aktion]==""){
if($_POST[action]==""){ ?>

<?php
$_SESSION[PASSWD]="";
$_SESSION[EMAIC]="";
?>

<div id="content"><h2><?= SYSNAME ?>: Register</h2>


<div id="register">

  <form ACTION="index.php?page=create" METHOD="POST">
  
  <table>
  <? if($_SESSION[ERROR]){ ?>
  
  
  <tr>
    <td class="error" colspan="2"> <div align="center"><?=$_SESSION[ERROR]?></div></td>
  </tr>

  <? } else{?><? } ?>

  
  <tr>
    <td class="even" width="50%"><?=SYSNAME?> First name*</td>
    
    <td class="even" width="50%">
       <input id="register_input" name="accountfirst" type="text" size="25" maxlength="15" value="<?=$_SESSION[ACCFIRST]?>">
    </td>
  </tr>
  
  <tr>
    <td class="odd"><?=SYSNAME?> Last name*</td>
  
     <td class="odd">
	  	<? 
			$DbLink->query("SELECT lastnames FROM ".C_ADM_TBL."");
	    list($LASTNAMESC) = $DbLink->next_record();
		  
      if($LASTNAMESC=="1"){ ?>
			<select class="box" wide="25" name="accountlast">
      <?
      $DbLink->query("SELECT name FROM ".C_NAMES_TBL." WHERE active=1 ORDER BY name ASC ");
	    while(list($NAMEDB) = $DbLink->next_record()){
	    ?>
      
      <option>
        <?=$NAMEDB?>
      </option>
      
      <? } ?>
      </select>
			
      <? }else{?>
					  
			 <input id="register_input" name="accountlast" type="text" size="25" maxlength="15" value="<?=$_SESSION[ACCLAST]?>" />
					  
			<? } ?>
    </td>
  </tr>
            

  <tr>
    <td class="even"><?=SYSNAME?> Password*</td>
    <td class="even">
      <input id="register_input" name="wordpass" type="password" size="25" maxlength="15">
    </td>
  </tr>
                
	<? if($REGIOCHECK == "0"){?>


  <tr>
    <td class="odd"> Start Region*</td>
    <td class="odd">
      <select id="register_input" wide="25" name="startregion">
      <?
      $DbLink->query("SELECT regionName,regionHandle FROM ".C_REGIONS_TBL." ORDER BY regionName ASC ");
      while(list($RegionName,$RegionHandle) = $DbLink->next_record())	{ ?>
    
      <option value="<?=$RegionHandle?>"><?=$RegionName?></option>
      <? } ?>
      </select>
    </td>
  </tr>
	
  <? } if($ADRESSCHECK=="1"){ ?>
  
  
  <tr>
    <td class="even"> First Name*</td>
    <td class="even">
      <input id="register_input" name="firstname" type="text" size="25" maxlength="15" value="<?=$_SESSION[NAMEF]?>">
    </td>
    </tr>
  <tr>

  <td bgcolor="#999999"> Last Name*</td>
  <td bgcolor="#CCCCCC">
    <input id="register_input" name="lastname" type="text" size="25" maxlength="15" value="<?=$_SESSION[NAMEL]?>">
  </td>
  </tr>
  
  
  <tr>
    <td bgcolor="#999999"> Address*</td>
    <td bgcolor="#CCCCCC">
      <input id="register_input" name="adress" type="text" size="50" maxlength="60" value="<?=$_SESSION[ADRESS]?>">
    </td>
  </tr>
  
  
  <tr>
    <td bgcolor="#999999"> Zip*</td>
    <td bgcolor="#CCCCCC">
      <input id="register_input" name="zip" type="text" size="25" maxlength="15" value="<?=$_SESSION[ZIP]?>">
    </td>
    </tr>
  
  
  <tr>
    <td bgcolor="#999999"> City*</td>
    <td bgcolor="#CCCCCC">
      <input id="register_input" name="city" type="text" size="25" maxlength="15" value="<?=$_SESSION[CITY]?>">
    </td>
    </tr>
  
  <tr>
    <td bgcolor="#999999"> Country*</td>
    <td bgcolor="#CCCCCC">
    <select class="box" wide="25" name="country" value="<?=$_SESSION[COUNTRY]?>"> 
    <?
	  $DbLink->query("SELECT name FROM ".C_COUNTRY_TBL." ORDER BY name ASC ");
	  while(list($COUNTRYDB) = $DbLink->next_record())
	  {
	  ?>
    
    <option>
    <?=$COUNTRYDB?>
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
            <select name='tag' <? if ( $status == 1 and $monat == '' ) echo "class='red'"; else echo "class='black'"; ?>>
            <? for($i=1; $i<=31; $i++) {
            echo("<OPTION VALUE=\"$i\" ");
            if($tag==$i)echo("selected ");
            echo(">$i");}
            ?>
            </select>
            
            <select name='monat' <? if ( $status == 1 and $monat == '' ) echo "class='red'"; else echo "class='black'"; ?>>
            <? for($i=1; $i<=12; $i++) {
            echo("<OPTION VALUE=\"$i\" ");
            if($monat==$i)echo("selected ");
            echo(">$i");}
            ?>
            </select>
            
            <select name='jahr' <? if ( $status == 1 and $jahr == '' ) echo "class='red'"; else echo "class='black'"; ?>>
            <?
            $jetzt = getdate();
            $jahr1 = $jetzt["year"];
            for($i=1920; $i<=$jahr1; $i++) {
            echo("<OPTION VALUE=\"$i\" ");
            if($jahr==$i)echo("selected ");
            echo(">$i");}
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
      <input id="register_input" name="email" type="text" size="40" maxlength="40" value="<?=$_SESSION[EMAIL]?>"></td>
  </tr>
  
  
  <tr>
    <td class="odd"> Confirm Email*</td>
    <td class="odd">
      <input id="register_input" name="emaic" type="text" size="40" maxlength="40" ></td>
  </tr>


 	<tr>
	  <td class="even">
	  <center>
    <!-- Choice: red, white, blackglass, clean-->
    <script type="text/javascript">var RecaptchaOptions = {theme : 'blackglass'};</script> 
		 
	  <?		
	  require_once('recaptchalib.php');
	  $publickey = "6Lf_MQQAAAAAAIGLMWXfw2LWbJglGnvEdEA8fWqk"; // you got this from the signup page
	  echo recaptcha_get_html($publickey);
	  ?>
	  </td></center>
		
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



<? }else if($_POST[action]=="check"){
$_SESSION[ACCFIRST] = $_POST[accountfirst];  
$_SESSION[ACCFIRSL] = strtolower($_POST[accountfirst]);
$_SESSION[ACCLAST] = $_POST[accountlast];
if($ADRESSCHECK=="1"){
$_SESSION[NAMEF] = $_POST[firstname];
$_SESSION[NAMEL] = $_POST[lastname];
$_SESSION[ADRESS] = $_POST[adress];
$_SESSION[ZIP] = $_POST[zip];
$_SESSION[CITY] = $_POST[city];
$_SESSION[COUNTRY] = $_POST[country];
}else{
$_SESSION[NAMEF] = "none";
$_SESSION[NAMEL] = "none";
$_SESSION[ADRESS] = "none";
$_SESSION[ZIP] = "00000";
$_SESSION[CITY] = "none";
$_SESSION[COUNTRY] = "none";
}

if($REGIOCHECK == "0"){
$_SESSION[REGIONID] = $_POST[startregion];
}else{
$DbLink->query("SELECT startregion FROM ".C_ADM_TBL."");
list($adminregion) = $DbLink->next_record();

$_SESSION[REGIONID] = $adminregion;
}
$_SESSION[EMAIL] = $_POST[email];
$_SESSION[EMAIC] = $_POST[emaic];
$_SESSION[PASSWD] = $_POST[wordpass];

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

if(($_SESSION[PASSWD] == '')or($_SESSION[EMAIC] == '')or($_SESSION[EMAIL] == '')or($_SESSION[CITY] == '')or($_SESSION[ZIP] == '')or($_SESSION[ADRESS] == '')or($_SESSION[NAMEL] == '')or($_SESSION[NAMEF] == '')or($_SESSION[ACCFIRST] == '')or($_SESSION[ACCLAST] == '')){

if($_SESSION[EMAIC] == '') {
$_SESSION[ERROR]="Please confirm your email";
}
if($_SESSION[PASSWD] == '') {
$_SESSION[ERROR]="Please enter your Password";
}
if($_SESSION[EMAIL] == '') {
$_SESSION[ERROR]="Please enter your Email address";
}
if($_SESSION[CITY] == '') {
$_SESSION[ERROR]="Please enter your City";
}
if($_SESSION[ZIP] == '') {
$_SESSION[ERROR]="Please enter your ZIP";
}
if($_SESSION[ADRESS] == '') {
$_SESSION[ERROR]="Please enter your address";
}
if($_SESSION[NAMEL] == '') {
$_SESSION[ERROR]="Please enter your real last name";
}
if($_SESSION[NAMEF] == '') {
$_SESSION[ERROR]="Please enter your real first name";
}
if($_SESSION[ACCFIRST] == "") {
$_SESSION[ERROR]="Please enter a first name for your account";
}
if($_SESSION[ACCLAST] == "") {
$_SESSION[ERROR]="Please enter a last name for your account";
}

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else{
  
$DbLink->query("SELECT username FROM ".C_USERS_TBL." WHERE username='$_SESSION[ACCFIRST]' and lastname='$_SESSION[ACCLAST]'");
list($NAMECHECK1) = $DbLink->next_record();

$DbLink->query("SELECT username FROM ".C_USERS_TBL." WHERE username='$_SESSION[ACCFIRSTL]' and lastname='$_SESSION[ACCLAST]'");
list($NAMECHECK2) = $DbLink->next_record();

$DbLink->query("SELECT emailadress FROM ".C_WIUSR_TBL." WHERE emailadress='$_SESSION[EMAIL]'");
list($EMAILCHECK) = $DbLink->next_record();

$DbLink->query("SELECT agentIP FROM ".C_USRBAN_TBL." WHERE agentIP='$userIP'");
list($IPCHECK) = $DbLink->next_record();


if($EMAILCHECK){
$_SESSION[ERROR]="This email address is already in use";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else 
require_once('recaptchalib.php');
$privatekey = "6Lf_MQQAAAAAAB2vCZraiD2lGDKCkWfULvhG4szK";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
if(!$resp->is_valid){
$_SESSION[ERROR]="The reCAPTCHA wasn't entered correctly. Please try it again.";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else if($NAMECHECK1){
$_SESSION[ERROR]="This account name is already in use";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else if($NAMECHECK2){
$_SESSION[ERROR]="This account name is already in use";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else if($IPCHECK){
$_SESSION[ERROR]="This IP adress is banned";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}else{

if($_SESSION[EMAIL]==$_SESSION[EMAIC]){

$_SESSION[ACTION]="THX";
$_SESSION[ERROR]="";

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create&aktion=ok';
// -->
</script>";

}else{
$_SESSION[ERROR]="Email confirmation not correct";
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
// -->
</script>";
}
}



}
}
}else if($_GET[aktion]=="ok"){

if(($_SESSION[PASSWD] == '')or($_SESSION[EMAIC] == '')or($_SESSION[EMAIL] == '')or($_SESSION[CITY] == '')or($_SESSION[ZIP] == '')or($_SESSION[ADRESS] == '')or($_SESSION[NAMEL] == '')or($_SESSION[NAMEF] == '')or($_SESSION[ACCFIRST] == '')){

}else{
if(($_SESSION[ERROR] == '') and ($_SESSION[ACTION] == 'THX')) {
	$passneu = $_SESSION[PASSWD];
	$passwordHash = md5(md5($passneu) . ":" );
	
	$DbLink->query("SELECT username FROM ".C_USERS_TBL." where username='$_SESSION[ACCFIRST]' and lastname='$_SESSION[ACCLAST]' ");
	list($USERCHECK) = $DbLink->next_record();

	$DbLink->query("SELECT username FROM ".C_USERS_TBL." where username='$_SESSION[ACCFIRSL]' and lastname='$_SESSION[ACCLAST]' ");
	list($USERCHE2CK) = $DbLink->next_record();
	
	
	if(($USERCHECK) or ($USERCHE2CK)){
	$_SESSION[ERROR]="User already exists in Database";
	echo "<script language='javascript'>
<!--
window.location.href='index.php?page=create';
 -->
< /script>";
	
	}else{
// CODE generator
function code_gen($cod=""){ 
// ######## CODE LENGTH ########
$cod_l = 10;
// ######## CODE LENGTH ########
$zeichen = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9"; 
$array_b = explode(",",$zeichen); 
for($i=0;$i<$cod_l;$i++) { 
srand((double)microtime()*1000000); 
$z = rand(0,35); 
$cod .= "".$array_b[$z].""; 
} 
return $cod; 
}
$code=code_gen(); 
// CODE generator
	
	$image= sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x', 0, 0, 0, 0, 0, 0, 0, 0 );
	$UUID = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
	

  $DbLink->query("INSERT INTO ".C_USERS_TBL." 	(UUID,username,lastname,passwordHash,passwordSalt,homeRegion,homeLocationX,homeLocationY,homeLocationZ,homeLookAtX,homeLookAtY,homeLookAtZ,created,lastLogin,userInventoryURI,userAssetURI,profileCanDoMask,profileWantDoMask,profileAboutText,profileFirstText,profileImage,profileFirstImage)
	VALUES
('$UUID','$_SESSION[ACCFIRST]','$_SESSION[ACCLAST]','$passwordHash','','$_SESSION[REGIONID]','128','128','128','100','100','100',".time().",'0','$userInventoryURI','$userAssetURI','0','0','','','$image','$image')  ");
	
  $DbLink->query("INSERT INTO ".C_WIUSR_TBL."  	(UUID,username,lastname,passwordHash,passwordSalt,realname1,realname2,adress1,zip1,city1,country1,emailadress,agentIP,active)
  VALUES
('$UUID','$_SESSION[ACCFIRST]','$_SESSION[ACCLAST]','$passwordHash','','$_SESSION[NAMEF]','$_SESSION[NAMEL]','$_SESSION[ADRESS]','$_SESSION[ZIP]','$_SESSION[CITY]','$_SESSION[COUNTRY]','$_SESSION[EMAIL]','$userIP','1')  ");
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
            Account successfully created, you can now login <br>
              <br>
              <?=SYSNAME?> First Name: <b><?=$_SESSION[ACCFIRST]?></b>
              <br />
              <?=SYSNAME?> Last Name:  <b><?=$_SESSION[ACCLAST]?></b>
	    <br>            
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
