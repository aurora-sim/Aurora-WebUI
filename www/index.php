<?php
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

//Use gzip if it is supported
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
    ob_start("ob_gzhandler");
}else{
	ob_start();
}

// Page Load Time
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$start = $time;


if(!file_exists('settings/config.php') || !file_exists('settings/databaseinfo.php')){
	die('Configuration not present.');
}
require_once("settings/config.php");
require_once("settings/webui_bootstrap.php");
require_once("settings/databaseinfo.php");
require_once("languages/translator.php");
require_once("templates/templates.php");
require_once('settings/AuroraWebUI.php');
use Aurora\Addon\WebAPI\Configs;

define('WEBUI_PAGE', isset($_GET['page']) ? $_GET['page'] : 'home');

$adminmodules                    = AuroraWebUI\admin_modules();
$id                              = $adminmodules['id'];
$displayTopPanelSlider           = $adminmodules['displayTopPanelSlider'];
$displayTemplateSelector         = $adminmodules['displayTemplateSelector'];
$displayStyleSwitcher            = $adminmodules['displayStyleSwitcher'];
$displayStyleSizer               = $adminmodules['displayStyleSizer'];
$displayFontSizer                = $adminmodules['displayFontSizer'];
$displayLanguageSelector         = $adminmodules['displayLanguageSelector'];
$displayScrollingText            = $adminmodules['displayScrollingText'];
$displayWelcomeMessage           = $adminmodules['displayWelcomeMessage'];
$displayLogo                     = $adminmodules['displayLogo'];
$displayLogoEffect               = $adminmodules['displayLogoEffect'];
$displaySlideShow                = $adminmodules['displaySlideShow'];
$displayMegaMenu                 = $adminmodules['displayMegaMenu'];
$displayDate                     = $adminmodules['displayDate'];
$displayTime                     = $adminmodules['displayTime'];
$displayRoundedCorner            = $adminmodules['displayRoundedCorner'];
$displayBackgroundColorAnimation = $adminmodules['displayBackgroundColorAnimation'];
$displayPageLoadTime             = $adminmodules['displayPageLoadTime'];
$displayW3c                      = $adminmodules['displayW3c'];
$displayRss                      = $adminmodules['displayRss'];


$lang = '';
if(!empty($_GET['lang'])){
	$lang = $_GET['lang'];
}else if(!empty($_COOKIE['lang'])){
	$lang = $_COOKIE['lang'];
}

$lang = preg_replace('/[^A-z]/', '', $lang);
$lang = empty($lang) ? 'en' : $lang;

echo
	'<!doctype html>',"\n",
	sprintf('<html lang=%s class="no-js">', $lang), "\n",
	'<head>'
;

//LOGIN AUTHENTIFICATION
session_start();
if($_POST['Submit'] == $webui_login || $_POST['Submit'] == $webui_admin_login){
	$login = false;
	if($_POST['Submit'] == $webui_login){
		try{
			$login = Configs::d()->Login($_POST['logname'], $_POST['logpassword']);
		}catch(Aurora\Addon\InvalidArgumentException $e){
		}
		if($login instanceof Aurora\Addon\WebUI\genUser){
			$_SESSION['FIRSTNAME']   = $login->FirstName();
			$_SESSION['LASTNAME']    = $login->LastName();
			$_SESSION['WEBLOGINKEY'] = Configs::d()->SetWebLoginKey($login->PrincipalID());
		}
	}else{
		try{
			$login = Configs::d()->AdminLogin($_POST['logname'], $_POST['logpassword']);
		}catch(Aurora\Addon\InvalidArgumentException $e){
		}
		if($login instanceof Aurora\Addon\WebUI\genUser){
			$_SESSION['ADMINID'] = $login->PrincipalID();
		}
	}

	if($login instanceof Aurora\Addon\WebUI\genUser){
		$_SESSION['USERID'] = $login->PrincipalID();
		$_SESSION['NAME']   = $login->Name();
	}else{
		echo
			'<script>',"\n",
			'<!--',"\n",
			'alert("Sorry, no ', ($_POST['Submit'] == $webui_admin_login ? 'Admin ' : ''), 'Account matched");',"\n",
			'// -->',"\n",
			'</script>'
		;
    }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $webui_welcome, ' ', SYSNAME; ?></title>

<link rel="stylesheet" href="templates/no_js.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $template_css ?>" type="text/css" />
<link rel="shortcut icon" href="<?php echo $favicon_image?>" />

<script src="javascripts/modernizr-1.7.min.js" type="text/javascript"></script>
<script src="javascripts/global.js" type="text/javascript"></script>

<script src="javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script src="javascripts/jquery/slidepanel.js" type="text/javascript"></script>

<script src="javascripts/jquery/jquery.Scroller-1.0.min.js" type="text/javascript"></script>
<script src="javascripts/jquery/divscroller.js" type="text/javascript"></script>

<script type="text/javascript" src="javascripts/calendar-2.2.js"></script>
<?php if($displayRoundedCorner)  { ?>
<script type="text/javascript" src="<?php echo SYSURL; ?>javascripts/jquery/jquery.corner.js?v2.11"></script>
<?php } ?>
<?php if($displayMegaMenu) { ?>
<!-- start megamenu -->
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/black.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/grey.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/green.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/light_blue.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/orange.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/red.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/skins/white.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SYSURL ?>templates/jec-styled.css" rel="stylesheet" type="text/css" />
<?php if($template == 'default')  { ?>
<link href="<?php echo SYSURL; ?>sites/menus/megamenu/css/megamenu_default.css" rel="stylesheet" type="text/css" />
<?php }else if($template == 'white')  { ?>
<link href="<?php echo SYSURL; ?>sites/menus/megamenu/css/megamenu_white.css" rel="stylesheet" type="text/css" />
<?php }else if($template == 'astra')  { ?>
<link href="<?php echo SYSURL; ?>sites/menus/megamenu/css/megamenu_astra.css" rel="stylesheet" type="text/css" />
<?php } ?>
<script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.hoverIntent.minified.js'></script>
<?php if($MegaMenuVersion == '1.2')  { ?>
<script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.2.js'></script>
<?php }else if($MegaMenuVersion == '1.3.2')  { ?>
<script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.3.2.js'></script>
<?php } ?>
<script type="text/javascript">
var
	megaMenuConfig = <?php echo json_encode(array(
		'#mega-menu-1' => array(
			'rowItems' => $MegaMenuRowItems,
			'speed'    => $MegaMenuSpeed,
			'effect'   => $MegaMenuEffect,
			'event'    => $MegaMenuEvent
		),
		'#mega-menu-2' => array(
			'rowItems' => $MegaMenuRowItems,
			'speed'    => $MegaMenuSpeed,
			'effect'   => $MegaMenuEffect,
			'event'    => $MegaMenuEvent
		)
	)); ?>
;
</script>
<script type="text/javascript" src="<?php echo SYSURL; ?>sites/menus/megamenu/javascripts/config.js"></script>
<?php	if($MegaMenuPreset == 1 && $displayRoundedCorner){ ?>
<script type="text/javascript">
$('.mega-menu, #mega-menu-1, #mega-menu-1 li a').corner();
</script>
<?php	} ?>
<!-- end megamenu -->
<?php } ?>

<?php if($displayLogoEffect) { ?>
<script type="text/javascript">
//<![CDATA[
var Header = {
	// Let's write in JSON to make it more modular
	addFade : function(selector){
		$("<span class=\"fake-hover\"></span>").css("display", "none").prependTo($(selector));
		// Safari dislikes hide() for some reason
		$(selector+" a").bind("mouseenter",function(){
			$(selector+" .fake-hover").fadeIn("slow");
		});
		$(selector+" a").bind("mouseleave",function(){
			$(selector+" .fake-hover").fadeOut("slow");
		});
	}
};
$(function(){Header.addFade("#headerimages");});
//]]>
<?php } ?>
</script>

<?php if($displayRoundedCorner)  { ?>
<script type="text/javascript">
// http://jquery.malsup.com/corner/
// Add more class here ...
$(document).ready(function(){
	$([
		'#annonce1, #annonce2, #annonce3, #annonce4, #annonce5, #annonce6, #annonce7, #annonce10',
		'#info1, #info2, #info3, #info4, #info5, #info6, #info7, #info10',
		'#aide1, #aide2, #aide3, #aide4, #aide5, #aide6, #aide7, #aide10',
		'#step1, #step2, #step3, #step4, #step5, #step6, #step7, #step10',
		'#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5',
		'.news_time, .news_title, .news_content, #news_online',
		'#container,#header,#content',
		'#region_map',
		'.menu',
		'#chat',
		'#download1, #download2, #download3, #download1 a, #download2 a, #download3 a', // Download Page
		'#addgrid01, #addgrid02, #addgrid03, #addgrid04, #addgrid05, #addgrid06, #addgrid07, #addgrid08, #addgrid09, #addgrid10, #addgrid h3 a', // AddGrid Page
		'#island1, #island2, #island3, #island4, #island5', // StarDust Currency Pages
		'#island_picture1,#island_picture2,#island_picture3,#island_picture4,#island_picture5', // StarDust Currency Pages
		'#island_info_part1, #island_info_part2, #island_info_part3, #island_info_part4, #island_info_part5', // StarDust Currency Pages
//		'#CurrencyHistory' // StarDust Currency Pages
	].join(', ')).corner();
	$([
		'#ContentHeaderLeft, #ContentHeaderCenter, #ContentHeaderRight',
		'#translator, #welcomeText',
		'#login, #register, #forget_pass',
	].join(', ')).corner('5px');
	$([
		'button, .roundedinput, .forgot_pass_bouton, .adminsettings_bouton',
		'#roundedcoord',
		'#info_loginscreen_button'
	].join(', ')).corner('10px');

	$('#dynCorner').click(function(){
		$('#dynamic').corner();
	});
	$('#dynUncorner').click(function() {
		$('#dynamic').uncorner();
	});
});
</script>
<?php } ?>

<?php if($displayBackgroundColorAnimation)  { ?>
<!-- include Google's AJAX API loader -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var
		bgColorConfig = <?php echo json_encode(array(
			array(
				'hover'    => $BackgroundColorHoverStep1,
				'end'      => $BackgroundColorEndStep1,
				'selector' => implode(', ', array(
					'#annonce1',
					'#step1',
					'#info1',

					#region Page Downloads

					'#download1',
					'#download2',
					'#download3',

					#endregion

					#region Page News

					'.news_time',
					'.news_title',
					'.news_content',

					#endregion

					#region Grid Status Module

					'#gridstatus1',
					'#gridstatus2',
					'#gridstatus3',
					'#gridstatus4',
					'#gridstatus5',

					#endregion

					#region AddGrid Page

					'#addgrid01',
					'#addgrid02',
					'#addgrid03',
					'#addgrid04',
					'#addgrid05',
					'#addgrid06',
					'#addgrid07',
					'#addgrid08',
					'#addgrid09',
					'#addgrid10',

					#endregion


				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep2,
				'end'      => $BackgroundColorEndStep2,
				'selector' => implode(', ', array(
					'#annonce2',
					'#step2',
					'#info2'
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep3,
				'end'      => $BackgroundColorEndStep3,
				'selector' => implode(', ', array(
					'#annonce3',
					'#step3',
					'#info3'
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep4,
				'end'      => $BackgroundColorEndStep4,
				'selector' => implode(', ', array(
					'#annonce4',
					'#aide1',
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep5,
				'end'      => $BackgroundColorEndStep5,
				'selector' => implode(', ', array(
					'#annonce5',
					'#aide2',
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep6,
				'end'      => $BackgroundColorEndStep6,
				'selector' => implode(', ', array(
					'#annonce6',
					'#aide3',
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep7,
				'end'      => $BackgroundColorEndStep7,
				'selector' => implode(', ', array(
					'#annonce7',
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStep10,
				'end'      => $BackgroundColorEndStep10,
				'selector' => implode(', ', array(
					'#annonce10',
				)),
			),
			array(
				'hover'    => $BackgroundColorHoverStepMegaMenu1,
				'end'      => $BackgroundColorEndStepMegaMenu1,
				'selector' => implode(', ', array(
					'#mega-menu-1 a',
				))
			),
			array(
				'hover'    => $BackgroundColorHoverStepLoginBouton1,
				'end'      => $BackgroundColorEndStepLoginBouton1,
				'selector' => implode(', ', array(
					'#register_bouton',
					'#login_bouton',
					'#forgot_pass_bouton',
					'#adminlogin_button',
					'#create_news_button',
					'#edit_news_item_button',
					'#info_loginscreen_button',

					#region Page Downloads

					'#download1 a',
					'#download2 a',
					'#download3 a',

					#endregion

					#region AddGrid Page

					'#addgrid h3 a',

					#endregion

					#region Stardust Module

					'#island_input_button1',
					'#island_input_button2',
					'#island_input_button3',
					'#island_input_button4',
					'#island_input_button5',
					'#get_it_now_button',

					#endregion
				))
			),
			array(
				'hover'    => $BackgroundColorHoverStepAdminSettingBouton1,
				'end'      => $BackgroundColorEndStepAdminSettingBouton1,
				'selector' => implode(', ', array(
					'.adminsettings_bouton',
				))
			)
		)); ?>
	;
	for(var i=0;i<bgColorConfig.length;++i){
		$(bgColorConfig[i].selector).attr('data-bgcolor-hover', bgColorConfig[i].hover);
		$(bgColorConfig[i].selector).attr('data-bgcolor-end', bgColorConfig[i].end);
		$(bgColorConfig[i].selector).hover(function(){
			$(this).stop().animate({
				backgroundColor : $(this).attr('data-bgcolor-hover')
			}, 800);
		}, function(){
			$(this).stop().animate({
				backgroundColor : $(this).attr('data-bgcolor-end')
			}, 800);
		});
	}
});
</script>
<?php } ?>
<?php if($displayFontSizer) { ?>
<script src="javascripts/jquery/jquery.cookie.js" type="text/javascript"></script>
<script src="javascripts/jquery/jquery.fontscale.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
	$("#up").fontscale("p, h3","up",{unit:"px",increment:1});
	$("#down").fontscale("p, h3","down",{unit:"px",increment:1});
	$("#reset").fontscale("p, h3","reset");
});
</script>
<?php } ?>

<?php if($displayScrollingText){ ?>
	<script type="text/javascript">
	$(document).ready(function(){$('#scrollercontrol').ResetScroller(<?php echo json_encode(array(
	'velocity' => 60,
	'startfrom' => defined('SCROLLINGTEXTDIRECTION') && SCROLLINGTEXTDIRECTION === 'rtl' ? 'right' : 'left'
)); ?>);});
	</script>
<?php } ?>

</head>

<body  class="webui">

<div class="absolute">
  <!-- Top Panel Slider -->
  <?php if($displayTopPanelSlider) {include("sites/modules/slidepanel.php");} ?>
</div>

<div class="maintenance">
  <!-- If we are supposed to only display the maintenance page currently, do so now -->
  <?php if($displayMaintenancePage) {include("sites/main/maintenance.php"); return;} ?>

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

<?php if($displayLanguageSelector) {
      echo('<div id="translator">');
      include("languages/translator_page.php");
      echo('</div>');}
?>


<?php if($displayScrollingText) { ?>
  <div class="horizontal_scroller" id="scrollercontrol">
    <div class="scrollingtext">
      <?php echo $scrollingTextMessage; ?>
    </div>
  </div>
<?php } ?>

<?php if($displayWelcomeMessage) { ?>
  <div id="welcomeText">
    <?php
      if($_SESSION[NAME] != "") {
        echo $webui_welcome_back." ";
        echo $_SESSION[NAME];
        if($allowWebLogin == 'true')
        {
          echo " ";
          echo "<a href=\"secondlife:///app/login?first_name=$_SESSION[FIRSTNAME]&last_name=$_SESSION[LASTNAME]&location=last&grid=$gridNickName&web_login_key=$_SESSION[WEBLOGINKEY]\">$webui_login</a>";
        }
      }
      else {
        echo $webui_welcome." ";
        echo SYSNAME." ";
        echo $webui_welcome_visitor;
      }
    ?>
  </div>
<?php } ?>

<div id="container">
    <div id="header">
        <div id="headerimages">
            <a href="<?php echo SYSURL ?>"><h1><?php echo SYSNAME ?></h1></a>
        </div>
             <div id="home_content_right"><?php include("sites/modules/slideshow.php"); ?></div>
		<div id="home_content_right"><?php include("sites/modules/slideeffect.php"); ?></div>


    </div><!-- fin de #header -->

    <!-- <div id="menubar"><?php // include("sites/menubar.php"); ?></div> -->
    <?php if($displayMegaMenu) { ?>
      <div id="menubar"><?php include("sites/menus/megamenu/menubar.php"); ?></div>
    <?php } ?>

    <div id="MainContainer">
        <div id="sites"><?php include("sites.php"); ?></div>
    </div><!-- fin de #mainContent -->
</div><!-- fin de #container -->

<?php include("sites/main/footer.php"); ?>
<!-- fin de #footer -->

<div class="pageloadtime">
<?php
// Page Load Time
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$finish = $time;
$totaltime = ($finish - $start);
echo "<p>Copyright 2011 © the Aurora-Sim project</p>";
echo "<p>All Rights Reserved</p>";
if($displayPageLoadTime) {printf ("$this_page_took %f $seconds_to_load.", $totaltime);}
?>
</div>

</div>
<span id="problem">You do not have your Javascript enabled, and this site requires it.</span>
</body>
</html>
