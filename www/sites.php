<?
/*
 * Copyright (c) 2007, 2008, 2012 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

if(isset(Globals::i()->wi_sitemanagement[WEBUI_PAGE])){
	if(preg_match(WebUISites::regex_sites, Globals::i()->wi_sitemanagement[WEBUI_PAGE]) == 1){
		include(WEBUI_INSTALL_PATH . 'sites' . DIRECTORY_SEPARATOR . Globals::i()->wi_sitemanagement[WEBUI_PAGE]);
	}else if(preg_match(WebUISites::regex_app, Globals::i()->wi_sitemanagement[WEBUI_PAGE]) == 1){
		include(WEBUI_INSTALL_PATH . 'app' . DIRECTORY_SEPARATOR . WEBUI_PAGE . DIRECTORY_SEPARATOR . Globals::i()->wi_sitemanagement[WEBUI_PAGE]);
	}
	
}else{
	include(WEBUI_INSTALL_PATH . 'sites/404.php');
}
?>