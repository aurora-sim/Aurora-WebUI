<?php
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
?>
<style type="text/css">
    <!--
    .Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
    .box {font-size: 12px;height: 25; width:120;}
    .style1 {color: #FFFFFF}
    .box1 {font-size: 12px;height: 25;width: 100;}
    .style2 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
    .boxspace {
        font-size: 1px;
        color: #000000;
    }
    -->
</style>
<table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
    <?
    $DbLink = new DB;
    if ($_SESSION[USERID])
        $Display = 1;
    else
        $Display = 0;
    $DbLink->query("SELECT id,code,sitename,url,target FROM " . C_PAGE_TBL . " Where active='1' and type='1' and ((display='$Display') or (display='2')) ORDER BY rank ASC ");
    $tableWidth = 1520 / $DbLink->num_rows();
    while (list($siteid, $sitecode, $sitename, $siteurl, $sitetarget) = $DbLink->next_record()) {
    ?>
        <td>
            <table width="<? echo $tableWidth ?>" border="0" align="center" cellpadding="0" cellspacing="0"
        <?
        //This adds the selected image to the table, as well as the link to the page that the
        //  button goes to. Having the page have '_self' as the target makes the page appear
        //  in the same page as the current, otherwise, a popup will come up.
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
        ?> >
            <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
            <td style="cursor:pointer;font-weight:bold;"><?= $sitename ?></td>
        </table>
    </td>
    <?
           }
    ?>
</table>
