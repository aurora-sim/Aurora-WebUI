<?
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
include("settings/config.php");
include("settings/mysql.php");

$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();


$found = array();
$found[0] = json_encode(array('Method' => 'OnlineStatus', 'WebPassword' => md5(WIREDUX_PASSWORD)));
$do_post_request = do_post_request($found);
$recieved = json_decode($do_post_request);
$GRIDSTATUS = $recieved->{'Online'};
    
// Doing it the same as the Who's Online now part
$DbLink = new DB;
$DbLink->query("SELECT UserID FROM ".C_GRIDUSER_TBL." where Online = 1 AND ". 
				"Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
				"Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
				"ORDER BY Login DESC");
$NOWONLINE = 0;
while(list($UUID) = $DbLink->next_record())
{
	// Let's get the user info
	$DbLink3 = new DB;
	$DbLink3->query("SELECT RegionID from ".C_PRESENCE_TBL." where UserID = '".$UUID."'");
	list($regionUUID) = $DbLink3->next_record();

	$DbLink2 = new DB;
	$DbLink2->query("SELECT username, lastname from ".C_USERS_TBL." where UUID = '".$UUID."'");
	list($firstname, $lastname) = $DbLink2->next_record();
	$username = $firstname." ".$lastname;
	// Let's get the region information
	$DbLink3 = new DB;
	$DbLink3->query("SELECT regionName from ".C_REGIONS_TBL." where UUID = '".$regionUUID."'");
	list($region) = $DbLink3->next_record();
	if ($region != "")
	{
	$NOWONLINE = $NOWONLINE + 1;
	}
}

$DbLink->query("SELECT count(*) FROM ".C_GRIDUSER_TBL." where Login > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
list($LASTMONTHONLINE) = $DbLink->next_record();
 
$DbLink->query("SELECT count(*) FROM ".C_USERS_TBL."");
list($USERCOUNT) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM ".C_REGIONS_TBL."");
list($REGIONSCOUNT) = $DbLink->next_record();
		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<TITLE><?=SYSNAME?> Login</TITLE>
<LINK href="loginscreen/style.css" type=text/css rel=stylesheet>
<SCRIPT src="loginscreen/resize.js" type=text/javascript></SCRIPT>
<SCRIPT src="loginscreen/imageswitch.js" type=text/javascript></SCRIPT>

<SCRIPT>
$(document).ready(function(){
bgImgRotate();
});
</SCRIPT>

<DIV id=top_image><IMG height=139 
src="images/login_screens/logo.png" width=307>
</DIV>
<DIV id=bottom_left>
<?
include("loginscreen/special.php");
?>
<BR>
<DIV id=regionbox>
<? 
include("loginscreen/region_box.php"); 
?>
</DIV>
</DIV>

<IMG id=mainImage src="images/login_screens/spacer.gif"> 
<DIV id=bottom>
<DIV id=news>
<? include("loginscreen/news.php"); ?>
</DIV></DIV>
<DIV id=topright>
<br />
<br />
<br />
<DIV id=gridstatus>
<? include("loginscreen/gridstatus.php"); ?>
</DIV>
<br />
<DIV id=Infobox>
<? 
if(($INFOBOX=="1")&&($BOXCOLOR=="white")){
include("loginscreen/box_white.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="green")){
include("loginscreen/box_green.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="yellow")){
include("loginscreen/box_yellow.php"); 
}else if(($INFOBOX=="1")&&($BOXCOLOR=="red")){
include("loginscreen/box_red.php"); 
}
function do_post_request($found)
{
    $params = array('http' => array(
              'method' => 'POST',
              'content' => implode(',', $found)
            ));
    if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    $timeout = 3;
    $old = ini_set('default_socket_timeout', $timeout);
    $fp = @fopen(WIREDUX_SERVICE_URL, 'rb', false, $ctx);
    ini_set('default_socket_timeout', $old);
    stream_set_timeout($file, $timeout);
    stream_set_blocking($file, 0);
    if (!$fp) {
    //throw new Exception("Problem with " . WIREDUX_SERVICE_URL . ", $php_errormsg");
      return false;
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    //throw new Exception("Problem reading data from " . WIREDUX_SERVICE_URL . ", $php_errormsg");
  }
  return $response;
}
?>
</DIV>
</DIV>