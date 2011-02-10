<?
$DbLink = new DB;
$DbLink->query("SELECT userdir,griddir,assetdir FROM " . C_ADM_TBL . "");
list($USERDIR, $GRIDDIR, $ASSETDIR) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM " . C_USERS_TBL . "");
list($CHUSR) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM " . C_WIUSR_TBL . "");
list($CHWIUSR) = $DbLink->next_record();

if ($_SESSION[ADMINUID] == $ADMINCHECK) {
?>
    <style type="text/css">
        <!--
        .Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
        .Stil10 {font-size: 12px}
        -->
    </style>
    <table width="245" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="Stil9">
                <table width="90%" align="center" border="0" class="Stil9">
                    <tr>
                        <td style="cursor:pointer;font-weight:bold;"
                    <?
                    if ($_SESSION[page] == 'home') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
                    ?>
                        onclick="document.location.href='index.php?page=home'"
                        ><div align="center">Home</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
                    <?
                    if ($_SESSION[page] == 'settings') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
                    ?>
                        onclick="document.location.href='index.php?page=settings'"
                        ><div align="center">Admin Settings</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
                    <?
                    if ($_SESSION[page] == 'createacc') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
                    ?>
                        onclick="document.location.href='index.php?page=createacc'"
                        ><div align="center">Create Account</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
<?
                    if ($_SESSION[page] == 'manage') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
?>
                        onclick="document.location.href='index.php?page=manage'"
                        ><div align="center">Manage Users</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
<?
                    if ($_SESSION[page] == 'loginscreen') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
?>
                        onclick="document.location.href='index.php?page=loginscreen'"
                        ><div align="center">Loginscreen Manager</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
<?
                    if ($_SESSION[page] == 'changepw') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
?>
                        onclick="document.location.href='index.php?page=changepw'"
                        ><div align="center">Change Admin Pass</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>&nbsp;

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
<?
                    if ($_SESSION[page] == 'regions') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    }
?>
                        onclick="document.location.href='index.php?page=regions'"
                        ><div align="center">List Regions</div></td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>

            <table width="90%" align="center" border="0" class="Stil9">
                <tr>
                    <td style="cursor:pointer;font-weight:bold;"
<?
                    if ($_SESSION[page] == 'logout') {
                        echo"background=\"../images/main/menu_selected.jpg\"";
                    } else {
                        echo"background=\"../images/main/menu_unselected.jpg\"";
                    } ?>
                                            onclick="document.location.href='index.php?page=logout'"
                                            ><div align="center">Logout</div></td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
<? } ?>