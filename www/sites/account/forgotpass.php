<script language="JavaScript">
<!--
function Form(theForm){
	if (theForm.email.value == ""){
		alert("Please enter your e-mail address.");
		theForm.email.focus();
		return (false);
	}else if(theForm.email.value.indexOf('@') == -1){
	   alert("Not a valid e-mail address!");
	   theForm.email.focus();
	   return (false);
	}else if(theForm.email.value.indexOf('.') == -1){
	   alert("Not a valid e-mail address!");
	   theForm.email.focus();
	   return (false);
	}else if (theForm.email2.value == ""){
		alert("Please confirm your e-mail address.");
		theForm.email2.focus();
		return (false);
	}else if(theForm.email2.value.indexOf('@') == -1){
	   alert("Not a valid e-mail address!");
	   theForm.email2.focus();
	   return (false);
	}else if(theForm.email2.value.indexOf('.') == -1){
	   alert("Not a valid e-mail address!");
	   theForm.email2.focus();
	   return (false);
	}else if(theForm.email2.value != theForm.email.value){
		alert("E-mail confirmation does not match with e-mail address.");
		theForm.email2.focus();
		return (false);
	}

	return (true);
}
//-->
</script>
<?php
use Aurora\Addon\WebUI\Configs;
if(isset($_POST['name']) && $_POST['name']!=''){
	if (Configs::d()->ConfirmUserEmailName($_POST['name'], $_POST['email'])){
		// CODE generator
		function code_gen($cod=""){
			// ######## CODE LENGTH ########
			$cod_l = 10;
			// ######## CODE LENGTH ########
			$zeichen = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$array_b = str_split($zeichen);
			for ($i = 0; $i < $cod_l; $i++) {
				$cod .= "" . $array_b[mt_rand(0, 35)] . "";
			}
			return $cod;
		}

		$code = code_gen();
		
		Globals::i()->DBLink->Insert(C_CODES_TBL, array(
			'code'  => $code,
			'UUID'  => Configs::d()->GetProfile($_POST['name'])->PrincipalID(),
			'info'  => 'pwreset',
			'email' => $_POST['email'],
			'time'  => $_SERVER['REQUEST_TIME']
		));

		//-----------------------------------MAIL--------------------------------------
		 $date_arr = getdate();
		 $date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
		 $sendto = $_POST['email'];
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
		 $mail_status = @mail($sendto, $subject, $body, $header);
		//-----------------------------MAIL END --------------------------------------


		echo "<script language='javascript'>
		<!--
			window.alert('Check your email.');
			window.location.href='/index.php?page=login&btn=9';
		// -->
		</script>";
	}else{
		if ($recieved->{'Error'} != "")
		{
			echo "<script language='javascript'>
			<!--			alert(\"" . $recieved->{'Error'} . "\");			// -->			</script>";
		}else{
			echo "<script language='javascript'>			<!--			alert(\"Unknow error. Please try again later.\");			// -->			</script>";
		}
	}
}
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
											<input id="forgot_pass_input" name="name" type="text" size="40" maxlength="50" value="<?php echo $_POST['name']?>">
										</div>
									</td>
								</tr>
								<tr>
									<td class="odd"><?php echo $webui_email ?>*</td>
									<td class="odd">
										<div class="roundedinput">
											<input id="forgot_pass_input" name="email" type="email" size="40" maxlength="50" value="<?php echo $_POST['email']?>">
										</div>
									</td>
								</tr>
									<tr>
										<td class="even"><?php echo $webui_confirm ?> <?php echo $webui_email ?>*</td>
										<td class="even">
											<div class="roundedinput">
												<input id="forgot_pass_input" name="email2" type="email" size="40" maxlength="50" value="<?php echo $_POST['email2']?>">
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
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
