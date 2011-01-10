<?
$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();

// Doing it the same as the Who's Online now part
$DbLink = new DB;
	$DbLink->query("SELECT UserID FROM ".C_GRIDUSER_TBL." where Online = 1 AND ". 
					"Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
					"Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
					"ORDER BY Login DESC");
	while(list($UUID) = $DbLink->next_record())
	{
		// Let's get the user info
		$DbLink2 = new DB;
		$DbLink2->query("SELECT username, lastname from ".C_USERS_TBL." where UUID = '".$UUID."'");
		list($firstname, $lastname) = $DbLink2->next_record();
		$DbLink3 = new DB;
		$DbLink3->query("SELECT RegionID from ".C_PRESENCE_TBL." where UserID = '".$UUID."'");
		list($regionUUID) = $DbLink3->next_record();
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

if(($_GET[btn]=="") and ($ERROR == "")){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home&btn=1';
// -->
</script>";
}else if(($_GET[btn]=="") and ($ERROR != "")){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home&btn=1&error=$ERROR';
// -->
</script>";
}

?>

<style type="text/css">
<!--
.txtcolor {color: #cccccc}
.placeholder{font-size: 3px}
#topright {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; Z-INDEX: 30; RIGHT: 40px; PADDING-BOTTOM: 0px; MARGIN: 0px; COLOR: #cccccc; PADDING-TOP: 0px; POSITION: absolute; TOP: 165px
}
-->
</style>
<?
$DbLink = new DB;
$DbLink->query("SELECT content FROM ".C_PAGE_TBL." WHERE id='1'");
list($content) = $DbLink->next_record();
?>
 
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">   
	<div style="height:100%;">
    <?=$content?>    
	</div>
	</td>
  </tr>
</table>
