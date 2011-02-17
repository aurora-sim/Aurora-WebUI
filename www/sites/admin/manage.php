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

<BR><CENTER>
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
    <TABLE WIDTH=95% CELLPADDING=3 CELLSPACING=0 BGCOLOR=#999999>
        <TR><TD style="filter:progid:DXImageTransform.Microsoft.Gradient(startColorStr='#CC0000', endColorStr='#FFFFFF', gradientType='1')">

                    <?
                    echo "<TABLE CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD>"
                            ."<FONT COLOR=#FFFFFF><B>Admin User Management Panel - $count Users found</B></FONT></TD><TD ALIGN=right>";

// ################################## Navigation ###################################### 	

                    ?>

                <TABLE CELLPADDING=1 CELLSPACING=0><TR>
                        <TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD WIDTH=100 ALIGN=center>
                            <FONT COLOR="#000000"><?=$LANG_ADMPAYMENT8?> <?= round($AStart / $ALimit ,0)+1; ?> <!--von <?= @round($count / $ALimit,0); ?>--></FONT></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=../images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD WIDTH="10"></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=10" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10"></a></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=25" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25"></a></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=50" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50"></a></TD><TD>
                            <a href="index.php?<?=$GoPage?>&<?=$Link1?><?=$Link2?>AStart=0&ALimit=100" target="_self"><IMG SRC=../images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100"></a></TD><TD>
                        </TD></TR></TABLE>
            </TD></TR></TABLE><BR>

    <TABLE WIDTH="95%" CELLPADDING="3" CELLSPACING="1" BGCOLOR="#547FDB">
        <FORM ACTION="index.php?<?=$GoPage?>" METHOD="POST">
            <TR>
                <TD>
                    <B>User Search</B><BR>
                </TD></TR><TR><TD BGCOLOR="#FFFFFF">


                    <TABLE CELLPADDING="0" CELLSPACING="0" WIDTH="100%" BGCOLOR="#FFFFFF">
          <TR>
                            <TD width="9%">
                                <FONT COLOR="#000000">User Name</FONT>                            </TD>
<TD width="84%" align="right">
              <INPUT TYPE="TEXT" NAME="query" SIZE="50" value="<?=$_POST[query]?>" STYLE="HEIGHT:20">              </TD>
<TD width="7%">
                <INPUT TYPE="Submit" value="Search" STYLE="HEIGHT:20">
                </TD>
                      </TR></TABLE>
                </TD></TR>
        </FORM>
    </TABLE>
    <TABLE CELLPADDING="5" CELLSPACING="0" border="0" WIDTH="95%" Height="70%" BGCOLOR="#FFFFFF">
        <TD VALIGN="top">
                <div style="position:relative;height:100%;">

                    <TABLE CELLPADDING=0 CELLSPACING=1 border=0 WIDTH=100% BGCOLOR=#305AB1>
                        <TR>
                            <TD BGCOLOR=#547FDB>
                                <TABLE CELLPADDING=2 CELLSPACING=0 border=0 WIDTH=100%>
                                    <TR>
                                        <TD WIDTH=36></TD>
                                        <TD WIDTH=113 align="center"><B>EDIT</B></TD>
                                        <TD WIDTH=312 align="center"><B>User Name</B></TD>
                                        <TD width=220 align="center"><B>Created</B></TD>
                                        <TD width=167 align="center"><B>Active</B></TD>
                                        <TD WIDTH=47></TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                    <IMG SRC="../images/icons/dot.gif" WIDTH=1 HEIGHT=2><BR>
                        <?
						$DbLink3 = new DB; 
            			$found = array();
            			$found[0] = json_encode(array('Method' => 'FindUsers', 'WebPassword' => md5(WIREDUX_PASSWORD),
                    		'UserID' => $_GET[user_id], 'Start' => $AStart, 'End' => $ALimit, 'Query' => $_GET[query]));
            			$do_post_request = do_post_request($found);
                        $recieved = json_decode($do_post_request);
						
                        //$DbLink1 = new DB;
                        //$DbLink1->query("SELECT PrincipalID,FirstName,LastName,Created FROM ".C_USERS_TBL." $USR $USR_1 $USR_2 $USR_3 ORDER by created ASC $Limit ");
                        while(list($userInfo) = $recieved->{'Users'}) {

							// ------------------------------------
							// ERRORING HERE user is null right now
							// Commented out below so it would at least render
							// ------------------------------------
							
                            //$user_id = userInfo->{'PrincipalID'};
                            //$username = userInfo->{'UserName'};
                            //$created = userInfo->{'Created'};
                            //$flags = userInfo->{'UserFlags'};

                            //$create = date("d.m.Y", $created);
                            ?>
                    <TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0 BORDER=0>
                        <TR>
                            <TD width=32><img src="../images/icons/icon_user.gif"></TD>
                            <TD width=91 align="center">
                                <a href="index.php?page=edit&userid=<?=$user_id?>">
                                    <font color=Blue><B>EDIT</B></FONT></a></TD>
                          <TD width=243><font color=Blue><B><?=$username?></b></font></TD>
                            <TD width=173><font color=#888888><B><?=$create?></b></font></TD>
                            <TD width=100><B>
                                            <?
                                            if(($flags & 7) == 7) {
                                                echo"<FONT COLOR=#00FF00>Active</FONT>";
                                            }elseif(($flags & 3) == 3) {
                                                echo"<FONT COLOR=#FF0000>Not Confirmed</FONT>";
                                            }elseif(($flags & 5) == 5) {
                                                echo"<FONT COLOR=#FF0000>Banned</FONT>";
                                            }else {
                                                echo"<FONT COLOR=#FF0000>Inactive</FONT>";
                                            } ?>
                                </B></TD>
                            <TD width=32>
                                        <? if($active ==5) {?>
                                <a href="index.php?<?=$GoPage?>&action=unban&unbanusr=<?=$username?>&user_id=<?=$user_id?>">
                                    <img src="../images/icons/unban.jpg" alt="Unban this User" border="0" /></a>
                                            <? } else { ?>
                                <a href="index.php?<?=$GoPage?>&action=ban&banusr=<?=$username?>&user_id=<?=$user_id?>">
                                    <img src="../images/icons/ban.jpg" alt="Ban this User" border="0" /></a>
                                            <? } ?></TD>
                            <TD WIDTH=39 ALIGN=right>
                                <a HREF="index.php?<?=$GoPage?>&action=delete&delusr=<?=$username?>&user_id=<?=$user_id?>">
                                    <img src="../images/icons/btn_del.gif" alt="Delete User" BORDER="0"></a></TD>
                        </TR>
                    </TABLE>
					<? } ?>
                </div>
            </TD>
    </TABLE>
</CENTER>
    <? }
else {
    echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
}?>