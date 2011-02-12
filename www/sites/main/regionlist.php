<?
if($_GET[order]=="name"){
$ORDERBY=" ORDER by regionName ASC";
}else if($_GET[order]=="x"){
$ORDERBY=" ORDER by locX ASC";
}else if($_GET[order]=="y"){
$ORDERBY=" ORDER by locY ASC";
}else{
$ORDERBY=" ORDER by RegionName ASC";
}

$GoPage= "index.php?page=regionlist";

$AnzeigeStart = 0;

// LINK SELECTOR
$LinkAusgabe="page=index.php?page=regionlist&";

if($_GET[AStart]){$AStart=$_GET[AStart];};
if(!$AStart) $AStart = $AnzeigeStart;

$ALimit = 10;
$Limit = "LIMIT $AStart, $ALimit";

$DbLink->query("SELECT COUNT(*) FROM ".C_REGIONS_TBL.""); 
list($count) = $DbLink->next_record();

$sitemax=ceil($count / 10);
$sitestart=ceil($AStart / 10)+1;
if($sitemax == 0){$sitemax=1;}
?>

<div id="content">
  <h2><?= SYSNAME ?>: <? echo $wiredux_region_list ?></h2>
  
  <div id="regionlist">

	<div id="message">
		<p><? echo $wiredux_region_list_page_info ?></p>
	</div>

	<table>
		<tr>
			<td>
				<font><b><?=$count?> <? echo $wiredux_regions_found ?></b></font>
			</td>
			<td>
			<div id="region_navigation">
				<table>
					<tr>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self">
								<img SRC=images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
								<img SRC=images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
							<font>Page <?=$sitestart ?>  of  <?=$sitemax ?></font>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
								<img SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($count <= ($AStart + $ALimit))) echo 0; else echo ($sitemax - 1) * $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
								<img SRC=images/icons/icon_forward_more_<? if($count <= ($AStart + $ALimit)) echo "off"; else echo "on" ?>.gif WIDTH=15 HEIGHT=15 border="0" />
							</a>
						</td>
						<td width="10"></td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=10&amp;" target="_self">
								<img SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=25&amp;" target="_self">
								<img SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=50&amp;" target="_self">
								<img SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50" />
							</a>
						</td>
						<td>
							<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=100&amp;" target="_self">
								<img SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100" />
							</a>
						</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	</table>
	<table>
		<thead>
			<tr>
				<td width="55%">
					<a href="index.php?page=regionlist&order=name"><b><u><? echo $wiredux_region_name ?></u></b></a>
				</td>
				<td width="15%">
					<a href="index.php?page=regionlist&order=x"><b><u><? echo $wiredux_location ?>: X</u></b></a>
				</td>
				<td width="15%">
					<a href="index.php?page=regionlist&order=y"><b><u><? echo $wiredux_location ?>: Y</u></b></a>
				</td>
				<td width="15%">
					<? echo $wiredux_info ?>
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
							$DbLink->query("SELECT RegionName,LocX,LocY FROM ".C_REGIONS_TBL." $ORDERBY $Limit");
							while(list($RegionName,$locX,$locY) = $DbLink->next_record()){
							$w++;
						?>
							<tr class="<? echo ($odd = $w%2 )? "even":"odd" ?>" >
								<td width="55%">
									<div><b><?=$RegionName?></b></div>
								</td>
								<td width="15%">
									<div><b><?=$locX/256?></b></div>
								</td>
								<td width="15%">
									<div><b><?=$locY/256?></b></div>
								</td>
								<td width="15%">
									<div>
										<a onClick="window.open('<?=SYSURL?>/app/region/?x=<?=$locX?>&y=<?=$locY?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')">
											<b><u><? echo $wiredux_more_info ?></u></b>
										</a>
									</div>
								</td>
							</tr>
						<?}?>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</div>
