<?
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
$DbLink->query("SELECT UserID FROM ".C_USERINFO_TBL." where IsOnline = 1 AND ".
				"LastLogin < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
				"LastLogout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
				"ORDER BY LastLogin DESC");
$NOWONLINE = 0;

while(list($UUID) = $DbLink->next_record())
{
  // Let's get the user info
  $DbLink3 = new DB;
  $DbLink3->query("SELECT CurrentRegionID from ".C_USERINFO_TBL." where UserID = '".cleanQuery($UUID)."'");
  list($RegionUUID) = $DbLink3->next_record();

  $DbLink2 = new DB;
  $DbLink2->query("SELECT FirstName, LastName from ".C_USERS_TBL." where PrincipalID = '".cleanQuery($UUID)."'");
  list($firstname, $lastname) = $DbLink2->next_record();
  $username = $firstname." ".$lastname;
  
  // Let's get the region information
  $DbLink3 = new DB;
  $DbLink3->query("SELECT RegionName from ".C_REGIONS_TBL." where RegionUUID = '".cleanQuery($RegionUUID)."'");
  list($region) = $DbLink3->next_record();
  if ($region != "")
  {
    $NOWONLINE = $NOWONLINE + 1;
  }
}

$DbLink->query("SELECT count(*) FROM ".C_USERINFO_TBL." where LastLogin > UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 2419200))");
list($LASTMONTHONLINE) = $DbLink->next_record();
 
$DbLink->query("SELECT count(*) FROM ".C_USERS_TBL."");
list($USERCOUNT) = $DbLink->next_record();

$DbLink->query("SELECT count(*) FROM ".C_REGIONS_TBL."");
list($REGIONSCOUNT) = $DbLink->next_record();	
?>


  <table>
    <tr>
      <td><div id="gridstatus1">
        <? echo $webui_grid_status; ?>: <? if($GRIDSTATUS){ ?>
        <span class=online><? echo $webui_grid_status_online; ?></span>
        <? } else { ?>
        <span class=offline><? echo $webui_grid_status_offline; ?></span>
        <? } ?></div>         
      </td>
      
      <td><div id="gridstatus2"><? echo $webui_total_users; ?>: <?=$USERCOUNT?></div></td>
      <td><div id="gridstatus3"><? echo $webui_total_regions; ?>: <?=$REGIONSCOUNT?></div></td>
      <td><div id="gridstatus4"><? echo $webui_unique_visitors; ?>: <?=$LASTMONTHONLINE?></div></td>
      <td><div id="gridstatus5"><strong><a href="index.php?page=onlineusers"><? echo $webui_online_now; ?></a>: <?=$NOWONLINE?></strong></div></td>
    </tr>
  </table>
