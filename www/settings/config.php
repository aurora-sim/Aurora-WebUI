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
define("SYSURL","http://localhost:8080");
define("SYSMAIL","your@email.com");

############ Delete Unconfirmed accounts ################
// e.g. 24 for 24 hours  leave empty for no timed delete
$unconfirmed_deltime="24";

###################### Money Settings ####################

// Key of the account that all fees go to:
$economy_sink_account="00000000-0000-0000-0000-000000000000";

// Key of the account that all purchased currency is debited from:
$economy_source_account="00000000-0000-0000-0000-000000000000";

// Sets wich Pageeditor should be used:
$editor_to_use='standard';
//$editor_to_use='fckeditor';


################### GridMap Settings  #####################
//Allowing Zoom on your Map
$ALLOW_ZOOM=TRUE;

//Default StartPoint for Map
$mapstartX=1000;
$mapstartY=1000;

//Direction where Info Image has to stay ex.: dr = down right ; dl =down left ; tr = top right ; tl = top left ; c = center 
$display_marker="dr";

##################### Database ########################
define("C_DB_TYPE","mysql");
//Your Hostname here:
define("C_DB_HOST","localhost");
//Your Databasename here:
define("C_DB_NAME","aurora");
//Your Username from Database here:
define("C_DB_USER","aurora");
//Your Database Password here:
define("C_DB_PASS","***");

################ Database Tables #########################
define("C_ADMIN_TBL","wi_admin");
define("C_WIUSR_TBL","wi_users");
define("WIREDUX_SERVICE_URL","http://localhost:8007/WIREDUX");
define("WIREDUX_PASSWORD","***");
define("C_WI_APPEARANCE_TBL","wi_appearance");
define("C_USRBAN_TBL","wi_banned");
define("C_CODES_TBL","wi_codetable");
define("C_ADM_TBL","wi_adminsetting");
define("C_COUNTRY_TBL","wi_country");
define("C_NAMES_TBL","wi_lastnames");
define("C_CURRENCY_TBL","wi_economy_money");
define("C_TRANSACTION_TBL","wi_economy_transactions");
define("C_INFOWINDOW_TBL","wi_startscreen_infowindow");
define("C_NEWS_TBL","wi_startscreen_news");
define("C_PAGE_TBL","wi_pagemanager");
// REGION MANAGER
define("C_MANAGEMENT_PAGE_TBL","wi_management_pagemanager");
define("C_MAP_REGIONS_TBL", "wi_regions");
// OFFLINE IM'S
define("C_OFFLINE_IM_TBL", "wi_offline_msgs");
// STATISTICS
define("C_STATS_REGIONS_TBL", "wi_statistics");


//OPENSIM DEFAULT TABLES (NEEDED FOR LOGINSCREEN & MONEY SYSTEM)
define("C_USERS_TBL","useraccounts");
define("C_AUTH_TBL","auth");
define("C_REGIONS_TBL","gridregions");
define("C_GRIDUSER_TBL","GridUser");
define("C_APPEARANCE_TBL", "avatar");
define("C_PRESENCE_TBL", "Presence");
define("C_PROFILE_TBL", "profilegeneral");
?>