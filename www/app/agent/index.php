<style type="text/css">
    <!--
    .styleTitel {font-size: 16px; font-weight: bold; color: #105BA7; font-family: Arial, Helvetica, sans-serif;}
    .styleText {font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #666666;}
    .styleTopTitle {font-size: 20px; font-weight: bold;	font-family: Arial, Helvetica, sans-serif;}
    .styleplace {color: #FFFFFF;font-size: 3px;}
    -->
</style>
<?
include("../../settings/config.php");
include("../../settings/json.php");
include("../../settings/mysql.php");
include("../../languages/translator.php");

if ($_GET[first] && $_GET[last]) {
    $userName = $_GET['first'] . ' ' . $_GET['last'];

    $found = array();
    $found[0] = json_encode(array('Method' => 'GetProfile', 'WebPassword' => md5(WIREDUX_PASSWORD)
                , 'FirstName' => $_GET['first']
                , 'LastName' => $_GET['last']));

    $do_post_requested = do_post_request($found);
    $recieved = json_decode($do_post_requested);

    $profileTXT = $recieved->{'profile'}->{'AboutText'};
    $created = $recieved->{'account'}->{'Created'};
    $UUID = $recieved->{'account'}->{'PrincipalID'};
    $diff = $recieved->{'account'}->{'TimeSinceCreated'};
    $type = $recieved->{'account'}->{'AccountInfo'};
    $partner = $recieved->{'account'}->{'Partner'};
    $date = date("D d M Y - g:i A", $created);
} ?>
<title><?= SYSNAME ?> <? echo $userName ?><? echo $wiredux_users_profile; ?></title>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="2" valign="top"><span class="styleTopTitle">
                <? echo $userName ?><? echo $wiredux_users_profile; ?></span></td>
    </tr>
    <tr>
        <td colspan="2" valign="top"><hr></td>
    </tr>
    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="55%" valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="styleText"><? echo $wiredux_resident_since ?>: <?= $date ?> (<?= $diff ?>)</td>
                    </tr>
                    <tr>
                        <td class="styleText"><? echo $wiredux_account_info ?>: <?= $type ?></td>
                    </tr>
                    <tr>
                        <td class="styleText">&nbsp;</td>
                    </tr>

                    <?
                    if ($partner != '') {
                    ?>
                        <tr>
                            <td class="styleText"><? echo $wiredux_partner; ?>: <? echo $partner ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    <?
                    }
                    ?>

                    <tr>
                        <td><span class="styleText"><u><? echo $wiredux_about_me; ?></u></span></td>
                    </tr>
                    <tr>
                        <td><span class="styleText">
                                <?
                                if ($profileTXT != '') {
                                    echo $profileTXT;
                                } else {
                                    echo $wiredux_no_information_set;
                                }
                                ?>
                            </span></td>
                    </tr>
                </table>
                <br>
                <br>
            </td>
    </table>
    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
        <td width="45%" valign="top"><br>
            <br>
            <table border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                    <td bgcolor="#999999"><div align="center">
                            <table width="256" height="256" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td bgcolor="#FFFFFF" background="info.jpg">&nbsp;</td>
                                </tr>
                            </table>
                        </div></td>
                </tr>
            </table>
        </td>
    </table>
</table>
