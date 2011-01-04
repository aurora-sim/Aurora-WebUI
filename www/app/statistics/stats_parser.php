<?
include("../../settings/config.php");
include("../../settings/mysql.php");

$DbLink = new DB;

//Supress all Warnings/Errors
error_reporting(0);

$now = time();

function GetURL($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $data = curl_exec($ch);
    if (!curl_errno($ch))
    {
        curl_close($ch);
        return $data;
    }
	return "";
}

function CheckHost($host, $port)
{

	$fp = fsockopen ($host, $port, $errno, $errstr, 10);

	if(!$fp)
	{
	$DbLink = new DB;
	$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set failcounter = failcounter + 1 ".
			"where serverIP = '" . mysql_escape_string($host) . "' AND ".
			"serverPort = '" . mysql_escape_string($port) . "'");

	//Setting a "fake" update time so this host will have time
	//to get back online

	$next = time() + (30 * 60); // 30 mins, so we don't get stuck

	$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set lastcheck = $next " .
			" where serverIP = '" . mysql_escape_string($host) . "' AND ".
			"serverPort = '" . mysql_escape_string($port) . "'");
	}
	else
	{
	$DbLink = new DB;
	$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set failcounter = 0 ".
			" where serverIP = '" . mysql_escape_string($host) . "' AND ".
			"serverPort = '" . mysql_escape_string($port) . "'");

	parse($host,$port);
	}
}

function parse($host,$port)
{
	global $now;

	///////////////////////////////////////////////////////////////////////
	//
	// Map Parse Engine
	//

	//
	// Read params
	//
	$next = time() + (30 * 60); // 30 mins, so we don't get stuck

	$DbLink = new DB;
	$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set lastcheck = ".$next." " .
			" where serverIP = '" . mysql_escape_string($host) . "' AND ".
			"serverPort = '" . mysql_escape_string($port) . "'");

	$buildurl = $host.":".$port."/simstatusx/";

	// Grabbing the version from the region
	$statusdata = GetURL($buildurl);

	$status = json_decode($statusdata, true);

	$version = $status["Version"];

	$opensim = trim($version);

	// Count the length of the returning string
	$length = strlen($opensim);

	if ($length > 2)
	{
		$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set version = '".$opensim."'" .
				" where serverIP = '" . mysql_escape_string($host) . "' AND ".
				"serverPort = '" . mysql_escape_string($port) . "'");
	}
	else
	{
		$DbLink->query("UPDATE ".C_STATS_REGIONS_TBL." set version = 'Unknown'" .
				" where serverIP = '" . mysql_escape_string($host) . "' AND ".
				"serverPort = '" . mysql_escape_string($port) . "'");
	}
}

// Adding a clean query to the parser

$DbLink->query("SELECT serverIP, serverPort FROM ".C_STATS_REGIONS_TBL." WHERE `failcounter` > 3");

while(list($serverIP,$serverPort) = $DbLink->next_record())
{
	$DbLink->query("DELETE FROM ".C_STATS_REGIONS_TBL." WHERE serverIP = '". mysql_escape_string($serverIP). "' AND serverPort = '". mysql_escape_string($serverPort) ."'");
}

// Getting 1 region at a time

$query = "SELECT serverIP, serverPort FROM ".C_STATS_REGIONS_TBL." WHERE `lastcheck` < ".$now." limit 0,1";

$DbLink->query($query);

while(list($serverIP,$serverPort) = $DbLink->next_record())
{
	CheckHost($serverIP, $serverPort);
}
?>