<?php
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */

// Page Load Time 
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time;  

//Use gzip if it is supported
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler");
else
ob_start();
session_start();

echo "<!doctype html>";

if ((empty($_GET['lang'])) && (empty($_COOKIE['lang'])))
{
	echo "<html lang=en class=\"no-js\">";
}
else if (!empty($_GET['lang']))
{
	echo "<html lang=".$_GET['lang']." class=\"no-js\">";
}
else if(!empty($_COOKIE['lang']))
{
	echo "<html lang=".$_COOKIE['lang']." class=\"no-js\">";
}

include("settings/config.php");
include("settings/databaseinfo.php");
include("settings/json.php");
include("settings/mysql.php");
include("languages/translator.php");
include("templates/templates.php");
use Aurora\Addon\WebUI\Configs;


if ($_GET[page] != '') {
    $_SESSION[page] = $_GET[page];
} else {
    $_SESSION[page] = 'home';
}

//LOGIN AUTHENTIFICATION
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

$webuicid                        = Configs::d()->WebUIClientImplementationData();
$adminmodules                    = $webuicid['adminmodules'];
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
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="templates/no_js.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo $template_css ?>" type="text/css" />

  <link rel="shortcut icon" href="<?php echo $favicon_image?>" />
  <title><? echo $webui_welcome; ?> <?= SYSNAME ?></title>
  <script src="javascripts/modernizr-1.7.min.js" type="text/javascript"></script>
  <script src="javascripts/global.js" type="text/javascript"></script>
    
  <script src="javascripts/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="javascripts/jquery/slidepanel.js" type="text/javascript"></script>
    
  <script src="javascripts/jquery/jquery.Scroller-1.0.min.js" type="text/javascript"></script> 
  <script src="javascripts/jquery/divscroller.js" type="text/javascript"></script>

  <script type="text/javascript" src="javascripts/calendar-2.2.js"></script>

<?php if($displayMegaMenu) { ?>
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
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/megamenu_default.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if($template == 'white')  { ?>
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/megamenu_white.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if($template == 'astra')  { ?>
<link href="<?php echo SYSURL ?>sites/menus/megamenu/css/megamenu_astra.css" rel="stylesheet" type="text/css" />
<?php } ?>

<script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.hoverIntent.minified.js'></script>

<?php if($MegaMenuVersion == '1.2')  { ?>
  <script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.2.js'></script>
<?php } ?>

<?php if($MegaMenuVersion == '1.3.2')  { ?>
  <script type='text/javascript' src='<?php echo SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.3.2.js'></script>
<?php } ?>


<script type="text/javascript">
$(document).ready(function($){
	$('#mega-menu-1').dcMegaMenu({
		rowItems: '<?php echo $MegaMenuRowItems; ?>',
		speed: '<?php echo $MegaMenuSpeed; ?>',
		effect: '<?php echo $MegaMenuEffect; ?>',
		event: '<?php echo $MegaMenuEvent; ?>'
	});
	$('#mega-menu-2').dcMegaMenu({
		rowItems: '<?php echo $MegaMenuRowItems; ?>',
		speed: '<?php echo $MegaMenuSpeed; ?>',
		effect: '<?php echo $MegaMenuEffect; ?>',
		event: '<?php echo $MegaMenuEvent; ?>'
	});
	$('#mega-menu-3').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-4').dcMegaMenu({
		rowItems: '4',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-5').dcMegaMenu({
		rowItems: '1',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-6').dcMegaMenu({
		rowItems: '1',
		speed: 'slow',
		effect: 'slide',
		event: 'hover'
	});
	$('#mega-menu-7').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		event: 'hover'
	});
	$('#mega-menu-8').dcMegaMenu({
		rowItems: '4',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
	$('#mega-menu-9').dcMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'fade',
		event: 'hover'
	});
});
</script>
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
<script type="text/javascript" src="<?= SYSURL ?>javascripts/jquery/jquery.corner.js?v2.11"></script>
<script type="text/javascript">
// http://jquery.malsup.com/corner/
// Add more class here ...
$('#annonce1, #annonce2, #annonce3, #annonce4, #annonce5, #annonce6, #annonce7, #annonce10').corner();
$('#info1, #info2, #info3, #info4, #info5, #info6, #info7, #info10').corner();
$('#aide1, #aide2, #aide3, #aide4, #aide5, #aide6, #aide7, #aide10').corner();
$('#step1, #step2, #step3, #step4, #step5, #step6, #step7, #step10').corner();
$('#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5').corner();
$('#ContentHeaderLeft, #ContentHeaderCenter, #ContentHeaderRight').corner("5px");
$('.news_time, .news_title, .news_content, #news_online').corner();
	
$(function(){
$('#dynCorner').click(function() {
$('#dynamic').corner();
});

$('#dynUncorner').click(function() {
$('#dynamic').uncorner();
});

$("#translator, #welcomeText").corner("5px");
$('#container,#header,#content').corner(); // (add to curvycorner)
$('#region_map').corner();
$('#login, #register, #forget_pass').corner("5px");
$('.menu').corner();
$('#chat').corner();
$('button, .roundedinput, .forgot_pass_bouton, .adminsettings_bouton').corner("10px");
$('#roundedcoord').corner("10px");
$('#info_loginscreen_button').corner("10px");
});
/* Downlaod Page */
$('#download1, #download2, #download3, #download1 a, #download2 a, #download3 a').corner();

/* AddGrid Page */
$('#addgrid01, #addgrid02, #addgrid03, #addgrid04, #addgrid05, #addgrid06, #addgrid07, #addgrid08, #addgrid09, #addgrid10, #addgrid h3 a').corner();

/* StarDust Currency Pages */
$('#island1, #island2, #island3, #island4, #island5').corner();
$('#island_picture1,#island_picture2,#island_picture3,#island_picture4,#island_picture5').corner();
$('#island_info_part1, #island_info_part2, #island_info_part3, #island_info_part4, #island_info_part5').corner();
// $('#CurrencyHistory').corner();
</script>
<?php } ?>


<?php if($MegaMenuPreset == 1)  { ?>
<script type="text/javascript">
		$('.mega-menu, #mega-menu-1, #mega-menu-1 li a').corner();
</script>		
<?php } ?>	


<?php if($displayBackgroundColorAnimation)  { ?>
<!-- include Google's AJAX API loader -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#annonce1").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });
                
	$("#annonce2").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep2 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep2 ?>'}, 800);
  });

	$("#annonce3").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep3 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep3 ?>'}, 800);
  });
                
	$("#annonce4").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep4 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep4 ?>'}, 800);
  });

	$("#annonce5").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep5 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep5 ?>'}, 800);
  });

	$("#annonce6").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep6 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep6 ?>'}, 800);
  });

	$("#annonce7").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep7 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep7 ?>'}, 800);
  });

	$("#annonce10").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep10 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep10 ?>'}, 800);
  });


  $("#step1").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });
                
	$("#step2").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep2 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep2 ?>'}, 800);
  });

	$("#step3").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep3 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep3 ?>'}, 800);
  });
   

  $("#info1").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });
                
	$("#info2").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep2 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep2 ?>'}, 800);
  });

	$("#info3").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep3 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep3 ?>'}, 800);
  });
                
	$("#aide1").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep4 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep4 ?>'}, 800);
  });

	$("#aide2").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep5 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep5 ?>'}, 800);
  });

	$("#aide3").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep6 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep6 ?>'}, 800);
  });
  
	$("#mega-menu-1 a").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepMegaMenu1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepMegaMenu1 ?>'}, 800);
  });
  
	$("#register_bouton, #login_bouton, #forgot_pass_bouton, #adminlogin_button").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepLoginBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepLoginBouton1 ?>'}, 800);
  });
  
	$(".adminsettings_bouton").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepAdminSettingBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepAdminSettingBouton1 ?>'}, 800);
  });
  
	$("#create_news_button, #edit_news_item_button, #info_loginscreen_button").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepLoginBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepLoginBouton1 ?>'}, 800);
  });

  /* Page Downloads */
  	$("#download1, #download2, #download3").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });

  	$("#download1 a, #download2 a, #download3 a").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepLoginBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepLoginBouton1 ?>'}, 800);
  });
  
  /* Page News */
	$(".news_time, .news_title, .news_content").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });
  
  /* Grid Status Module */
	$("#gridstatus1, #gridstatus2, #gridstatus3, #gridstatus4, #gridstatus5").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });

  /* AddGrid Page */
	$("#addgrid01, #addgrid02, #addgrid03, #addgrid04, #addgrid05, #addgrid06, #addgrid07, #addgrid08, #addgrid09, #addgrid10").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStep1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStep1 ?>'}, 800);
  });

  	$("#addgrid h3 a").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepLoginBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepLoginBouton1 ?>'}, 800);
  });  
  
  /* Stardust Module */
	$("#island_input_button1, #island_input_button2, #island_input_button3, #island_input_button4, #island_input_button5, #get_it_now_button").hover(function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorHoverStepLoginBouton1 ?>'}, 800);
  },function() {
    $(this).stop().animate({ backgroundColor: '<?= $BackgroundColorEndStepLoginBouton1 ?>'}, 800);
  });

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
        <!-- <div id="gridstatus"><?php //php include("sites/gridstatus.php"); ?></div> -->
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
