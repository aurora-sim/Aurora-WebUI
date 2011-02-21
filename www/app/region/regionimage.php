<?
include("../../settings/config.php");
include("../../settings/mysql.php");

if($_GET[x] && $_GET[y])
{
	$DbLink = new DB;
	$DbLink->query("SELECT uuid,serverIP,serverHttpPort FROM ".C_REGIONS_TBL." where locX='$_GET[x]' and locY='$_GET[y]'");
	list($UUID,$serverIP,$serverHttpPort) = $DbLink->next_record();
}
$SERVER ="http://$serverIP:$serverHttpPort";
$UUID = str_replace("-", "", $UUID);
$source = $SERVER."/index.php?method=regionImage".$UUID."";
// Getting a handle setup to read the data
$handle = fopen($source,'r');
while (!feof($handle)) 
{
	$file_content .= fread($handle,1024);
}
fclose($handle);
echo $file_content;
?>
