<?
/*
 * Copyright (c) 2007, 2008, 2012 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

if(isset(Globals::i()->wi_sitemanagement[WEBUI_PAGE])){
	include(WEBUI_INSTALL_PATH . 'sites/' . Globals::i()->wi_sitemanagement[WEBUI_PAGE]);
}else{
	include(WEBUI_INSTALL_PATH . 'sites/404.php');
}
?>