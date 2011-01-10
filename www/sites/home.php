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
<div id="topright">
<table border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td valign="top" align="right"><table cellspacing="0" cellpadding="0" width="300" border="0">
        <tbody>
          <tr>
            <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(images/login_screens/icons/gridbox_tl.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"><img height="5" 
            src="images/login_screens/spacer.gif" 
            width="5" /></td>
            <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(images/login_screens/icons/grey.gif); BACKGROUND-REPEAT: repeat-x; HEIGHT: 5px; BACKGROUND-COLOR: #000000"><img height="5" 
            src="images/login_screens/spacer.gif" 
            width="5" /></td>
            <td style="BACKGROUND-POSITION: right top; BACKGROUND-IMAGE: url(images/login_screens/icons/gridbox_tr.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"><img height="5" 
            src="images/login_screens/spacer.gif" 
            width="5" /></td>
          </tr>
          <tr>
            <td style="BACKGROUND-POSITION: left top; BACKGROUND-IMAGE: url(images/login_screens/icons/grey.gif); WIDTH: 5px; BACKGROUND-REPEAT: repeat-y; BACKGROUND-COLOR: #000000"></td>
            <td style="FONT-SIZE: 1.2em; COLOR: #ccc; BACKGROUND-COLOR: #000"><table cellspacing="0" cellpadding="1" width="100%" border="0">
              <tbody>
                <tr>
                  <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align="left"><span class="txtcolor"><strong>GRID 
                    STATUS:</strong></span></td>
                  <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" align="right"><? if($GRIDSTATUS == '1'){?>
                          <span style="FONT-WEIGHT: bold; COLOR: #12d212">ONLINE</span>
                          <? }else {?>
                          <span style="FONT-WEIGHT: bold; COLOR: #ea0202">OFFLINE</span>
                          <? } ?>
                  </td>
                </tr>
              </tbody>
            </table>
                  <div style="BACKGROUND-IMAGE: url(images/login_screens/icons/grey_dot.gif); MARGIN: 0px; BACKGROUND-REPEAT: repeat-x;MARGIN: 1px 0px 0px"><img 
            height="1" 
            src="images/login_screens/spacer.gif" 
            width="1" /></div>
              <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tbody>
                      <tr bgcolor="#151515">
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left"><span class="txtcolor">Total Users:</span></td>
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" 
                  width="1%"><span class="txtcolor">
                          <?=$USERCOUNT?>
                        </span></td>
                      </tr>
                      <tr bgcolor="#000000">
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left"><span class="txtcolor">Total Regions:</span></td>
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" 
                  width="1%"><span class="txtcolor">
                          <?=$REGIONSCOUNT?>
                        </span></td>
                      </tr>
                      <tr bgcolor="#151515">
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left"><span class="txtcolor">Unique Visitors last 30 days:</span></td>
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" 
                  width="1%"><span class="txtcolor">
                          <?=$LASTMONTHONLINE?>
                        </span></td>
                      </tr>
                      <tr bgcolor="#000000">
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="left"><span class="txtcolor"><strong>Online Now:</strong></span></td>
                        <td style="PADDING-RIGHT: 3px; PADDING-LEFT: 3px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px" valign="top" nowrap="nowrap" align="right" 
                  width="1%"><span class="txtcolor"><strong>
                          <?=$NOWONLINE?>
                        </strong></span></td>
                      </tr>
                    </tbody>
                </table></td>
            <td style="BACKGROUND-POSITION: right top; BACKGROUND-IMAGE: url(images/login_screens/icons/grey.gif); WIDTH: 5px; BACKGROUND-REPEAT: repeat-y; BACKGROUND-COLOR: #000000"></td>
          </tr>
          <tr>
            <td style="BACKGROUND-POSITION: left bottom; BACKGROUND-IMAGE: url(images/login_screens/icons/gridbox_bl.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"></td>
            <td style="BACKGROUND-POSITION: left bottom; BACKGROUND-IMAGE: url(images/login_screens/icons/grey.gif); BACKGROUND-REPEAT: repeat-x; HEIGHT: 5px; BACKGROUND-COLOR: #000000"></td>
            <td style="BACKGROUND-POSITION: right bottom; BACKGROUND-IMAGE: url(images/login_screens/icons/gridbox_br.png); WIDTH: 5px; BACKGROUND-REPEAT: no-repeat; HEIGHT: 5px"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</div>
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
