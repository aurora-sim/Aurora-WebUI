<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/
##################### PHP ############################
@date_default_timezone_set(@date_default_timezone_get());
//set_error_handler(function($errno, $errstr, $errfile, $errline){
//	throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
//});

##################### System #########################
//define("SYSNAME","***");
define("SYSURL","http://your_webui_server_ip_or_dns/");
define("SYSMAIL","***");
define("WIREDUX_SERVICE_URL","http://your_webui_server_ip_or_dns:8007/WEBUI");
define("WIREDUX_TEXTURE_SERVICE","http://your_webui_server_ip_or_dns:8002");
define("WIREDUX_PASSWORD","***");

// Should we display a 'Maintenance' page currently that blocks all access to the website?
// (until disabled here)?
$displayMaintenancePage = false;

################ Aurora-Sim.php ########################################

$dir = getcwd();
$i = 0;
while(!is_dir($dir . DIRECTORY_SEPARATOR . 'settings') && !is_file($dir . DIRECTORY_SEPARATOR . 'settings' . DIRECTORY_SEPARATOR . 'Aurora-Sim.php.phar.gz') && $i <= 2){
	++$i;
	$pathinfo = pathinfo($dir);
	$dir = $pathinfo['dirname'];
}
define('WEBUI_INSTALL_PATH', $dir . DIRECTORY_SEPARATOR);

require_once('phar://' . WEBUI_INSTALL_PATH . 'settings/libAurora.php.phar.gz/Aurora/load.php');

use Aurora\Addon\WebUI;
use Aurora\Addon\WebUI\Configs;

$configs = Configs::i();

$configs[] = WebUI::r(
	WIREDUX_SERVICE_URL,
	WIREDUX_PASSWORD
);

################### Add Grid Page ###################
define("AddGrid_GridNick", Configs::d()->get_grid_info('gridnick'));
define("AddGrid_GridName", Configs::d()->get_grid_info('gridname'));
if(!defined('SYSNAME')){
	define('SYSNAME', AddGrid_GridNick);
}
// DO NOT PUT YOUR REAL USER NAME AND PASSWORD HERE!!! THIS IS PUBLICALLY SHOWN AND JUST CHANGES HOW IT LOOKS ON THE ADDGRID PAGE!!
define("AddGrid_AvFirstName","Your Avatar First Name");
define("AddGrid_AvLastName","Your Avatar Last Name");
define("AddGrid_AvPassword","Your Avatar Password");
// END ABOVE WARNING
define("AddGrid_LoginURL", Configs::d()->get_grid_info('login'));

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
define('DEFAULT_LANG', 'en');
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
define("C_GALLERY_TBL", "wi_gallery");

// Aurora tables
define("C_REGIONS_TBL","gridregions");

// Options
define("C_ADMINMODULES_TBL", "wi_adminmodules");
define("C_ADMINOPTIONS_TBL", "wi_adminoptions");
define("C_ADMINBGCOLORANIM_TBL", "wi_adminbgcoloranim");

################ Recaptcha ###############################

//define('RECAPTCHA_PUBLIC_KEY', 'foo');
//define('RECAPTCHA_PRIVATE_KEY', 'bar');

################ Optional WebUI Features ###############################
define('EmailAccountActivation',true);

################ wi_sitemanagement replacement #########################

require_once($config_directory . 'wi_sitemanagement.php');
$wi_sitemanagement['activate']         = 'main/activate.php';
$wi_sitemanagement['activatemail']     = 'main/activatemail.php';
$wi_sitemanagement['changeaccount']    = 'account/changeaccount.php';
$wi_sitemanagement['forgotpass']       = 'account/forgotpass.php';
$wi_sitemanagement['news']             = 'news/news.php';
$wi_sitemanagement['home']             = 'main/home.php';
$wi_sitemanagement['login']            = 'main/login.php';
$wi_sitemanagement['logout']           = 'main/logout.php';
$wi_sitemanagement['onlineusers']      = 'main/onlineusers.php';
$wi_sitemanagement['peoplesearch']     = 'main/peoplesearch.php';
$wi_sitemanagement['register']         = 'account/register.php';
$wi_sitemanagement['regionlist']       = 'main/regionlist.php';
$wi_sitemanagement['resetpass']        = 'account/resetpass.php';
$wi_sitemanagement['worldmap']         = 'main/worldmap.php';
$wi_sitemanagement['adminhome']        = 'admin/home.php';
$wi_sitemanagement['adminloginscreen'] = 'admin/loginscreenmanager.php';
$wi_sitemanagement['adminnewsmanager'] = 'admin/newsmanager.php';
$wi_sitemanagement['adminmanage']      = 'admin/manage.php';
$wi_sitemanagement['adminsupport']     = 'admin/support.php';
$wi_sitemanagement['news_add']         = 'admin/news_add.php';
$wi_sitemanagement['news_edit']        = 'admin/news_edit.php';
$wi_sitemanagement['adminsettings']    = 'admin/settings.php';
$wi_sitemanagement['adminmodules']     = 'admin/modules.php';
$wi_sitemanagement['adminedit']        = 'admin/edit.php';
$wi_sitemanagement['account']          = 'account/main.php';
$wi_sitemanagement['world']            = 'main/worldmain.php';
$wi_sitemanagement['users']            = 'main/usersmain.php';
$wi_sitemanagement['help']             = 'main/help.php';
$wi_sitemanagement['chat']             = 'main/chat.php';
$wi_sitemanagement['downloads']        = 'main/downloads.php';

################ wi_pagemanager replacement ############################

require_once($config_directory . 'wi_pagemanager.php');

$webui_menu_item_home      = $wi_pagemanager['webui_menu_item_home']      = WebUIPage::f('webui_menu_item_home'             , 1  , 'index.php?page=home'             , '_self', 2);

$webui_menu_item_adminhome = $wi_pagemanager['webui_menu_item_adminhome'] = WebUIPage::f('webui_menu_item_adminhome'        , 2  , 'index.php?page=adminhome'        , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminmanage']             = WebUIPage::f('webui_menu_item_adminmanage'      , 2.1, 'index.php?page=adminmanage'      , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminsettings']           = WebUIPage::f('webui_menu_item_adminsettings'    , 2.2, 'index.php?page=adminsettings'    , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminmodules']            = WebUIPage::f('webui_menu_item_adminmodules'     , 2.3, 'index.php?page=adminmodules'     , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminloginscreen']        = WebUIPage::f('webui_menu_item_adminloginscreen' , 2.4, 'index.php?page=adminloginscreen' , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminnewsmanager']        = WebUIPage::f('webui_menu_item_adminnewsmanager' , 2.5, 'index.php?page=adminnewsmanager' , '_self', 3);
	$webui_menu_item_adminhome['webui_menu_item_adminsupport']            = WebUIPage::f('webui_menu_item_adminsupport'     , 2.6, 'index.php?page=adminsupport'     , '_self', 3);

$webui_menu_item_account   = $wi_pagemanager['webui_menu_item_account']   = WebUIPage::f('webui_menu_item_account'          , 3  , 'index.php?page=account'          , '_self', 1);
	$webui_menu_item_account['webui_menu_item_changeaccount']             = WebUIPage::f('webui_menu_item_changeaccount'    , 3.1, 'index.php?page=changeaccount'    , '_self', 1);

$webui_menu_item_world     = $wi_pagemanager['webui_menu_item_world']     = WebUIPage::f('webui_menu_item_world'            , 4  , 'index.php?page=world'            , '_self', 2);
	$webui_menu_item_world['webui_menu_item_news']                        = WebUIPage::f('webui_menu_item_news'             , 4.1, 'index.php?page=news'             , '_self', 2);
	$webui_menu_item_world['webui_menu_item_regions']                     = WebUIPage::f('webui_menu_item_regions'          , 4.2, 'index.php?page=regionlist'       , '_self', 2);
	$webui_menu_item_world['webui_menu_item_worldmap']                    = WebUIPage::f('webui_menu_item_worldmap'         , 4.3, 'index.php?page=worldmap'         , '_self', 2);
	$webui_menu_item_world['webui_menu_item_gallery']                     = WebUIPage::f('webui_menu_item_gallery'          , 4.5, 'index.php?page=gallery'          , '_self', 2);

$webui_menu_item_users     = $wi_pagemanager['webui_menu_item_users']     = WebUIPage::f('webui_menu_item_users'            , 5  , 'index.php?page=users'            , '_self', 1);
	$webui_menu_item_users['webui_menu_item_peoplesearch']                = WebUIPage::f('webui_menu_item_peoplesearch'     , 5.1, 'index.php?page=peoplesearch'     , '_self', 1);
	$webui_menu_item_users['webui_menu_item_onlineusers']                 = WebUIPage::f('webui_menu_item_onlineusers'      , 5.2, 'index.php?page=onlineusers'      , '_self', 1);

$webui_menu_item_register  = $wi_pagemanager['webui_menu_item_register']  = WebUIPage::f('webui_menu_item_register'         , 6  , 'index.php?page=register'         , '_self', 0);

$webui_menu_item_login     = $wi_pagemanager['webui_menu_item_login']     = WebUIPage::f('webui_menu_item_login'            , 7  , 'index.php?page=login'            , '_self', 0);
	$webui_menu_item_login['webui_menu_item_forgotpass']                  = WebUIPage::f('webui_menu_item_forgotpass'       , 7.1, 'index.php?page=forgotpass'       , '_self', 0);

$webui_menu_item_logout    = $wi_pagemanager['webui_menu_item_logout']    = WebUIPage::f('webui_menu_item_logout'           , 8  , 'index.php?page=logout'           , '_self', 1);

$webui_menu_item_help      = $wi_pagemanager['webui_menu_item_help']      = WebUIPage::f('webui_menu_item_help'             , 9  , 'index.php?page=help'             , '_self', 2);
	$webui_menu_item_help['webui_menu_item_chat']                         = WebUIPage::f('webui_menu_item_chat'             , 9.1, 'index.php?page=chat'             , '_self', 2);
	$webui_menu_item_help['webui_menu_item_downloads']                    = WebUIPage::f('webui_menu_item_downloads'        , 9.2, 'index.php?page=downloads'        , '_self', 2);
	$webui_menu_item_help['webui_menu_item_addgrid']                      = WebUIPage::f('webui_menu_item_addgrid'          , 9.3, 'index.php?page=addgrid'          , '_self', 2);
	$webui_menu_item_help['webui_menu_item_addserver']                    = WebUIPage::f('webui_menu_item_addserver'        , 9.4, 'index.php?page=addserver'        , '_self', 2);

?>
