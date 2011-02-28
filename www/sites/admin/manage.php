<?
if($_SESSION[ADMINID]) {
        $GoPage= "page=adminmanage";

        $AnzeigeStart 		= 0;
        $AnzeigeLimit		= 25;

// LINK SELECTOR

        if($_POST[query]) {
            $Link2.="query=$_POST[query]&";
        }

        if(!$AStart) $AStart = $AnzeigeStart;
        if(!$ALimit) $ALimit = $AnzeigeLimit;

        $Limit = "LIMIT $AStart, $ALimit";

//DELETE USER START
        if(($_GET[action2] == 'delete') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'DeleteUser', 'WebPassword' => md5(WIREDUX_PASSWORD),
                    'UserID' => $_GET[user_id]));
            $do_post_request = do_post_request($found);
        }
//DELETE USER END

//BAN USER START
        if(($_GET[action2] == 'ban') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'BanUser', 'WebPassword' => md5(WIREDUX_PASSWORD),
                    'UserID' => $_GET[user_id]));
            $do_post_request = do_post_request($found);
        }
//BAN USER END

//UNBAN USER START
        if(($_GET[action2] == 'unban') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'UnBanUser', 'WebPassword' => md5(WIREDUX_PASSWORD),
                    'UserID' => $_GET[user_id]));
            $do_post_request = do_post_request($found);
        }
//UNBAN USER END

        $DbLink = new DB;
        $DbLink->query("SELECT COUNT(*) FROM ".C_USERS_TBL." ");
        list($count) = $DbLink->next_record();
?>

 <!-- <br><center> -->
        <?
// DELETE QUESTION
        if($_GET[action] == 'delete') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to delete the User $_GET[delusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=delete&quest=yes&uname=$_GET[delusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//DELETE ANSWER
        if(($_GET[action2] == 'delete') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully deleted</B>";
            echo "</TD></TR></TABLE>";
        }

// BAN QUESTION
        if($_GET[action] == 'ban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to Ban $_GET[banusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=ban&quest=yes&uname=$_GET[banusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//BAN ANSWER
        if(($_GET[action2] == 'ban') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully banned</B>";
            echo "</TD></TR></TABLE>";
        }

// UNBAN QUESTION
        if($_GET[action] == 'unban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to remove $_GET[unbanusr] from Ban List?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=unban&quest=yes&uname=$_GET[unbanusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//UNBAN ANSWER
        if(($_GET[action2] == 'unban') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully removed from Ban List</B>";
            echo "</TD></TR></TABLE>";
        }


        ?>

<div id="content">
    <h2><?= SYSNAME ?>: <? echo $webui_admin_manage ?></h2>
  
    <div id="managepanel">

        <div id="info">
            <p><? echo $webui_admin_manage_info; ?></p>
        </div>

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
                        <font><b><?= $count ?> <? echo $webui_users_found ?></b></font>
                    </td>

                  <td>                   
        
        <div id="region_navigation">
        <table>
            <tr>
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self">
                        <IMG SRC=images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <IMG SRC=images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <? echo $webui_navigation_page; ?> <?=$LANG_ADMPAYMENT8?> <?= round($AStart / $ALimit ,0)+1; ?> <? echo $webui_navigation_of; ?> <?= @round($count / $ALimit,0); ?>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <IMG SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <IMG SRC=images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td WIDTH="10"></td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=10" target="_self">
                        <IMG SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=25" target="_self">
                        <IMG SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25">
                    </a>
                </td>
                
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=50" target="_self">
                        <IMG SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50">
                    </a>
                </td>
                    
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=100" target="_self">
                        <IMG SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100">
                    </a>
                </td>
                <td></td>
            </tr>
        </table>
      </div>
    </td>
  </tr>
</table> 
</td></tr>
</table>
</td></tr>
</table>
    

<table>
    <form ACTION="index.php?<?=$GoPage?>" METHOD="POST">       
        <tr>
            <td>
                <div id="message">
                    <? echo $webui_admin_manage_username; ?>:
                    <input TYPE="TEXT" NAME="query" SIZE="50" value="<?=$_POST[query]?>">
                    <input id="search_bouton" TYPE="Submit" value="<? echo $webui_people_search_bouton ?>">
                </div>       
            </td>
        </tr>
    </form>
</table>

<table>
    <tr>
    <td>
        <div>
              <table>
                  <tr>
                  <td WIDTH=36></td>
                  <td WIDTH=113 align="center"><b><? echo $webui_admin_manage_edit; ?></b></td>
                  <td WIDTH=312 align="center"><b><? echo $webui_admin_manage_username; ?></b></td>
                  <td width=220 align="center"><b><? echo $webui_admin_manage_created; ?></b></td>
                  <td width=167 align="center"><b><? echo $webui_admin_manage_active; ?></b></td>
                  <td WIDTH=47></td>
                  </tr>
              </table>
                    
            <?
    						$DbLink3 = new DB; 
                    $found = array();
                		$found[0] = json_encode(array('Method' => 'FindUsers', 'WebPassword' => md5(WIREDUX_PASSWORD),
                      		'UserID' => $_GET[user_id], 'Start' => $AStart, 'End' => $ALimit, 'Query' => $_POST[query]));
            		    $do_post_request = do_post_request($found);
                    $recieved = json_decode($do_post_request);
		    foreach($recieved->{'Users'} as $userInfo) {
		    $user_id = $userInfo->{'PrincipalID'};
                    $username = $userInfo->{'UserName'};
                    $created = $userInfo->{'Created'};
                    $flags = $userInfo->{'UserFlags'};

                    $create = date("d.m.Y", $created);
            ?>

            <table>
                <tr class="<? echo ($odd = $w%2 )? "even":"odd" ?>" >
                    <td width=21 align=center>
                        <img src="images/icons/icon_user.png" alt="<? echo $webui_admin_manage_user; ?>" title="<? echo $webui_admin_manage_user; ?>">
                    </td>

                    <td width=91 align="center">
                        <a href="index.php?page=adminedit&userid=<?=$user_id?>">
                            <b><? echo $webui_admin_manage_edit; ?></b>
                        </a>
                    </td>

                    <td width=243>
                        <b><?=$username?></b>
                    </td>

                    <td width=173>
                        <b><?=$create?></b>
                    </td>

                    <td width=100>
                    <b>
                      <?
                          if(($flags & 7) == 7) {
                              echo"<FONT COLOR=#00FF00><? echo $webui_admin_manage_active; ?></FONT>";
                              }
                          elseif(($flags & 3) == 3) {
                              echo"<FONT COLOR=#FF0000><? echo $webui_admin_manage_notconf; ?></FONT>";
                              }
                         elseif(($flags & 5) == 5) {
                              echo"<FONT COLOR=#FF0000><? echo $webui_admin_manage_banned; ?></FONT>";
                              }
                          else {
                              echo"<FONT COLOR=#FF0000><? echo $webui_admin_manage_inactive; ?></FONT>";
                              }
                      ?>
                    </b>
                    </td>

                    <td width=21 align=center>
                        <? if($active ==5) {?>
                        <a href="index.php?<?=$GoPage?>&action=unban&unbanusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/unban.png" alt="<? echo $webui_admin_manage_userunban; ?>" title="<? echo $webui_admin_manage_userunban; ?>">
                        </a>

                        <? } else { ?>

                        <a href="index.php?<?=$GoPage?>&action=ban&banusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/ban.png" alt="<? echo $webui_admin_manage_userban; ?>" title="<? echo $webui_admin_manage_userban; ?>">
                        </a>
                        <? } ?>
                    </td>

                    <td width=21 align=center>
                        <a HREF="index.php?<?=$GoPage?>&action=delete&delusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/btn_del.png" alt="<? echo $webui_admin_manage_userdelete; ?>" title="<? echo $webui_admin_manage_userdelete; ?>">
                        </a>
                    </td>
                </tr>
            </table>
            <? } ?>
        </div>
    </td>
    </tr>
</table>

</div>
</div>



<!-- </center> -->

    <? }
else {
    echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
}?>
