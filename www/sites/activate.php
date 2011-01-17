<?

if($_GET[code])
{
	$DbLink = new DB;

	$DbLink->query("SELECT UUID FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
	list($UUID) = $DbLink->next_record();
}

if($UUID)
{	
	$found = array();
	$found[0] = json_encode(array('Method' => 'Authenticated', 'WebPassword' => md5(WIREDUX_PASSWORD), 'UUID' => $UUID));
	$do_post_requested = do_post_request($found);
	$recieved = json_decode($do_post_requested);
	if ($recieved->{'Verified'} == "true") 
	{
		$WERROR="Thank you, your account is now active and ready to use.";
		$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
	}
	else
	{
		$WERROR="Internal error, please try again later.";
	}
}
else
{
	$WERROR="This isnt a valid code or maybe the code was older than 24h";
}
?>

<table width="100%" height="425" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1">Activate Account</p></td>
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