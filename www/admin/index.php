<?
session_start();

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

include("../settings/config.php");
include("../settings/mysql.php");

if($_GET[page] != ''){
$_SESSION[page]=$_GET[page];
}else{
$_SESSION[page]='home';
}

$DbLink = new DB;
$DbLink->query("SELECT password FROM ".C_ADMIN_TBL." WHERE password='$_SESSION[ADMINUID]'");
list($admpass) = $DbLink->next_record();
if($admpass){
$ADMINCHECK = $admpass;
}else{
$ADMINCHECK = "454";
}

if($_POST[adminlogin]=="admincheck"){
$pass = $_POST[password];
$passcheck = md5(md5($pass) . ":" );

$DbLink->query("SELECT username,password FROM ".C_ADMIN_TBL." WHERE username='$_POST[username]'");
list($adminname,$adminpass) = $DbLink->next_record();

if($adminpass == $passcheck){
$_SESSION[ADMINID] = $adminpass;
}
}

if($_POST[check]==1){
echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
}

?>
<head>
<link rel="stylesheet" href="<?= SYSURL ?>/css/style.css" type="text/css" />
<link rel="icon" href="<?= SYSURL ?>/images/main/favicon.ico" />
<title>Welcome to <?= SYSNAME ?> Administration</title>

</head>
 
<body class="wiredux">
<div id="container">
  <div id="header">
  
  
<table>
  <tr>
    <td width="25" rowspan="3"></td>
    <td height="0"></td>
    <td width="25" rowspan="3"></td>
  </tr>
  <tr>
    <td><table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" marginwidth="0" marginheight="0">
      <tr>
        <td height="136" colspan="2" bgcolor="#000000"><table border="0" width="100%" cellspacing="0" cellpadding="0" height="132">
            <tr>
              <td width="590" height="139" background="../images/main/header.png"><img src="../images/main/aurora-sim_logo_01.jpg" width="534" height="139"></td>
              <td width="124" background="../images/main/header.png"></td>
              <td background="../images/main/header.png" width="237"></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td width="2%" height="100%" valign="top" background="../images/main/menu_bg.jpg" bgcolor="#CCCCCC">
          <? if($_SESSION[ADMINUID] == $ADMINCHECK){ include("adminmenu.php");} else{include("menulogin.php");	}?>
        </td>
        <td width="98%" height="100%" background="../images/main/background_03.png"><? include("adminsites.php"); ?></td>
      </tr>
    </table></td>
  </tr>


</table>

    <div id="footer">
    <h3><span>Aurora-Sim WiRedux Footer</span></h3>
    <?php include("../sites/footer.php"); ?>

<!-- fin de #footer --></div>

</div></div>
</body>
</html>
