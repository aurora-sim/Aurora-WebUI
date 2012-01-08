<?

if($_GET[code]){
$DbLink = new DB;

$DbLink->query("SELECT UUID,email FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET[code])."' and info='pwreset'");
list($UUID,$email) = $DbLink->next_record();
}



if($UUID)
{
	$WERROR="Thank you, we sent you a new Password to $email";

	function gen_pass(){
		srand ( (double) microtime()*10000000);
		$rand_pass = rand(6,10);
		   for ($i = 0;$i < $rand_pass; $i++){

			$rand_num = rand(48,57); 
			$rand_lowcase = rand(97,122); 
			$rand_upcase = rand(65,90); 
			$rand_choose = rand(1,3); 
			   
			$num = $rand_num ;
			$lowcase = chr($rand_lowcase);
			$upcase = chr($rand_upcase);
	   
			switch ($rand_choose){
		   
			case 1:
				$pass = $pass. $num;
				break;
			case 2:
				$pass = $pass. $lowcase;
				break;
			case 3:
				$pass = $pass. $upcase;
				break;
			}
		}
		return($pass);
	}
	  
	$pass = gen_pass();

	$found = array();
	$found[0] = json_encode(array('Method' => 'ForgotPassword', 'WebPassword' => md5(WEBUI_PASSWORD)
		, 'UUID' => cleanQuery($UUID)
		, 'Password' => cleanQuery($pass)));
		
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);
	
	// echo '<pre>';
	// var_dump($recieved);
	// var_dump($do_post_requested);
	// echo '</pre>';
	
	if ($recieved->{'Verified'} == "true") 
	{	
		$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='".cleanQuery($_GET[code])."' and info='pwreset'");
		//-----------------------------------MAIL--------------------------------------
		 $date_arr = getdate();
		 $date = "$date_arr[mday].$date_arr[mon].$date_arr[year]";
		 $sendto = $email;
		 $subject = "Account Password from ".SYSNAME;
		 $body .= "Your Password was changed at ".SYSNAME.".\n";
		 $body .= "The new Password for ".SYSNAME." is:";
		 $body .= "\n\n";
		 $body .= "$pass";
		 $body .= "\n\n";
		 $body .= "Thank you for using ".SYSNAME."";
		 $header = "From: " . SYSMAIL . "\r\n";
		 $mail_status = mail($sendto, $subject, $body, $header);
		//-----------------------------MAIL END --------------------------------------
	}
}
else
{
	$WERROR="This isn't a valid code, or the code is older than 24 hours";
}
?>



<table width="100%" height="425" border="0" align="center">
            <tr>
              <td valign="top">
			  <table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1">Change Password</p>                  </td>
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