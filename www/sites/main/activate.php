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
		$WERROR= $webui_verified_account;
		$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE code='$_GET[code]' and info='confirm'");
	}
	else
	{
		$WERROR=$webui_internal_error;
	}
}
else
{
	$WERROR=$webui_invalid_code;
}
?>

<table width="100%" height="425" border="0" align="center">
            <tr>
              <td valign="top"><table width="50%" border="0" align="center">
                <tr>
                  <td><p align="center" class="Stil1"><? echo $webui_activate_account ?></p></td>
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
