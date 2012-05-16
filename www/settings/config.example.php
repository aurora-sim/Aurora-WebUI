<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/
##################### PHP ############################
date_default_timezone_set('America/Los_Angeles');
set_error_handler(function($errno, $errstr, $errfile, $errline){
	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

##################### System #########################
define("SYSNAME","***");
define("SYSURL","http://your_webui_server_ip_or_dns/");
define("SYSMAIL","***");
define("WIREDUX_SERVICE_URL","http://your_webui_server_ip_or_dns:8007/WIREDUX");
define("WIREDUX_TEXTURE_SERVICE","http://your_webui_server_ip_or_dns:8002");
define("WIREDUX_PASSWORD","***");

// Should we display a 'Maintenance' page currently that blocks all access to the website?
// (until disabled here)?
$displayMaintenancePage = false;

################### Add Grid Page ###################
define("AddGrid_GridNick","Your Grid Nick");
define("AddGrid_GridName","Your Grid Full Name");
// DO NOT PUT YOUR REAL USER NAME AND PASSWORD HERE!!! THIS IS PUBLICALLY SHOWN AND JUST CHANGES HOW IT LOOKS ON THE ADDGRID PAGE!!
define("AddGrid_AvFirstName","Your Avatar First Name");
define("AddGrid_AvLastName","Your Avatar Last Name");
define("AddGrid_AvPassword","Your Avatar Password");
// END ABOVE WARNING
define("AddGrid_LoginURL","http://your_webui_server_ip_or_dns:8002/");

define("AddGrid_LoginPage","http://your_webui_server_ip_or_dns/loginscreen");
define("AddGrid_HelperURL","http://your_webui_server_ip_or_dns:8002/");
define("AddGrid_Website","http://your_webui_server_ip_or_dns/");
define("AddGrid_Support","http://your_webui_server_ip_or_dns/");
define("AddGrid_Account","http://your_webui_server_ip_or_dns/index.php?page=register");
define("AddGrid_Password","http://your_webui_server_ip_or_dns/index.php?page=forgotpass");
define("AddGrid_WebSearch","http://your_webui_server_ip_or_dns/search.php");

define("AddGrid_KokuaURL","http://your_webui_server_ip_or_dns:8002/");
define("AddGrid_SecondLifeURL","http://your_webui_server_ip_or_dns:8002/");
define("AddGrid_KristenURL","http://your_webui_server_ip_or_dns:8002/");

$AddGrid_IWC_Actived = false;
define("AddGrid_IWC_URL_1","secondlife://your_webui_server_ip_or_dns:8003/");

$AddGrid_HG_Actived = false;
define("AddGrid_HG_URL_1","secondlife://your_webui_server_ip_or_dns:8003/");
// define("HG_URL_2","http://slurll.com/secondlife/your_webui_server_ip_or_dns:8003:digigrids");

$AddGrid_Voice_Actived = false;
$AddGrid_Currency_Actived = false;

################### Logo Light Effect ###################
// Should we display the logo 
// $displayLogo = true;
// Should we display nice logo effect! 
// $displayLogoEffect = true;

################### Slide Show ###################
// Should we display Top Panel Slider and 'options' 
// $displayTopPanelSlider = true;
// $displayTemplateSelector = true;
// $displayStyleSwitcher = true;
// $displayStyleSizer = true;
// $displayFontSizer = true;

// Choose your transition type
// blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY
// scrollUp, scrollDown, scrollLeft, scrollRight, scrollHorz, scrollVert, shuffle
// slideX, slideY, toss, turnUp, turnDown, turnLeft, turnRight, uncover, wipe, zoom
// http://jquery.malsup.com/cycle/
$displaySlideShow = true;
$SlideShowStyle = "turnDown";
$SlideShowSpeed = 1000;
$SlideShowTimeout = 5000;
$SlideShowSync = 0;             // 1 or 0
// $SlideShowPrev = '#prev2';
// $SlideShowNext = '#next2';
$SlideShowPause = 0;            // 1 or 0
$SlideShowRandom = 0;           // 1 or 0
$SlideShowPager = "";           // #nav
$SlideShowEaseing = "";         // bounceout
$SlideShowDelay = -1000;        // -5000

################### Loginscreen ###################
// Should the pictures on the loginscreen be random or by time?
$picturesByTime = false;
// Show the bar at the bottom that has the latest grid news?
$showNewsBar = true;
// Show the panel that has a list of all regions in the grid?
$showRegionsPanel = true;
// Show the panel that shows the grid status?
$showGridStatus = true;
// Show the panel that shows grid alerts?
$showAlertPanel = true;
// Show the panel that shows special reports?
$showSpecialReport = true;

################### Main Site #######################
// Should we show any scrolling text at the top of the page?
// $displayScrollingText = true;
// What message should be displayed in the scrolling text?
$scrollingTextMessage = "Welcome!         Bienvenue!          Hola!";
// Should we show the welcome message at the top of the page?
// $displayWelcomeMessage = true;
// Should we show date
// $displayDate = true;
// Should we show date
// $displayTime = true;
// $displayPageLoadTime = true;
// $displayW3c = false;
// $displayRss = true;


############ Delete Unconfirmed accounts ################
// e.g. 24 for 24 hours  leave empty for no timed delete
$unconfirmed_deltime="24";

################### Help support area #####################
$support_emails_to="noreply@osgrid.org";
$support_emails_subject="WebUI Support:";
$support_IRC_channel="aurora-dev";

################### GridMap Settings  #####################
// Allowing Zoom on your Map
$ALLOW_ZOOM = true;

// Zoom Level
// (1 => 4, 2 => 8, 3 => 16, 4 => 32, 5 => 64, 6 => 128, 7 => 256, 8 => 512
$zoomLevel = 5;
$zoomSize = 64;
$antiZoomSize = 64;

// Default StartPoint for Map
$mapstartX=1000;
$mapstartY=1000;

// Direction where Info Image has to stay 
// ex.: dr = down right ; dl =down left ; tr = top right ; tl = top left ; c = center
$display_marker="tr";

####################### Templates ##########################
// Current templates are 'default', 'white' and 'astra'
$template = 'default';

####################### Web Login ##########################
// Allow the user to launch the viewer and automatically login 
// by clicking the "Login" click in the upper righthand corner
$allowWebLogin = 'true';

// The name of the grid (gridnick) that is set in GridInfoService.ini
$gridNickName = 'aurora';

################### Rounded Corner #########################
// Should we display Rounded Corners
// $displayRoundedCorner = true;

##################### Mega DropDown Menu #########################
// Should we display Mega DropDown Menu
// eg : http://your.site.com/webui/sites/menus/megamenu/demos/
$displayMegaMenu    = true;
// 1.2 or 1.3.2 for differents effects
$MegaMenuVersion    = "1.3.2";
// Effects Presets
$MegaMenuPreset     = "1";      // (1 to 9)
$MegaMenuRowItems   = "1";      // 1 to 4
$MegaMenuSpeed      = "fast";   // slow, fast
$MegaMenuEffect     = "slide";  // fade, slide
$MegaMenuEvent      = "hover";  // hover, clic
// Skins Presets
// basic, black, grey, blue, orange, red, green, light-blue, white (or custom).
// WARNING! Styles 'basic' requiere MegaMenuPreset setup to 1
$MegaMenuSkin       = "basic";



#################### Languages ########################
// TODO $displayLanguageSelector = true;
$languages=array("en" => "English",
    "fr" => "French",
    "de" => "German",
    "es" => "Spanish",
    "it" => "Italian",
    "nl" => "Dutch",
    "pt" => "Portuguese",
    "fi" => "Finnish",
    "gr" => "Greek",
    "slo" => "Slovenski");

################ Database Tables #########################
define("C_ADMIN_TBL","wi_admin");
define("C_WIUSR_TBL","wi_users");
define("C_WI_APPEARANCE_TBL","wi_appearance");
define("C_USRBAN_TBL","wi_banned");
define("C_CODES_TBL","wi_codetable");
define("C_ADM_TBL","wi_adminsetting");
define("C_COUNTRY_TBL","wi_country");
define("C_NAMES_TBL","wi_lastnames");
define("C_INFOWINDOW_TBL","wi_startscreen_infowindow");
define("C_NEWS_TBL","wi_startscreen_news");
define("C_PAGE_TBL","wi_pagemanager");
define("C_SITES_TBL","wi_sitemanagement");
define("C_GALLERY_TBL", "wi_gallery");

// Aurora tables
define("C_USERS_TBL","useraccounts");
define("C_AUTH_TBL","auth");
define("C_REGIONS_TBL","gridregions");
define("C_APPEARANCE_TBL", "avatar");
define("C_USERINFO_TBL", "userinfo");
define("C_PROFILE_TBL", "profilegeneral");

// other
define("C_USERS_RL_TBL", "useraccounts_rl");

// Options
define("C_ADMINMODULES_TBL", "wi_adminmodules");
define("C_ADMINOPTIONS_TBL", "wi_adminoptions");
define("C_ADMINBGCOLORANIM_TBL", "wi_adminbgcoloranim");

################ Recaptcha ###############################
#	Obtain your public and private keys from http://www.google.com/recaptcha

//define('RECAPTCHA_PUBLIC_KEY', 'foo');
//define('RECAPTCHA_PRIVATE_KEY', 'bar');

################ Optional WebUI Features ###############################
define('EmailAccountActivation',true);
?>
