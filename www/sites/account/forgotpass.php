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
if($_POST[Submit]=="Submit")
{
	$found = array();
	$found[0] = json_encode(array('Method' => 'ConfirmUserEmailName', 'WebPassword' => md5(WIREDUX_PASSWORD)
		, 'FirstName' => $_POST[first]
		, 'LastName' => $_POST[last]
		, 'Email' => $_POST[email]));
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);
	
	if ($recieved->{'Verified'} == "true") 
	{		// CODE generator		function code_gen($cod=""){ 			// ######## CODE LENGTH ########			$cod_l = 10;			// ######## CODE LENGTH ########			$zeichen = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,0,1,2,3,4,5,6,7,8,9"; 			$array_b = explode(",",$zeichen); 			for($i=0;$i<$cod_l;$i++) { 				srand((double)microtime()*1000000); 				$z = rand(0,35); 				$cod .= "".$array_b[$z].""; 			} 			return $cod; 		}		$code=code_gen(); 		// CODE generator				$UUID = $recieved->{'UUID'};		$DbLink->query("INSERT INTO ".C_CODES_TBL." (code,UUID,info,email,time)VALUES('$code','$UUID','pwreset','$_POST[email]',".time().")");	
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
		 $header = "From: " . SYSMAIL . "\r\n";
		 $mail_status = mail($sendto, $subject, $body, $header);
		//-----------------------------MAIL END --------------------------------------
		
		
		echo "<script language='javascript'>
		<!--
			window.alert('Check your email.');
			window.location.href='/index.php?page=login&btn=9';
		// -->
		</script>";
	}
	else
	{
		if ($recieved->{'Error'} != "") 
		{
			echo "<script language='javascript'>
			<!--			alert(\"" . $recieved->{'Error'} . "\");			// -->			</script>";		}		else		{			echo "<script language='javascript'>			<!--			alert(\"Unknow error. Please try again later.\");			// -->			</script>";		}	}}
?>


<div id="content">

  <h2><?= SYSNAME ?>: <? echo $webui_forgot_password ?></h2>
  
  <div id="forget_pass">
  
	<div id="info">
		<p><? echo $webui_forgot_password_info ?></p>
	</div>

  <table>
    <form method="POST" action="index.php?page=forgotpass" onSubmit="return Form(this)">
      <tr>
        <td>
          <table>
            <tr>
              <td class="even"><? echo $webui_avatar_first_name ?>*</td>
              <td class="even">
                <input id="forgot_pass_input" name="first" type="text" size="40" maxlength="50" value="<?=$_POST[First]?>">
              </td>
            </tr>
              
            <tr>
              <td class="odd"><? echo $webui_avatar_last_name ?>*</td>
              <td class="odd">
                <input id="forgot_pass_input" name="last" type="text" size="40" maxlength="50" value="<?=$_POST[Last]?>">
              </td>
            </tr>
                
            <tr>
              <td class="even"><? echo $webui_email ?>*</td>
              <td class="even">
                <input id="forgot_pass_input" name="email" type="text" size="40" maxlength="50" value="<?=$_POST[email]?>">
              </td>
            </tr>
                
            <tr>
              <td class="odd"><? echo $webui_confirm ?> <? echo $webui_email ?>*</td>
              <td class="odd">
                <input id="forgot_pass_input" name="email2" type="text" size="40" maxlength="50" value="<?=$_POST[email2]?>">
              </td>
            </tr>
                  
            <tr>
              <td class="even"></td>
              <td class="even"><input id="forgot_pass_bouton" type="submit" name="Submit" value="<? echo $webui_submit ?>"></td>
            </tr>
          </table>
        </td>
      </tr>
    </form>
  </table>
  </div>
</div>
