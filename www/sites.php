<?
/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

include("../../settings/config.php");
include("../../settings/mysql.php");
include("../../settings/json.php");
$DbLink = new DB;

$page = $_SESSION[page];

$DbLink->query("SELECT type, include FROM ".C_SITES_TBL." where pagecase = '".cleanQuery($page)."'");

while(list($type,$include) = $DbLink->next_record())
{
	include("./sites/".$type."/".$include);
	return;
}

include("./sites/404.php");
?>