<? 
include("../../../settings/config.php");
include("../includes/config.php");
include("../includes/mt_header.php");
include("../languages/translator.php");
use Aurora\Addon\WebUI\Configs;


if(isset($_GET['agent'])){
	try{
		$info    = Configs::d()->GetGridUserInfo($_GET['agent']);
		$profile = Configs::d()->GetProfile($info->Name());
	}catch(UnexpectedValueException $e){
		$webui_404_title = 'User not found';
		$webui_404_text  = 'User not found';
		require('../../../sites/404.php');
		return;
	}
	$uuid         = $info->PrincipalID();
	$firstN       = $info->FirstName();
	$lastN        = $info->LastName();
	$created      = $profile->Created();
	$agentOnline  = $info->Online();
	$last_login    = date("d.m.Y - H:i",$info->LastLogin());
	$last_logout   = date("d.m.Y - H:i",$info->LastLogout());
	$RegionUUID   = $info->HomeUUID();
	$RegionName   = $info->HomeName();
	$profileImage = ($profile->Image() == '00000000-0000-0000-0000-000000000000') ? SYSURL . 'app/quickmap/images/no_profile.jpg' : Configs::d()->GridTexture($profile->Image());
    $profileTXT   = $profile->AboutText();

	$date=date("d.m.Y - H:i",$created);
}else{
	$webui_404_title = 'User not specified';
	$webui_404_text  = 'User not specified';
	require('../../../sites/404.php');
	return;
}
?>

<div id="content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="70%" valign="top">
    
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td width="30%">&nbsp;</td>
        <td width="70%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td width="30%" align="right" class="styleTitel"><?=$CONF_txt_citizen?>:&nbsp;</td> 
        <td align="left" class="styleTitel1"><? print $firstN;?> <? print $lastN; ?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_status?>:&nbsp;</td> 
        <td align="left"><? if($agentOnline == '1'){echo"<span class='styleOnline'>Online</span>";}else{echo"<span class='styleOffline'>Offline</span>";} ?>         </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><? echo $CONF_txt_avatar_uuid;?>:&nbsp;</td> 
        <td align="left" class="styleDesc"><?=$uuid?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_birthday?>:&nbsp;</td> 
        <td align="left" class="styleDesc"><?=$date?></td>
      </tr>

      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_lastlogin?>:&nbsp;</td>
        <td align="left" class="styleDesc"><?=$last_login?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_lastlogout?>:&nbsp;</td>
        <td align="left" class="styleDesc"><?=$last_logout?></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
<?php if($info->HomeUUID() !== '00000000-0000-0000-0000-000000000000'){ ?>
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_home?>:&nbsp;</td>
        <td align="left" class="styleLink"> <a href="./show_region.php?region=<?=$RegionUUID?>"><?=$RegionName?></a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
<?php } ?>

      
      <tr>
        <td align="right" valign="top" class="styleItem"><?=$CONF_txt_profiletext?>:&nbsp;</td>
        <td align="left" class="styleDesc">
        <? if ($profileTXT){ echo "$profileTXT"; } else {echo"$CONF_txt_noprofile";}?></td>
      </tr>
      
    </table>
    </td>
    <td width="45%" valign="top">    
    <br /><br /><br />
    
    <center>
    <img src="<?php echo $profileImage; ?>" alt="<?=$CONF_txt_noproimage?>" title="<?=$CONF_txt_noproimage?>" width="150" height="150" />
    </center>
    </td>
  </tr>
</table>
</div></div></div>



<div id="footer">
<? include("../includes/mt_footer.php"); ?>
</div><!-- fin de #footer -->



</body></html>

