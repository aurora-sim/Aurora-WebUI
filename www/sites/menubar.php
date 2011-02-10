<?php
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
?>

<table width="100%" border="0" style="border-bottom: transparent 1px solid; border-top: transparent 1px solid" align="center" cellpadding="0" cellspacing="0">
    <?
    $DbLink = new DB;
    if ($_SESSION[USERID])
        $Display = 1;
    else
        $Display = 0;
    
    if($_SESSION[ADMINID])
        $AdminDisplay = " or (display='3')";
    else
        $AdminDisplay = "";

    $DbLink->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
    $tableWidth = 1000 / $DbLink->num_rows();
    $a = get_defined_vars();
    if($_GET[btn] == "")
        $_GET[btn] = "wiredux_menu_item_home";
    while (list($siteid, $siteurl, $sitetarget) = $DbLink->next_record()) {
    ?>
        <td>
            <table width="<? echo $tableWidth ?>" border="0" align="center" cellpadding="0" cellspacing="0"
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
        ?> >
            <td width="20"></td>
            <td style="cursor:pointer;font-weight:bold;font-variant: small-caps;font-size: 0.9em;"> <?= ($a[$siteid]); ?></td>
        </table>
    </td>
    <?
           }
    ?>
</table>
