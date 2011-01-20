<?
session_start();

/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

include("settings/config.php");
include("settings/json.php");
include("settings/mysql.php");
include("check.php");
include("languages/translator.php");
include("skins/skins.php");

if ($_GET[page] != '') {
    $_SESSION[page] = $_GET[page];
} else {
    $_SESSION[page] = 'home';
}

//LOGIN AUTHENTIFICATION
if ($_POST[Submit] == "Login") {

    $found = array();
    $found[0] = json_encode(array('Method' => 'Login', 'WebPassword' => md5(WIREDUX_PASSWORD),
                'First' => $_POST[logfirstname], 'Last' => $_POST[loglastname],
                'Password' => $_POST[logpassword]));
    $do_post_request = do_post_request($found);
    $recieved = json_decode($do_post_request);
    $UUIDC = $recieved->{'UUID'};
    if ($recieved->{'Verified'} == "true") {
        $_SESSION[USERID] = $UUIDC;
    } else {
        echo "<script language='javascript'>
		<!--
		alert(\"Sorry, no Account matched\");
		// -->
		</script>";
    }
}

//LOGIN END
?>


<!-- *** removed from home.php and add here *** -->
<?
$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM " . C_INFOWINDOW_TBL . " ");
list($GRIDSTATUS, $INFOBOX, $BOXCOLOR, $BOX_TITLE, $BOX_INFOTEXT) = $DbLink->next_record();

// Doing it the same as the Who's Online now part
$DbLink = new DB;
$DbLink->query("SELECT UserID FROM " . C_GRIDUSER_TBL . " where Online = 1 AND " .
        "Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND " .
        "Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) " .
        "ORDER BY Login DESC");
while (list($UUID) = $DbLink->next_record()) {
    // Let's get the user info
    $DbLink2 = new DB;
    $DbLink2->query("SELECT username, lastname from " . C_USERS_TBL . " where UUID = '" . $UUID . "'");
    list($firstname, $lastname) = $DbLink2->next_record();
    $DbLink3 = new DB;
    $DbLink3->query("SELECT RegionID from " . C_PRESENCE_TBL . " where UserID = '" . $UUID . "'");
    list($regionUUID) = $DbLink3->next_record();
    $username = $firstname . " " . $lastname;
    // Let's get the region information
    $DbLink3 = new DB;
    $DbLink3->query("SELECT regionName from " . C_REGIONS_TBL . " where UUID = '" . $regionUUID . "'");
    list($region) = $DbLink3->next_record();
    if ($region != "") {
        $NOWONLINE = $NOWONLINE + 1;
    }
}

$DbLink->query("SELECT count(*) FROM " . C_GRIDUSER_TBL . " where Login > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
list($LASTMONTHONLINE) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM " . C_USERS_TBL . "");
list($USERCOUNT) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM " . C_REGIONS_TBL . "");
list($REGIONSCOUNT) = $DbLink->next_record();

if (($_GET[btn] == "") and ($ERROR == "")) {
    echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home&btn=1';
// -->
</script>";
} else if (($_GET[btn] == "") and ($ERROR != "")) {
    echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home&btn=1&error=$ERROR';
// -->
</script>";
}
?>
<!-- *** END OF removed from home.php and add here *** -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="<? echo $skin_css ?>" type="text/css" />
        <link rel="icon" href="/images/main/favicon.ico" />
        <title>Welcome to <?= SYSNAME ?></title>
    </head>
    <body class="wiredux">
        <div id="container">
            <div id="header">
                <h1><span><? SYSNAME ?> Grid Status</span></h1>

                <div id="gridstatus"><?php include("sites/gridstatus.php"); ?></div>
                <div id="menubar"><? include("sites/menubar.php"); ?></div>
                <div id="translator"><?php include("languages/translator_page.php"); ?></div>
                <!-- fin de #header --></div>

            <div id="MainContainer">
                <div id="sites"><? include("sites.php"); ?></div>
                <!-- fin de #mainContent --></div>

            <div id="footer">
                <h3><span>Aurora-Sim WiRedux Footer</span></h3>
<?php include("sites/footer.php"); ?>

                <!-- fin de #footer --></div>
            <!-- fin de #container --></div>
    </body>
</html>
