<?php
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
        if(($_GET[action2] == '$webui_admin_manage_userdelete') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'DeleteUser', 'WebPassword' => md5(WEBUI_PASSWORD),
                    'UserID' => cleanQuery($_GET[user_id])));
            $do_post_request = do_post_request($found);
        }
//DELETE USER END

//BAN USER START
        if(($_GET[action2] == '$webui_admin_manage_userban') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'BanUser', 'WebPassword' => md5(WEBUI_PASSWORD),
                    'UserID' => cleanQuery($_GET[user_id])));
            $do_post_request = do_post_request($found);
        }
//BAN USER END

//UNBAN USER START
        if(($_GET[action2] == '$webui_admin_manage_userunban') and ($_GET[quest] == 'yes')) {
            $found = array();
            $found[0] = json_encode(array('Method' => 'UnBanUser', 'WebPassword' => md5(WEBUI_PASSWORD),
                    'UserID' => cleanQuery($_GET[user_id])));
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
        if($_GET[action] == '$webui_admin_manage_userdelete') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to delete the User $_GET[delusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=delete&quest=yes&uname=$_GET[delusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//DELETE ANSWER
        if(($_GET[action2] == '$webui_admin_manage_userdelete') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully deleted</B>";
            echo "</TD></TR></TABLE>";
        }

// BAN QUESTION
        if($_GET[action] == '$webui_admin_manage_userban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to Ban $_GET[banusr]?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=ban&quest=yes&uname=$_GET[banusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//BAN ANSWER
        if(($_GET[action2] == '$webui_admin_manage_userban') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully banned</B>";
            echo "</TD></TR></TABLE>";
        }

// UNBAN QUESTION
        if($_GET[action] == '$webui_admin_manage_userunban') {

            echo "<TABLE border=1 WIDTH=95% BGCOLOR=#FF0000><TR><TD><center>";
            echo "<FONT COLOR=#FFFFFF><B>Do you want to remove $_GET[unbanusr] from Ban List?</B>&nbsp;&nbsp;&nbsp;&nbsp; <a href='index.php?page=manage&action2=unban&quest=yes&uname=$_GET[unbanusr]&user_id=$_GET[user_id]'><FONT COLOR=#FFFFFF><b>YES</b></font></a><FONT COLOR=#FFFFFF><b> / </b></font><a href='index.php?page=manage'><FONT COLOR=#FFFFFF><b>NO</b></font></a>";
            echo "<br></center></TD></TR></TABLE><br>";
        }
//UNBAN ANSWER
        if(($_GET[action2] == '$webui_admin_manage_userunban') and ($_GET[quest] == 'yes')) {
            echo "<TABLE WIDTH=95% BGCOLOR=#FF0000><TR><TD>";
            echo "<FONT COLOR=#FFFFFF><B>$_GET[uname] successfully removed from Ban List</B>";
            echo "</TD></TR></TABLE>";
        }


        ?>

<div id="content">
    <div id="ContentHeaderLeft"><h5><p><?= SYSNAME ?></p></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><p><? echo $webui_admin_manage; ?></p></h5></div>
      
    <div id="managepanel">

        <div id="info">
            <p><?php echo $webui_admin_manage_info; ?></p>
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
                        <font><p><?= $count ?> <?php echo $webui_users_found; ?></p></font>
                    </td>

                  <td>                   
        
        <div id="region_navigation">
        <table>
            <tr>
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self">
                        <img SRC=images/icons/icon_back_more_<?php if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <img SRC=images/icons/icon_back_one_<?php if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <p><?php echo $webui_navigation_page; ?> <?php echo $LANG_ADMPAYMENT8; ?> <?= round($AStart / $ALimit ,0)+1; ?> <? echo $webui_navigation_of; ?> <?= @round($count / $ALimit,0); ?></p>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <img SRC=images/icons/icon_forward_one_<?php if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                        <img SRC=images/icons/icon_forward_more_<?php if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0">
                    </a>
                </td>
                        
                <td WIDTH="10"></td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=10" target="_self">
                        <img SRC=images/icons/<?php if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10">
                    </a>
                </td>
                        
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=25" target="_self">
                        <img SRC=images/icons/<?php if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25">
                    </a>
                </td>
                
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=50" target="_self">
                        <img SRC=images/icons/<?php if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50">
                    </a>
                </td>
                    
                <td>
                    <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=100" target="_self">
                        <img SRC=images/icons/<?php if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100">
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
    <form action="index.php?<?=$GoPage?>" method="POST">       
        <tr>
            <td>
                <div id="message">
                    <?php echo $webui_admin_manage_username; ?>:
                    <input TYPE="TEXT" NAME="query" SIZE="50" value="<?=$_POST[query]?>">
                    <button id="search_bouton" TYPE="Submit" value="<?php echo $webui_people_search_bouton; ?>"><?php echo $webui_people_search_bouton; ?></button>
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
                  <td width=36></td>
                  <td width=113 align="center"><p><?php echo $webui_admin_manage_edit; ?></p></td>
                  <td width=312 align="center"><p><?php echo $webui_admin_manage_username; ?></p></td>
                  <td width=220 align="center"><p><?php echo $webui_admin_manage_created; ?></p></td>
                  <td width=167 align="center"><p><?php echo $webui_admin_manage_active; ?></p></td>
                  <td width=47></td>
                  </tr>
              </table>
                    
            <?php
                $DbLink3 = new DB; 
                $found = array();
                $found[0] = json_encode(array('Method' => 'FindUsers', 'WebPassword' => md5(WEBUI_PASSWORD),
                                              'UserID' => cleanQuery($_GET[user_id]),
                                              'Start' => cleanQuery($AStart), 
                                              'End' => cleanQuery($ALimit), 
                                              'Query' => cleanQuery($_POST[query])));
            	$do_post_request = do_post_request($found);
                $recieved = json_decode($do_post_request, true);
		$fullUserInfo = (array)$recieved['Users'];
		foreach($fullUserInfo as $userInfo)
		{
		    $user_id = $userInfo['PrincipalID'];
                    $username = $userInfo['UserName'];
                    $created = $userInfo['Created'];
                    $flags = $userInfo['Flags'];
                    $create = date("d.m.Y", $created);
           ?>

            <table>
                <tr class="<? echo ($odd = $w%2 )? "even":"odd" ?>" >
                    <td width=21 align=center>
                        <img src="images/icons/icon_user.png" alt="<? echo $webui_admin_manage_user; ?>" title="<? echo $webui_admin_manage_user; ?>">
                    </td>

                    <td width=91 align="center">
                        <a href="index.php?page=adminedit&userid=<?=$user_id?>">
                            <b><?php echo $webui_admin_manage_edit; ?></b>
                        </a>
                    </td>

                    <td width=243>
                        <b><?php echo $username; ?></b>
                    </td>

                    <td width=173>
                        <b><?php echo $create; ?></b>
                    </td>

                    <td width=100>
                    <b>
                    <?php 
                        if(($flags & 7) == 7) {echo"<font color='#00FF00'>$webui_admin_manage_active</font>";}
                        else if(($flags & 3) == 3) {echo"<font color='#FF0000'>$webui_admin_manage_notconf</font>";}
                        else if($flags & (16 | 32)){echo"<font color='#FF0000'>$webui_admin_manage_banned</font>";}
                        else {echo"<font color='#FF0000'>$webui_admin_manage_inactive</font>";}
                    ?>
                    </b>
                    </td>

                    <td width=21 align=center>
                        <?php if($flags & (16 | 32)) {?>
                        <a href="index.php?<?=$GoPage?>&action=unban&unbanusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/unban.png" alt="<?php echo $webui_admin_manage_userunban; ?>" title="<?php echo $webui_admin_manage_userunban; ?>">
                        </a>

                        <?php } else { ?>

                        <a href="index.php?<?=$GoPage?>&action=ban&banusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/ban.png" alt="<?php echo $webui_admin_manage_userban; ?>" title="<?php echo $webui_admin_manage_userban; ?>">
                        </a>
                        <?php } ?>
                    </td>

                    <td width=21 align=center>
                        <a HREF="index.php?<?=$GoPage?>&action=delete&delusr=<?=$username?>&user_id=<?=$user_id?>">
                            <img src="images/icons/btn_del.png" alt="<?php echo $webui_admin_manage_userdelete; ?>" title="<?php echo $webui_admin_manage_userdelete; ?>">
                        </a>
                    </td>
                </tr>
            </table>
            <?php } ?>
        </div>
    </td>
    </tr>
</table>

</div>
</div>



<!-- </center> -->

<?php }
else {
    echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
} ?>
