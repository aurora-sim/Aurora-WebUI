<?php
include("../../../settings/config.php");
include("../includes/config.php");
include("../includes/mt_header.php");
include("../languages/translator.php");
use Aurora\Addon\WebUI\Configs;
use Aurora\Framework\RegionFlags;

if(isset($_GET['region'])){
	$region = Configs::d()->GetRegion($_GET['region']);
	$firstN = 'Unknown';
	$lastN  = 'User';
	if($region->EstateOwner() !== '00000000-0000-0000-0000-000000000000'){
		$owner = Configs::d()->GetGridUserInfo($region->EstateOwner());
		$firstN = $owner->FirstName();
		$lastN = $owner->LastName();
	}

	$UUID         = $region->RegionID()   ;
	$regionName   = $region->RegionName() ;
	$locX         = $region->RegionLocX() ;
	$locY         = $region->RegionLocY() ;
	$sizeX        = $region->RegionSizeX();
	$sizeY        = $region->RegionSizeY();
	$owner        = $region->EstateOwner();
	$regionOnline = ($region->Flags() & RegionFlags::RegionOnline) == RegionFlags::RegionOnline;
}
if ($locX > 80000){
	$locX = $locX / 256;
	$locY = $locY / 256;
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
						<td align="right"><span class="styleTitel"><?php echo $CONF_txt_region;?>:&nbsp;</span></td>
						<td><span class="styleTitel1"><?php echo $regionName; ?></span></td>
					</tr>
					<tr>
						<td align="right" class="styleItem"><?php echo $CONF_txt_status; ?>:&nbsp;</td>
						<td align="left"><?php if($regionOnline == '21'){echo"<span class='styleOnline'>Online</span>";}else{echo"<span class='styleOffline'>Offline</span>";} ?>         </td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="right"><span class="styleItem"><?php echo $CONF_txt_region_uuid;?>:&nbsp;</span></td>
						<td><span class="styleDesc"> <?php echo $UUID; ?></span></td>
					</tr>
					<tr>
						<td align="right"><span class="styleItem"><?php echo $CONF_txt_coordinates;?>:&nbsp;</span></td>
						<td><span class="styleDesc"> X: <?php echo $locX; ?>&nbsp;&nbsp; Y: <?php echo $locY; ?></span></td>
					</tr>
					<tr>
						<td align="right"><span class="styleItem"><?php echo $CONF_txt_size;?> X:&nbsp;</span></td>
						<td><span class="styleDesc"> <?php echo $sizeX; ?></span></td>
					</tr>
					<tr>
						<td align="right"><span class="styleItem"><?php echo $CONF_txt_size;?> Y:&nbsp;</span></td>
						<td><span class="styleDesc"> <?php echo $sizeY; ?></span></td>
					</tr>
					<tr>
						<td class="styleText">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="right"><span class="styleItem"><?php echo $CONF_txt_owner; ?>:&nbsp;</span></td>
						<td><span class="styleLink"><?php if($region->EstateOwner() != '00000000-0000-0000-0000-000000000000'){ ?><a href="./show_member.php?agent=<?php echo $region->EstateOwner(); ?>"><?php echo $firstN, ' ', $lastN; ?></a><?php }else{ echo $firstN, ' ', $lastN; } ?></span></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td width="45%" valign="top"><img src="<?php echo $region->ServerURI() . "/index.php?method=regionImage" . str_replace('-', '', $region->RegionID()); ?>"></td>
		</tr>
	</table>
</div>
</div>
</div>
	<div id="footer"><?php include("../includes/mt_footer.php"); ?></div><!-- fin de #footer -->
</body>
</html>
