<?
$DbLink = new DB;

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM ".C_INFOWINDOW_TBL." ");
list($GRIDSTATUS,$INFOBOX,$BOXCOLOR,$BOX_TITLE,$BOX_INFOTEXT) = $DbLink->next_record();

$found = array();
$found[0] = json_encode(array('Method' => 'OnlineStatus', 'WebPassword' => md5(WEBUI_PASSWORD)));
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

<div id="gridstatus">
<table>
  <tbody>
  <tr>
    <td>
      <table>
        <tbody>
        <tr>
          <td class=gridbox_tl><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td>
          <td class=gridbox_t><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td>
          <td class=gridbox_tr><img height=5 width=5 src="images/login_screens/spacer.gif" alt="" /></td>          
        </tr>
        <tr>
          <td class=gridbox_l></td>
          <td class=black_content>
            <table width="100%">
              <tbody>
              <tr bgColor=#000000>
                <td class=gridtext align=left><strong><? echo $webui_grid_status; ?>:</strong></td>
                  <td class=gridtext align=right>
                   <? if($GRIDSTATUS){ ?>
                   <span class=online><? echo $webui_grid_status_online; ?></span>
                    <? } else { ?>
                    <span class=offline><? echo $webui_grid_status_offline; ?></span>
                    <? } ?>
                 </td>
              </tr>
              </tbody>
            </table>
            
            <div class="linegrey"></div>
            <table cellSpacing=0 cellPadding=0>
              <tbody>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_total_users; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$USERCOUNT?></td>
              </tr>
              <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_total_regions; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$REGIONSCOUNT?></td>
              </tr>
              <tr bgColor=#151515>
                <td class=gridtext vAlign=top noWrap align=left><? echo $webui_unique_visitors; ?>:</td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><?=$LASTMONTHONLINE?></td>
              </tr>
			  <tr bgColor=#000000>
                <td class=gridtext vAlign=top noWrap align=left><strong><a href="index.php?page=onlineusers"><? echo $webui_online_now; ?></a>:</strong></td>
                <td class=gridtext vAlign=top noWrap align=right width="1%"><strong><?=$NOWONLINE?></strong></td>
              </tr>
			  </tbody></table></td>
          <td class=gridbox_r></td></tr>
        <tr>
          <td class=gridbox_bl></td>
          <td class=gridbox_b></td>
          <td class=gridbox_br></td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
</tbody>
</table>
</div><!-- end #gridstatus -->
