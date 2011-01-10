<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
?>
<style type="text/css">
    <!--
    .Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
    .box {font-size: 12px;height: 20; width:120;}
    .style1 {color: #FFFFFF}
    .box1 {font-size: 12px;height: 20;width: 100;}
    .style2 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
    .boxspace {
        font-size: 1px;
        color: #000000;
    }
    -->
</style>
<script>
    <!--
    function Form(theForm)
    {

        if (theForm.logfirstname.value == "")
        {
            alert("Please enter your \"Firstname\" ");
            theForm.logfirstname.focus();
            return (false);
        }
  
        if (theForm.loglastname.value == "")
        {
            alert("Please enter your \"Lastname\" ");
            theForm.loglastname.focus();
            return (false);
        }

        if (theForm.logpassword.value == "")
        {
            alert("Please enter your \"Password\" ");
            theForm.logpassword.focus();
            return (false);
        }

        return (true);
    }
        -->
</script>
<table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
    <?
    $DbLink = new DB;
    $DbLink->query("SELECT id,code,sitename,url,target FROM " . C_PAGE_TBL . " Where active='1' and type='1' and ((display='0') or (display='2')) ORDER BY rank ASC ");
    while (list($siteid, $sitecode, $sitename, $siteurl, $sitetarget) = $DbLink->next_record()) {
    ?>
        <tr>
            <td>
                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"
            <?
            if ($siteurl != "") {
                if (($siteurl != "") & ($sitetarget == '_self')) {
                    if ($_GET[btn] == $siteid) {
                        echo"background=\"images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"images/main/menu_unselected.jpg\"";
                    }

                    echo"onclick=\"document.location.href='$siteurl&btn=$siteid'\"";
                } else {
                    echo"onclick=\"window.open('$siteurl','mywindow','width=400,height=200')\"";
                }
            } else {
                echo"onclick=\"document.location.href='index.php?&page=smodul&id=$siteid&btn=$siteid'\"";
                if (($_GET[page] == 'smodul') && ($_GET[btn] == $siteid)) {
                    echo"background=\"images/main/menu_selected.jpg\"";
                } else {
                    echo"background=\"images/main/menu_unselected.jpg\"";
                }
            }
            ?>
                   >
                <tr>
                    <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
                    <td style="cursor:pointer;font-weight:bold;"><?= $sitename ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <?
            if ($_GET[btn] == $siteid) {
                $DbLink1 = new DB;
                $DbLink1->query("SELECT id,code,sitename,url,target FROM " . C_PAGE_TBL . " Where active='1' and type='2' and ((display='0') or (display='2')) and code='$sitecode' ORDER BY rank ASC ");
                while (list($subsiteid, $subsitecode, $subsitename, $subsiteurl, $subsitetarget) = $DbLink1->next_record()) {
    ?>
                    <tr>
                        <td>
                            <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0"
            <?
                    if ($subsiteurl != "") {
                        if (($subsiteurl != "") & ($subsitetarget == '_self')) {
                            if ($_GET[subbtn] == $subsiteid) {
                                echo"background=\"images/main/submenu_selected.jpg\"";
                            } else {
                                echo"background=\"images/main/submenu_unselected.jpg\"";
                            }

                            echo"onclick=\"document.location.href='$subsiteurl&btn=$siteid&subbtn=$subsiteid'\"";
                        } else {
                            echo"onclick=\"window.open('$subsiteurl','mywindow','width=400,height=200')\"";
                        }
                    } else {
                        echo"onclick=\"document.location.href='index.php?&page=smodul&id=$subsiteid&btn=$siteid&subbtn=$subsiteid'\"";
                        if (($_GET[page] == 'smodul') && ($_GET[subbtn] == $subsiteid)) {
                            echo"background=\"images/main/submenu_selected.jpg\"";
                        } else {
                            echo"background=\"images/main/submenu_unselected.jpg\"";
                        }
                    }
            ?>
                           >
                        <tr>
                            <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
                            <td style="cursor:pointer;font-weight:bold;"><?= $subsitename ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
    <? }
            } ?>
            <tr>
                <td><span class="boxspace">.</span></td>
            </tr>
    <?
        }
    ?>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <td><table width="220" border="0" align="right" cellpadding="0" cellspacing="0" background="images/main/login_user.gif">
                <form action="index.php" method="POST" onSubmit="return Form(this)">
                    <tr>
                        <td class="style2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="boxspace">.</td>
                    </tr>
                    <tr>
                        <td width="296" height="31"><div align="center"><span class="style2">
                                <?
                                if ($_GET[error]) {
                                    echo"<font color=FF00000><b>$_GET[error]</b></font>";
                                }
                                ?>
                            </span></div></td>
                </tr>
                <tr>
                    <td><div align="center"><span class="style1">First Name</span></div></td>
                </tr>
                <tr>
                    <td><div align="center">
                            <input name="logfirstname" type="text" class="box" value="<?= $_POST[logfirstname] ?>" />
                        </div></td>
                </tr>
                <tr>
                    <td><div align="center"><span class="style1">Last Name</span></div></td>
                </tr>
                <tr>
                    <td><div align="center">
                            <input name="loglastname" type="text" class="box" value="<?= $_POST[loglastname] ?>" />
                        </div></td>
                </tr>
                <tr>
                    <td><div align="center"><span class="style1">Password</span></div></td>
                </tr>
                <tr>
                    <td><div align="center">
                            <input type="password" name="logpassword" class="box"/>
                        </div></td>
                </tr>
                <tr>
                    <td><div align="center"><a style="color:#FFFFFF; font-size:13px" href="index.php?page=forgotpass">Forgot my Password</a></div></td>
                </tr>
                <tr>
                    <td><div align="center">
                            <input style="cursor:pointer" type="submit" name="Submit" value="Login" />
                        </div></td>
                </tr>
            </form>
        </table></td>
</table>
