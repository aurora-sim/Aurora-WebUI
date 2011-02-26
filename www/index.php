<?
//Use gzip if it is supported
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler"); else
    ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
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
include("templates/templates.php");

if ($_GET[page] != '') {
    $_SESSION[page] = $_GET[page];
} else {
    $_SESSION[page] = 'home';
}

//LOGIN AUTHENTIFICATION
if ($_POST[Submit] == $webui_login) {

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

if ($_POST[Submit] == $webui_admin_login) {

    $found = array();
    $found[0] = json_encode(array('Method' => 'AdminLogin', 'WebPassword' => md5(WIREDUX_PASSWORD),
                'First' => $_POST[logfirstname], 'Last' => $_POST[loglastname],
                'Password' => $_POST[logpassword]));
    $do_post_request = do_post_request($found);
    $recieved = json_decode($do_post_request);
    $UUIDC = $recieved->{'UUID'};
    if ($recieved->{'Verified'} == "true") {
        //Set both the admin and user ids
        $_SESSION[ADMINID] = $UUIDC;
        $_SESSION[USERID] = $UUIDC;
    } else {
        echo "<script language='javascript'>
		<!--
		alert(\"Sorry, no Admin Account matched\");
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
$DbLink->query("SELECT UserID FROM " . C_GRIDUSER_TBL . " where Online = 'True' AND " .
        "Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND " .
        "Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) " .
        "ORDER BY Login DESC");
$NOWONLINE = 0;
while (list($UUID) = $DbLink->next_record()) {
    // Let's get the user info
    $DbLink2 = new DB;
    $DbLink2->query("SELECT firstname, lastname from " . C_USERS_TBL . " where PrincipalID = '" . $UUID . "'");
    list($firstname, $lastname) = $DbLink2->next_record();
    $DbLink3 = new DB;
    $DbLink3->query("SELECT RegionID from " . C_PRESENCE_TBL . " where UserID = '" . $UUID . "'");
    list($regionUUID) = $DbLink3->next_record();
    $username = $firstname . " " . $lastname;
    // Let's get the region information
    $DbLink3 = new DB;
    $DbLink3->query("SELECT regionName from " . C_REGIONS_TBL . " where RegionUUID = '" . $regionUUID . "'");
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
?>
<!-- *** END OF removed from home.php and add here *** -->



<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
        <link rel="stylesheet" href="<? echo $template_css ?>" type="text/css" />
        <link rel="icon" href="<?=$favicon_image?>" />
        <title>Welcome to <?= SYSNAME ?></title>
        <script src="js/global.js" type="text/javascript"></script>
    </head>

    <body class="webui">
        <div id="container">
            <div id="container2">
                <div id="headerimages">
                    <a href="<?= SYSURL ?>"><h1><span><? SYSNAME ?></span></h1></a>
                </div>
                <div id="header">
                    <div id="gridstatus"><?php include("sites/gridstatus.php"); ?></div>
                    <div id="menubar"><? include("sites/menubar.php"); ?></div>
                    <div id="date">
<?php $date = date("d-m-Y");
$heure = date("H:i");
Print("$webui_before_date $date $webui_after_date $heure"); ?>
                    </div>
                    <div id="translator">
<?php include("languages/translator_page.php"); ?>
                    </div>
                </div><!-- fin de #header -->

                <div id="MainContainer">
                    <div id="sites"><? include("sites.php"); ?></div>
                </div><!-- fin de #mainContent -->
                <div id="footer">
<?php include("sites/footer.php"); ?>
                </div><!-- fin de #footer -->
            </div><!-- fin de #container2 -->
        </div><!-- fin de #container -->
    </body>
</html>
