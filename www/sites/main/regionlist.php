<?
use Aurora\Addon\WebUI;
use Aurora\Addon\WebAPI\Configs;

$_GET['AStart'] = isset($_GET['AStart']) ? (integer)$_GET['AStart'] : 1;
$_GET['ALimit'] = isset($_GET['ALimit']) ? (integer)$_GET['ALimit'] : 10;

if($_GET['AStart'] < 1){
	$_GET['AStart'] = 1;
}
if($_GET['ALimit'] < 10){
	$_GET['ALimit'] = 10;
}
$_GET['order'] = isset($_GET['order']) ? $_GET['order'] : 'name';
$sortByRegion = $_GET['order'] === 'name' ? true : null;
$sortByLocX = $_GET['order'] === 'x' ? true : null;
$sortByLocY = $_GET['order'] === 'y' ? true : null;
$start = (($_GET['AStart'] - 1) * $_GET['ALimit']);
$regions = Configs::d()->GetRegions(null, 0, $start, $_GET['ALimit'], $sortByRegion, $sortByLocX, $sortByLocY);

$GoPage= "index.php?page=regionlist";

$AnzeigeStart = 0;

// LINK SELECTOR
$LinkAusgabe="page=index.php?page=regionlist&";

$AStart = $_GET['AStart'];
$ALimit = $_GET['ALimit'];
$count = $regions->count();
$sitemax=ceil($count / $_GET['ALimit']);
if($sitemax == 0){$sitemax=1;}
?>

<div id="content">
  <div id="ContentHeaderLeft"><h5><p><?= SYSNAME ?></p></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><p><? echo $webui_region_list; ?></p></h5></div>
  <div id="regionlist">
	<div id="info"><p><? echo $webui_region_list_page_info ?></p></div>
	
	<div id="annonce10">
	<table>
		<tr>
			<td>
				<p><?=$count?> <? echo $webui_regions_found; ?><p>
			</td>
			<td>
			<div id="region_navigation">
				<table>
					<tr>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self" title="<? echo $webui_pagination_tooltips_back_begin; ?>">
								<img SRC=images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"  title="<? echo $webui_pagination_tooltips_back_page; ?>">
								<img SRC=images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
						  	<p><?php echo $webui_navigation_page, ' ', $_GET['AStart'], ' ', $webui_navigation_of, ' ', $sitemax; ?></p>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self" title="<? echo $webui_pagination_tooltips_forward_page; ?>">
								<img SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($count <= ($AStart + $ALimit))) echo 0; else echo ($sitemax - 1) * $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"  title="<? echo $webui_pagination_tooltips_last_page; ?>">
								<img SRC=images/icons/icon_forward_more_<? if($count <= ($AStart + $ALimit)) echo "off"; else echo "on" ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td></td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=10&amp;" target="_self" title="<? echo $webui_pagination_tooltips_show10; ?>">
								<img SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="<? echo $webui_pagination_tooltips_limit10; ?>" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=25&amp;" target="_self" title="<? echo $webui_pagination_tooltips_show25; ?>">
								<img SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="<? echo $webui_pagination_tooltips_limit25; ?>" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=50&amp;" target="_self" title="<? echo $webui_pagination_tooltips_show50; ?>">
								<img SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="<? echo $webui_pagination_tooltips_limit50; ?>" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=100&amp;" target="_self" title="<? echo $webui_pagination_tooltips_show100; ?>">
								<img SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="<? echo $webui_pagination_tooltips_limit100; ?>" />
							</a>
						</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	</table>
	</div>
	
	<div id="annonce10">
	<table>
		<thead>
			<tr>
				<td width="55%">
					<a href="index.php?page=regionlist&order=name" title="<? echo $webui_pagination_tooltips_sortn; ?>"><p><? echo $webui_region_name; ?></p></a>
				</td>
				<td width="15%">
					<a href="index.php?page=regionlist&order=x" title="<? echo $webui_pagination_tooltips_sortx; ?>"><p><? echo $webui_location; ?>: X</p></a>
				</td>
				<td width="15%">
					<a href="index.php?page=regionlist&order=y" title="<? echo $webui_pagination_tooltips_sorty; ?>"><p><? echo $webui_location; ?>: Y</p></a>
				</td>
				<td width="15%">
					<p><? echo $webui_info ?></p>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4">
					<table>
						<tbody>
						<?
							$w=0;
							while($regions->valid() && $regions->key() < ($start + $ALimit)){
							$w++;
							$region = $regions->current();
							$RegionName = $region->RegionName();
							$locX = $region->RegionLocX();
							$locY = $region->RegionLocY();
						?>
							<tr class="<? echo ($odd = $w%2 )? "even":"odd" ?>" >
								<td width="55%">
									<div><p><?=$RegionName?></p></div>
								</td>
								<td width="15%">
									<div><p><?=$locX/256?></p></div>
								</td>
								<td width="15%">
									<div><p><?=$locY/256?></p></div>
								</td>
								<td width="15%">
									<div>
										<a onClick="window.open('<?=SYSURL?>app/region/?x=<?=$locX?>&y=<?=$locY?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')">
											<p><? echo $webui_more_info ?></p>
										</a>
									</div>
								</td>
							</tr>
						<?
							$regions->next();
						}?>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
</div>
</div>
