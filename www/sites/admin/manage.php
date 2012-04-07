<?php
use Aurora\Addon\WebUI\Configs;
if(isset($_SESSION['ADMINID'])) {

	$GoPage       = 'page=adminmanage';
	$AnzeigeStart = 0;
	$AnzeigeLimit = 25;

// LINK SELECTOR
	if($_POST['query']) {
		$Link2.="query=$_POST[query]&";
	}

	if(!isset($AStart)){
		$AStart = $AnzeigeStart;
	}
	if(!isset($ALimit)){
		$ALimit = $AnzeigeLimit;
	}

	$Limit = "LIMIT $AStart, $ALimit";

	if(isset($_GET['action2'], $_GET['quest'])){

//DELETE USER START
		if($_GET['action2'] == 'delete' && $_GET['quest'] == 'yes'){
			echo '<table style="width:95%;background:#FF0000;"><tr><td><b style="color:#FFFFFF;">',
				$_GET['uname'],(Configs::d()->DeleteUser($_GET['user_id']) ? ' successfully' : ' not'), ' deleted</b>',
			'</td></tr></table>';
		}

//BAN USER START
		else if($_GET['action2'] == 'ban' && $_GET['quest'] == 'yes'){
//BAN ANSWER
			echo '<table style="width:95%;background:#FF0000;"><tr><td><b style="color:#FFFFFF;">',
				$_GET['uname'],(Configs::d()->BanUser($_GET['user_id']) ? ' successfully' : ' not'), ' banned</b>',
			'</td></tr></table>';
		}

//UNBAN USER START
        else if($_GET['action2'] == 'unban' && $_GET['quest'] == 'yes'){
			echo '<table style="width:95%;background:#FF0000;"><tr><td><b style="color:#FFFFFF;">',
				$_GET['uname'],(Configs::d()->UnBanUser($_GET['user_id']) ? ' successfully' : ' not'), ' unbanned</b>',
			'</td></tr></table>';
        }
	}
?>

<?php
	if(isset($_GET['action'])){
// DELETE QUESTION
        if($_GET['action'] == 'delete') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to delete the User $_GET[delusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=adminmanage&action2=delete&quest=yes&uname=$_GET[delusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }

// BAN QUESTION
        else if($_GET['action'] == 'ban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to Ban $_GET[banusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=adminmanage&action2=ban&quest=yes&uname=$_GET[banusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }

// UNBAN QUESTION
        else if($_GET['action'] == 'unban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to remove $_GET[unbanusr] from Ban List?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=adminmanage&action2=unban&quest=yes&uname=$_GET[unbanusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
	}

	$UserSearch = Configs::d()->FindUsers(isset($_POST['query']) ? $_POST['query'] : '', $AStart, $ALimit);
	$count = $UserSearch->count();
?>

<div id="content">
    <div id="ContentHeaderLeft"><h5><p><?php echo SYSNAME ?></p></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><p><?php echo $webui_admin_manage; ?></p></h5></div>
      
    <div id="managepanel">

        <div id="info">
            <p><?php echo $webui_admin_manage_info; ?></p>
        </div>

		<div id="annonce10">
			<table>
				<tr>
					<td colspan="2">
<!--//START LIMIT AND SEARCH ROW -->
						<table>
							<tr>
								<td>
									<table>
										<tr>
											<td>
												<font><p><?php echo $count ?> <?php echo $webui_users_found ?></p></font>
											</td>
											<td>                   
												<div id="region_navigation">
													<table>
														<tr>
															<td>
																<a href="index.php?<?php echo $GoPage?>&<?php echo $Link1?><?php echo $Link2?>AStart=0&amp;ALimit=<?php echo $ALimit?>" target="_self">
																	<img SRC=images/icons/icon_back_more_<?php if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
																</a>
															</td>
															<td>
																<a href="index.php?<?php echo $GoPage?>&<?php echo $Link1?><?php echo $Link2?>AStart=<?php if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?php echo $ALimit?>" target="_self">
																	<img SRC=images/icons/icon_back_one_<?php if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
																</a>
															</td>
															<td>
																<p><?php echo $webui_navigation_page; ?> <?php echo $LANG_ADMPAYMENT8?> <?php echo round($AStart / $ALimit ,0)+1; ?> <?php echo $webui_navigation_of; ?> <?php echo @round($count / $ALimit,0); ?></p>
															</td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
																	<img SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
																</a>
															</td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
																	<img SRC=images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
																</a>
															</td>
															<td WIDTH="10"></td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=10" target="_self">
																	<img SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10">
																</a>
															</td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=25" target="_self">
																	<img SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25">
																</a>
															</td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=50" target="_self">
																	<img SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50">
																</a>
															</td>
															<td>
																<a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=100" target="_self">
																	<img SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100">
																</a>
															</td>
															<td></td>
														</tr>
													</table>
												</div>
											</td>
										</tr>
									</table> 
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<table>
			<form ACTION="index.php?<?php echo $GoPage?>" METHOD="POST">       
				<tr>
					<td>
						<div id="message">
							<?php echo $webui_admin_manage_username; ?>:
							<input TYPE="TEXT" NAME="query" SIZE="50" value="<?php echo $_POST[query]?>">
							<button id="search_bouton" TYPE="Submit" value="<?php echo $webui_people_search_bouton ?>"><?php echo $webui_people_search_bouton ?></button>
						</div>       
					</td>
				</tr>
			</form>
		</table>
		<div id="annonce10">
			<table>
				<thead>
					<tr>
						<td>&nbsp;</td>
						<th width="91" align="center"><p><?php echo $webui_admin_manage_edit; ?></th>
						<th width="243"><?php echo $webui_admin_manage_username; ?></th>
						<th width="173"><?php echo $webui_admin_manage_created; ?></th>
						<th width="100"><?php echo $webui_admin_manage_active; ?></th>
						<td colspan="2">&nbsp;</td>
					</tr>
				</thead>
				<tbody>
<?php
	foreach($UserSearch as $userInfo){
		$user_id = $userInfo->PrincipalID();
		$username = $userInfo->Name();
		$created = $userInfo->Created();
		$flags = $userInfo->UserFlags();
		$create = date("d.m.Y", $created);
?>
					<tr class="<?php echo ($odd = $w%2 )? "even":"odd" ?>" >
						<td width="21" align=center>
							<img src="images/icons/icon_user.png" alt="<?php echo $webui_admin_manage_user; ?>" title="<?php echo $webui_admin_manage_user; ?>">
						</td>
						<td width="91" align="center">
							<a href="index.php?page=adminedit&userid=<?php echo $user_id?>"><b><?php echo $webui_admin_manage_edit; ?></b></a>
						</td>
						<td width="243">
							<b><?php echo $username?></b>
						</td>
						<td width="173">
							<b><?php echo $create?></b>
						</td>
						<td width="100">
							<?php
		if(($flags & 7) == 7){
			echo '<b style="color:#00FF00;">', $webui_admin_manage_active, '</b>';
		}else if(($flags & 3) == 3){
			echo '<b style="color:#FF0000;">', $webui_admin_manage_notconf, '</b>';
		}else if(($flags & 5) == 5){
			echo '<b style="color:#FF0000;">', $webui_admin_manage_banned, '</b>';
		}else{
			echo '<b style="color:#FF0000;">', $webui_admin_manage_inactive, '</b>';
		}
?>

						</td>
						<td width="21" align="enter">
<?php 	if($active ==5) {?>
							<a href="index.php?<?php echo $GoPage ?>&action=unban&unbanusr=<?php echo $username ?>&user_id=<?php echo $user_id ?>">
								<img src="images/icons/unban.png" alt="<?php echo $webui_admin_manage_userunban; ?>" title="<?php echo $webui_admin_manage_userunban; ?>">
							</a>
<?php 	} else { ?>
							<a href="index.php?<?php echo $GoPage?>&action=ban&banusr=<?php echo $username?>&user_id=<?php echo $user_id?>">
								<img src="images/icons/ban.png" alt="<?php echo $webui_admin_manage_userban; ?>" title="<?php echo $webui_admin_manage_userban; ?>">
							</a>
<?php	} ?>
						</td>
						<td width="21" align="center">
							<a HREF="index.php?<?php echo $GoPage?>&action=delete&delusr=<?php echo $username?>&user_id=<?php echo $user_id?>">
								<img src="images/icons/btn_del.png" alt="<?php echo $webui_admin_manage_userdelete; ?>" title="<?php echo $webui_admin_manage_userdelete; ?>">
							</a>
						</td>
					</tr>
<?php
	}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
}else{
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}
?>
