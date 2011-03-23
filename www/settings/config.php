<?php
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

##################### System #########################
define("SYSNAME","Aurora WiRedux");
define("SYSURL","http://localhost/");
define("SYSMAIL","Webmaster <noreply@osgrid.org>");
define("WIREDUX_SERVICE_URL","http://localhost:8007/WIREDUX");
define("WIREDUX_TEXTURE_SERVICE","http://localhost:8002");
define("WIREDUX_PASSWORD","");

################### Loginscreen ################
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

############ Delete Unconfirmed accounts ################
// e.g. 24 for 24 hours  leave empty for no timed delete
$unconfirmed_deltime="24";

################### Help support area #####################
$support_emails_to="noreply@osgrid.org";
$support_emails_subject="WebUI Support:";

################### GridMap Settings  #####################
//Allowing Zoom on your Map
$ALLOW_ZOOM=TRUE;

//Default StartPoint for Map
$mapstartX=1000;
$mapstartY=1000;

//Direction where Info Image has to stay ex.: dr = down right ; dl =down left ; tr = top right ; tl = top left ; c = center
$display_marker="tl";

####################### Skin ##########################

//Current templates are 'default' and 'white'
$template='default';

#################### Languages ########################

$languages=array("en" => "English",
    "fr" => "French",
    "de" => "German",
    "es" => "Spanish",
    "it" => "Italian",
    "nl" => "Dutch",
    "pt" => "Portuguese",
    "fi" => "Finnish",
    "gr" => "Greek");

##################### Database ########################
define("C_DB_TYPE","mysql");
//Your Hostname here:
define("C_DB_HOST","localhost");
//Your Databasename here:
define("C_DB_NAME","aurora");
//Your Username from Database here:
define("C_DB_USER","root");
//Your Database Password here:
define("C_DB_PASS","");

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
// REGION MANAGER
define("C_MAP_REGIONS_TBL", "wi_regions");
// STATISTICS
define("C_STATS_REGIONS_TBL", "wi_statistics");
define("C_GALLERY_TBL", "wi_gallery");


//Aurora tables
define("C_USERS_TBL","useraccounts");
define("C_AUTH_TBL","auth");
define("C_REGIONS_TBL","gridregions");
define("C_APPEARANCE_TBL", "avatar");
define("C_USERINFO_TBL", "userinfo");
define("C_PROFILE_TBL", "profilegeneral");

//other
define("C_USERS_RL_TBL", "useraccounts_rl");
?>
