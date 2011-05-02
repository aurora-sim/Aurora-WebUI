<?
// Page Load Time 
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$start = $time;  

//Use gzip if it is supported
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
    ob_start("ob_gzhandler"); else
    ob_start();
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
        $_SESSION[FIRSTNAME] = $recieved->{'FirstName'};
        $_SESSION[LASTNAME] = $recieved->{'LastName'};

        $found[0] = json_encode(array('Method' => 'SetWebLoginKey', 'WebPassword' => md5(WIREDUX_PASSWORD),
                                 'PrincipalID' => $UUIDC));
        $do_post_request = do_post_request($found);
        $recieved = json_decode($do_post_request);
        $WEBLOGINKEY = $recieved->{'WebLoginKey'};
        $_SESSION[WEBLOGINKEY] = $WEBLOGINKEY;
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
  } // LOGIN END

  $DbLink->query("SELECT id,
                         displayTopPanelSlider, 
                         displayTemplateSelector,
                         displayStyleSwitcher,
                         displayStyleSizer,
                         displayFontSizer,
                         displayLanguageSelector,
                         displayScrollingText,
                         displayWelcomeMessage,
                         displayLogo,
                         displayLogoEffect,
                         displaySlideShow,
                         displayMegaMenu,
                         displayDate,
                         displayTime,
                         displayRoundedCorner,
                         displayBackgroundColorAnimation,
                         displayPageLoadTime,
                         displayW3c,
                         displayRss FROM ".C_ADMINMODULES_TBL." ");
                     
  list($id,
       $displayTopPanelSlider,
       $displayTemplateSelector, 
       $displayStyleSwitcher,
       $displayStyleSizer,
       $displayFontSizer,
       $displayLanguageSelector,
       $displayScrollingText,
       $displayWelcomeMessage,
       $displayLogo,
       $displayLogoEffect,
       $displaySlideShow,
       $displayMegaMenu,
       $displayDate,
       $displayTime,
       $displayRoundedCorner,
       $displayBackgroundColorAnimation,
       $displayPageLoadTime,
       $displayW3c,
       $displayRss) = $DbLink->next_record();
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
 

<?php if($displayMegaMenu) { ?>
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/black.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/grey.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/blue.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/green.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/light_blue.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/orange.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/red.css" rel="stylesheet" type="text/css" />
<link href="<?= SYSURL ?>sites/menus/megamenu/css/skins/white.css" rel="stylesheet" type="text/css" />

<?php if($template == 'default')  { ?>
<link href="<?= SYSURL ?>sites/menus/megamenu/css/megamenu_default.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if($template == 'white')  { ?>
<link href="<?= SYSURL ?>sites/menus/megamenu/css/megamenu_white.css" rel="stylesheet" type="text/css" />
<?php } ?>

<?php if($template == 'astra')  { ?>
<link href="<?= SYSURL ?>sites/menus/megamenu/css/megamenu_astra.css" rel="stylesheet" type="text/css" />
<?php } ?>

<script type='text/javascript' src='<?= SYSURL ?>sites/menus/megamenu/javascripts/jquery.hoverIntent.minified.js'></script>

<?php if($MegaMenuVersion == '1.2')  { ?>
  <script type='text/javascript' src='<?= SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.2.js'></script>
<?php } ?>

<?php if($MegaMenuVersion == '1.3.2')  { ?>
  <script type='text/javascript' src='<?= SYSURL ?>sites/menus/megamenu/javascripts/jquery.dcmegamenu.1.3.2.js'></script>
<?php } ?>


<script type="text/javascript">
$(document).ready(function($){
	$('#mega-menu-1').dcMegaMenu({
		rowItems: '<?= $MegaMenuRowItems; ?>',
		speed: '<?= $MegaMenuSpeed; ?>',
		effect: '<?= $MegaMenuEffect; ?>',
		event: '<?= $MegaMenuEvent; ?>'
	});
	$('#mega-menu-2').dcMegaMenu({
		rowItems: '<?= $MegaMenuRowItems; ?>',
		speed: '<?= $MegaMenuSpeed; ?>',
		effect: '<?= $MegaMenuEffect; ?>',
		event: '<?= $MegaMenuEvent; ?>'
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
    $('#step1, #step2, #step3').corner();
    
    $('#ContentHeaderLeft, #ContentHeaderCenter, #ContentHeaderRight').corner("5px");
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
		$('.chat').corner();
		$('button, .roundedinput, .forgot_pass_bouton, .adminsettings_bouton').corner("10px");
		$('#roundedcoord').corner("10px");


    });
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



}); 
</script>
<?php } ?>


<? if($displayFontSizer) { ?> 
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
    
<body class="webui">

<div class="absolute">
  <!-- Top Panel Slider -->
  <? if($displayTopPanelSlider) {include("sites/modules/slidepanel.php");} ?>
</div>

<div class="maintenance">
  <!-- If we are supposed to only display the maintenance page currently, do so now -->
  <? if($displayMaintenancePage) {include("sites/main/maintenance.php"); return;} ?>

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

<? if($displayLanguageSelector) {
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
            <a href="<?= SYSURL ?>"><h1><? SYSNAME ?></h1></a>
        </div>
        <!-- <div id="gridstatus"><? //php include("sites/gridstatus.php"); ?></div> -->
        <div id="home_content_right"><? include("sites/modules/slideshow.php"); ?></div>
    </div><!-- fin de #header -->

    <!-- <div id="menubar"><? // include("sites/menubar.php"); ?></div> -->
    <?php if($displayMegaMenu) { ?>
      <div id="menubar"><? include("sites/menus/megamenu/menubar.php"); ?></div>
    <?php } ?>
        
    <div id="MainContainer">
        <div id="sites"><? include("sites.php"); ?></div>
    </div><!-- fin de #mainContent -->
</div><!-- fin de #container -->

<div id="footer">
<?php include("sites/main/footer.php"); ?> 
</div><!-- fin de #footer -->

<div class="pageloadtime">
<?php
// Page Load Time 
$time = microtime(); 
$time = explode(" ", $time); 
$time = $time[1] + $time[0]; 
$finish = $time; 
$totaltime = ($finish - $start);
if($displayPageLoadTime) {
  printf ('This page took %f seconds to load.', $totaltime);
  // TODO $this_page_took and $seconds_to_load
} 
?>
</div>

</div>
</body>
</html>
