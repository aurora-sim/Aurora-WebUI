<script language="JavaScript">
<!--
function Form(theForm)
{

  if (theForm.email.value == "")
  {
    alert("Please enter your e-mail address.");
    theForm.email.focus();
    return (false);
  }

  if(theForm.email.value.indexOf('@') == -1)
  {
       alert("Not a valid e-mail address!");
       theForm.email.focus();
       return (false);
  }
  
  if(theForm.email.value.indexOf('.') == -1)
  {
       alert("Not a valid e-mail address!");
       theForm.email.focus();
       return (false);
  }
  
    if (theForm.email2.value == "")
  {
    alert("Please confirm your e-mail address.");
    theForm.email2.focus();
    return (false);
  }

  if(theForm.email2.value.indexOf('@') == -1)
  {
       alert("Not a valid e-mail address!");
       theForm.email2.focus();
       return (false);
  }
  
  if(theForm.email2.value.indexOf('.') == -1)
  {
       alert("Not a valid e-mail address!");
       theForm.email2.focus();
       return (false);
  }
  
      if (theForm.email2.value != theForm.email.value)
  {
    alert("E-mail confirmation does not match with e-mail address.");
    theForm.email2.focus();
    return (false);
  }

  return (true);
}
//-->
</script>
<?php
if($_POST[name]!='')
{
	$found = array();
	$found[0] = json_encode(array('Method' => 'ConfirmUserEmailName', 'WebPassword' => md5(WEBUI_PASSWORD)
		, 'Name' => cleanQuery($_POST[name])
		, 'Email' => cleanQuery($_POST[email])));
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);
	
	if ($recieved->{'Verified'} == "true") 
	{		// CODE generator		
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
		$UUID = $recieved->{'UUID'};		
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
		 $body .= "".SYSURL."/index.php?page=resetpass&code=$code";
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
  <div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><?php echo $webui_forgot_password; ?></h5></div> 
  <div id="forget_pass">
  <div id="info"><p><?php echo $webui_forgot_password_info ?></p></div>
  
  <div id="annonce10">
  <form method="POST" action="index.php?page=forgotpass" onSubmit="return Form(this)">
    <table>
      <tr>
        <td>
          <table>
            <tr>
              <td class="even"><?php echo $webui_avatar_name ?>*</td>
              <td class="even" width="50%">
                <div class="roundedinput">
                  <input id="forgot_pass_input" name="name" type="text" size="40" maxlength="50" value="<?php echo $_POST[name]?>">
                </div>
              </td>
            </tr>
                
            <tr>
              <td class="odd"><?php echo $webui_email ?>*</td>
              <td class="odd">
                <div class="roundedinput">
                  <input id="forgot_pass_input" name="email" type="email" size="40" maxlength="50" value="<?php echo $_POST[email]?>">
                </div>
              </td>
            </tr>
                
            <tr>
              <td class="even"><?php echo $webui_confirm ?> <?php echo $webui_email ?>*</td>
              <td class="even">
                <div class="roundedinput">
                  <input id="forgot_pass_input" name="email2" type="email" size="40" maxlength="50" value="<?php echo $_POST[email2]?>">
                </div>
              </td>
            </tr>
                  
            <tr>
              <td class="odd"></td>
              <td class="odd">
                <div class="center">
                  <input type="hidden" name="action" value="check">
                  <button id="forgot_pass_bouton" name="Submit" type="Submit"><?php echo $webui_submit ?></button>
              </div>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
  </div>
  </div>
</div>
