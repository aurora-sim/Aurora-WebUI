<?
//Use gzip if it is supported
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler"); else
    ob_start();
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
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
                                 'Name' => cleanQuery($_POST[logname]),
                                 'Password' => cleanQuery($_POST[logpassword])));
    $do_post_request = do_post_request($found);
    $recieved = json_decode($do_post_request);
    $UUIDC = $recieved->{'UUID'};
    if ($recieved->{'Verified'} == "true") {
        $_SESSION[USERID] = $UUIDC;
        $_SESSION[NAME] = $_POST[logname];
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
                                 'Name' => $_POST[logname],
                                 'Password' => $_POST[logpassword]));
    $do_post_request = do_post_request($found);
    $recieved = json_decode($do_post_request);
    $UUIDC = $recieved->{'UUID'};
    if ($recieved->{'Verified'} == "true") {
        //Set both the admin and user ids
        $_SESSION[ADMINID] = $UUIDC;
        $_SESSION[USERID] = $UUIDC;
        $_SESSION[NAME] = $_POST[logname];
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
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<? echo $template_css ?>" type="text/css" />
    <link rel="shortcut icon" href="<?=$favicon_image?>" />
    <title><? echo $webui_welcome; ?> <?= SYSNAME ?></title>
    
    <script src="javascripts/global.js" type="text/javascript"></script>
    <script src="javascripts/droppanel/dropdown.js" type="text/javascript"></script>
    
    <script src="javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery/slidepanel.js" type="text/javascript"></script>
    
    <script src="javascripts/jquery/jquery.Scroller-1.0.min.js" type="text/javascript"></script> 
    <script src="javascripts/jquery/divscroller.js" type="text/javascript"></script>
 

    <?php if($showRoundedCorner)
    { ?>
    
    

<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.corner.js?v2.11"></script>
<script type="text/javascript">
// http://jquery.malsup.com/corner/
// test auto-ready logic - call corner before DOM is ready
    $('#annonce1, #annonce2, #annonce3, #annonce4, #annonce10').corner();
    
    $('#ContentHeaderLeft, #ContentHeaderCenter, #ContentHeaderRight').corner("5px");
    $(function(){
		$('#dynCorner').click(function() {
			$('#dynamic').corner();
		});
		$('#dynUncorner').click(function() {
			$('#dynamic').uncorner();
		});
	
        $('div.inner').wrap('<div class="outer"></div>');
        $('pre').wrap("<code></code>");
 
        $('div.inner').each(function() {
            var t = $('p', this).text();
            eval(t);
        });
 
        // fixed/fluid tests
        $("div.box, div.plain").corner();
        $("#abs").corner("cc:#08e");
	
		$('#container, #region_map').corner();
		$('#login, #register, #forget_pass').corner("5px");
		$('.menu').corner();
		$('.chat').corner();
    });
</script>
   <?php } ?>
</head>
    
<body class="webui">
  
<div class="absolute">
  <!-- Top Panel Slider -->
  <? if($displayTopPanelSlider) {include("sites/modules/slidepanel.php");} ?>
</div>

<div class="maintenance">
  <!-- If we are supposed to only display the maintenance page currently, do so now -->
  <? if($displayMaintenancePage) {include("sites/Maintenance.php"); return;} ?>

  <!--[if lt IE 8]>
    <div id="alert"><p>Hummm, You should upgrade your copy of Internet Explorer.</p></div>
  <![endif]-->
</div>

<div id="topcontainer">
    <!--<div id="date">
     <?php /*$date = date("d-m-Y");
    $heure = date("H:i");
    Print("$webui_before_date $date $webui_after_date $heure");*/
    ?> -->
    <!-- </div>-->
    <div id="translator">
        <?php include("languages/translator_page.php"); ?>
    </div>

    <?php if($showWelcomeMessage)
    { ?>
    <div id="welcomeText">
        <?php
          if($_SESSION[NAME] != "") {
            echo $webui_welcome_back." ";
            echo $_SESSION[NAME];
          }
          
          else {
            echo $webui_welcome." ";
            echo SYSNAME." ";
            echo $webui_welcome_visitor;
          } ?>
    </div>
    <?php } ?>

</div><!-- fin de #topcontainer <div id="menubar"><? // include("sites/modules/marquee.php"); ?></div> -->

<div id="container">
    <div id="header">
        <div id="headerimages">
            <a href="<?= SYSURL ?>"><h1><span><? SYSNAME ?></span></h1></a>
        </div>
        <!-- <div id="gridstatus"><? //php include("sites/gridstatus.php"); ?></div> -->
        <div id="menubar"><? include("sites/menubar.php"); ?></div>
        <div id="home_content_right"><? include("sites/modules/slideshow.php"); ?></div>
    </div><!-- fin de #header -->

    <div id="MainContainer">
        <div id="sites"><? include("sites.php"); ?></div>
    </div><!-- fin de #mainContent -->
</div><!-- fin de #container -->

<div id="footer">
    <?php include("sites/footer.php"); ?>
</div><!-- fin de #footer -->

</body>
</html>
