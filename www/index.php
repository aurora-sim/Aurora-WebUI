<?
session_start();

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

include("settings/config.php");
include("settings/mysql.php");
include("check.php");

if ($_GET[page] != '') {
    $_SESSION[page] = $_GET[page];
} else {
    $_SESSION[page] = 'home';
}

//LOGIN AUTHENTIFICATION
if ($_POST[Submit] == "Login") {

    $found = array();
    $found[0] = json_encode(array('Method' => 'Login', 'WebPassword' => WIREDUX_PASSWORD,
        'First' => $_POST[logfirstname], 'Last' => $_POST[loglastname],
        'Password' => $_POST[logpassword]));
    $do_post_request = do_post_request($found);
    $recieved = json_decode($do_post_request);
    echo $recieved->{'Verified'};
    echo $recieved->{'UUID'};
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
function do_post_request($found)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => implode(',', $found)
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen(WIREDUX_SERVICE_URL, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with " . WIREDUX_SERVICE_URL . ", $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from " . WIREDUX_SERVICE_URL . ", $php_errormsg");
  }
  return $response;
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Welcome to <?= SYSNAME ?></title>
    <style type="text/css">
        <!--
        .Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
        body {
            background-image: url(images/main/bg.jpg);
        }
        -->
    </style>
</head>

<body>
    <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" marginheight="0" marginwidth="0">
        <tr>
            <td width="25" rowspan="3">&nbsp;</td>
            <td height="0"></td>
            <td width="25" rowspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>

                <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" marginwidth="0" marginheight="0">
                    <tr>
                        <td height="136" colspan="2" bgcolor="#000000">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" height="132">
                                <tr>
                                    <td width="590" height="139" background="images/main/header.jpg"><img src="images/main/logo.gif" width="534" height="139"></td>
                                    <td width="124" background="images/main/header.jpg">&nbsp;</td>
                                    <td background="images/main/header.jpg" width="237">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="145" height="100%" valign="top" background="images/main/menu_bg.jpg" bgcolor="#CCCCCC">
<?
if ($_SESSION[USERID]) {
    include("loggedinmenu.php");
} else {
    include("menu.php");
}
?>
                        </td>
                        <td width="100%" height="100%" background="images/main/page_bg.jpg"><? include("sites.php"); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height="25" bgcolor="#000000" align="right">
                <table border="0" width="100%" cellspacing="0" cellpadding="0" height="25">
                    <tr>
                        <td background="images/main/footer.jpg">&nbsp;</td>
                        <td background="images/main/footer.jpg">&nbsp;</td>
                    </tr>
                </table>
            <td>
        </tr>
    </table>
</body>
</html>