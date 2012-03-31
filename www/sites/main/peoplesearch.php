<?php
$AnzeigeStart = 0;

// LINK SELECTOR
$PageLink = "index.php?page=peoplesearch&btn=$_GET[btn]&";
$LinkAusgabe = $PageLink . "name=$_GET[name]&";

$AStart = null;
if(isset($_GET['AStart'])){
    $AStart = (integer)$_GET['AStart'];
}

if(!isset($AStart)){
    $AStart = $AnzeigeStart;
}

$ALimit = $AStart + 10;
$Limit = "LIMIT $AStart, $ALimit";

$whereclause = ' where ';
if(isset($_GET['name']) && $_GET['name'] != ''){
    $whereclause = $whereclause . 'Name like \'' . $_GET[name] . '%\' ';
}
if($whereclause == ' where '){
    $whereclause = '';
}

$DbLink = new DB();
$DbLink->query("SELECT COUNT(*) FROM " . C_USERS_TBL . $whereclause);
list($count) = $DbLink->next_record();

$sitemax   = round($count / 10, 0);
$sitestart = round($AStart / 10, 0) + 1;
if($sitemax == 0){
    $sitemax = 1;
}
?>

<div id="content">
    <div id="ContentHeaderLeft"><h5><p><?php echo SYSNAME ?></p></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><p><?php echo $webui_people_search; ?></p></h5></div>
    <div id="searchpeople">
        <div id="info"><p><?php echo $webui_people_search_info; ?></p></div>
        <div id="message">
            <?php echo $webui_avatar_name; ?> : <input id="name" name="name" type="text" size="25" maxlength="15" value="" />
            <button id="search_bouton" type="button" onclick="document.location.href=('<?php echo $PageLink ?>'+ 'name=' + document.getElementById('name').value)"><? echo $webui_people_search_bouton ?></button>
        </div>
	</div>
	<div id="PeopleSearch">
		<div id="annonce10">
			<table>
				<tr>
					<td><p><b><?php echo $count ?> <?php echo $webui_users_found ?></b></p></td>
					<td>
						<div id="region_navigation">
							<table>
								<tr>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=0&amp;ALimit=<?php echo $ALimit ?>" target="_self">
											<img SRC=images/icons/icon_back_more_<?php if (0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=<?php if (0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?php echo $ALimit ?>" target="_self">
											<img SRC=images/icons/icon_back_one_<?php if (0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
										</a>
									</td>
									<td>
										<p><?php echo $webui_navigation_page; ?> <?php echo $sitestart ?> <?php echo $webui_navigation_of; ?> <?php echo $sitemax ?></p>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=<?php if ($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?php echo $ALimit ?>" target="_self">
											<img SRC=images/icons/icon_forward_one_<?php if ($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=<?php if (0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?php echo $ALimit ?>" target="_self">
											<img SRC=images/icons/icon_forward_more_<?php if (0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=0&amp;ALimit=10&amp;" target="_self">
											<img SRC=images/icons/<?php if ($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=0&amp;ALimit=25&amp;" target="_self">
											<img SRC=images/icons/<?php if ($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=0&amp;ALimit=50&amp;" target="_self">
											<img SRC=images/icons/<?php if ($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50" />
										</a>
									</td>
									<td>
										<a href="<?php echo $LinkAusgabe ?>AStart=0&amp;ALimit=100&amp;" target="_self">
											<img SRC=images/icons/<?php if ($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100" />
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
				<tr>
					<td><a href="index.php?page=peoplesearch&order=name"><p><?php echo $webui_user_name ?></p></a></td>
					<td><p><?php echo $webui_info ?></p></td>
				</tr>
				<tr>
				  <td colspan="2"></td>
				</tr>
<?php
$w = 0;
$DbLink->query("SELECT Name FROM " . C_USERS_TBL . $whereclause . " " . $Limit);
while (list($Name) = $DbLink->next_record()){
$w++;
?>
				<tr class="<?php echo ($odd = $w%2 )? "odd":"even" ?>">
					<td><div><p><?php echo $Name ?></p></div></td>
					<td>
						<div>
							<a style="cursor:pointer" onClick="window.open('<?= SYSURL ?>app/agent/?name=<?php echo $Name ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')">
								<p><?php echo $webui_see_profile ?></p>
							</a>
						</div>
					</td>
				</tr>
<?php } ?>
			</table>
		</div>
	</div>
</div>
