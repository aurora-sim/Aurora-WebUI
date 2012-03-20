<? 
include("../../../settings/config.php");
include("../includes/config.php");
include("../includes/mt_header.php");
include("../languages/translator.php");
use Aurora\Addon\WebUI\Configs;
use Aurora\Framework\RegionFlags;

if($_GET['region']){
	$region = Configs::d()->GetRegion($_GET['region']);
	$owner = Configs::d()->GetGridUserInfo($region->EstateOwner());
	$firstN = $owner->FirstName();
	$lastN = $owner->LastName();
	
	$UUID       = $region->RegionID()   ;
	$regionName = $region->RegionName() ;
	$locX       = $region->RegionLocX() ;
	$locY       = $region->RegionLocY() ;
	$sizeX      = $region->RegionSizeX();
	$sizeY      = $region->RegionSizeY();
	$owner      = $region->EstateOwner();
	$regionOnline = ($region->Flags() & RegionFlags::RegionOnline) == RegionFlags::RegionOnline;
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
        <td align="right"><span class="styleTitel"><? echo $CONF_txt_region;?>:&nbsp;</span></td>
        <td><span class="styleTitel1"><?=$regionName?></span></td>
      </tr>
     
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_status?>:&nbsp;</td> 
        <td align="left"><? if($regionOnline == '21'){echo"<span class='styleOnline'>Online</span>";}else{echo"<span class='styleOffline'>Offline</span>";} ?>         </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
            
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_region_uuid;?>:&nbsp;</span></td>
        <td><span class="styleDesc"> <?=$UUID?></span></td>
      </tr>
      
      <tr>
        <? if ($locX > 80000) { $locX = $locX / 256; $locY = $locY / 256; } ?>

        <td align="right"><span class="styleItem"><? echo $CONF_txt_coordinates;?>:&nbsp;</span></td>
        <td><span class="styleDesc"> X: <?=$locX?>&nbsp;&nbsp; Y: <?=$locY?></span></td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_size;?> X:&nbsp;</span></td> 
        <td><span class="styleDesc"> <?=$sizeX?></span></td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_size;?> Y:&nbsp;</span></td>
        <td><span class="styleDesc"> <?=$sizeY?></span></td>
      </tr>
      <tr>
        <td class="styleText">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_owner; ?>:&nbsp;</span></td>
        <td><span class="styleLink"><a href="./show_member.php?agent=<?=$owner?>"><?=$firstN?> <?=$lastN?></a></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>   
    </td>


	<td width="45%" valign="top">
		<img src="<?php echo $region->ServerURI() . "/index.php?method=regionImage" . str_replace('-', '', $region->RegionID()); ?>">
	</td>
   </tr>
 </table>
</div></div></div>



<div id="footer">
<? include("../includes/mt_footer.php"); ?>
</div><!-- fin de #footer -->



</body></html>



