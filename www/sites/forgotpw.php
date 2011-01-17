<script language="JavaScript">
<!--
function Form(theForm)
{

  if (theForm.email.value == "")
  {
    alert("Please enter your \"e-mail adress\" ");
    theForm.email.focus();
    return (false);
  }

  if(theForm.email.value.indexOf('@') == -1)
  {
       alert("No valid e-mail adress!");
       theForm.email.focus();
       return (false);
  }
  
  if(theForm.email.value.indexOf('.') == -1)
  {
       alert("No valid e-mail adress!");
       theForm.email.focus();
       return (false);
  }
  
    if (theForm.email2.value == "")
  {
    alert("Please confirm your \"e-mail adress\" ");
    theForm.email2.focus();
    return (false);
  }

  if(theForm.email2.value.indexOf('@') == -1)
  {
       alert("No valid e-mail adress!");
       theForm.email2.focus();
       return (false);
  }
  
  if(theForm.email2.value.indexOf('.') == -1)
  {
       alert("No valid e-mail adress!");
       theForm.email2.focus();
       return (false);
  }
  
      if (theForm.email2.value != theForm.email.value)
  {
    alert("e-mail confirmation doesnt match with e-mail adress");
    theForm.email2.focus();
    return (false);
  }

  return (true);
}
//-->
</script>
<?

$DbLink = new DB;

if($_POST[Submit]=="Submit"){

$DbLink->query("SELECT UUID,active FROM ".C_WIUSR_TBL." WHERE emailadress='$_POST[email]'");
list($UUID,$active) = $DbLink->next_record();

if($active=='1'){
$DbLink->query("SELECT UUID FROM ".C_CODES_TBL." WHERE UUID='$UUID' and info='pwreset'");
list($UUIDCODE) = $DbLink->next_record();

if($UUIDCODE != ""){
echo "<script language='javascript'>
<!--
alert(\"Sorry you have already requested a new Password;\n you need to wait 24 hours to request another\");
// -->
</script>";
}else{
echo "<script language='javascript'>
<!--
alert(\"We have sent you a link to change your password\");
// -->
</script>";

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
	
$DbLink->query("INSERT INTO ".C_CODES_TBL." (code,UUID,info,email,time)VALUES('$code','$UUID','pwreset','$_POST[email]',".time().")");	

//-----------------------------------MAIL--------------------------------------
	 $date_arr = getdate();
	 $date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
	 $sendto = $_POST[email];
	 $subject = "Reset Account Password from ".SYSNAME;
	 $body .= "Here is the link to change your password for ".SYSNAME.".";
	 $body .= "\n\n";
	 $body .= "Password reset code: $code";
	 $body .= "\n\n";
	 $body .= "To get a new password just click the link below this text:";
	 $body .= "\n";
	 $body .= "".SYSURL."/index.php?page=pwreset&code=$code";
	 $body .= "\n\n"; 
	 $body .= "Thank you for using ".SYSNAME."";
	 $header = "";
	 $mail_status = mail($sendto, $subject, $body, $header);
//-----------------------------MAIL END --------------------------------------

}	
}else if($active == '0'){
echo "<script language='javascript'>
<!--
alert(\"Sorry, your account is deactivated\");
// -->
</script>";
}else{
echo "<script language='javascript'>
<!--
alert(\"Sorry, we have no account with that email address\");
// -->
</script>";
}
}
?>

<table width="100%" height="425" border="0" align="center">
<form method="POST" action="index.php?page=forgotpass" onSubmit="return Form(this)">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1">Forgot Password</p>                  </td>
                </tr>
              </table>
              <br />
              <table width="79%" height="199" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#FFFFFF">
                <tr>
                <td valign="top">Forgot your Password? <br>
                  No problem.  Enter your email address and your password will be sent to you                 <br>
                  <br>
                  <br>
                  <table width="91%" height="59" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
                    <tr>
                      <td width="31%" bgcolor="#CCCCCC">Email</td>
                      <td width="69%" bgcolor="#CCCCCC">
                        <input name="email" type="text" size="40" maxlength="50" value="<?=$_POST[email]?>">                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#CCCCCC">Confirm Email </td>
                      <td bgcolor="#CCCCCC"><input name="email2" type="text" size="40" maxlength="50" value="<?=$_POST[email2]?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFFFFF">&nbsp;</td>
                      <td bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Submit"></td>
                    </tr>
                  </table>
                </tr>
              </table></td>
            </tr>
			</form>
        </table>
