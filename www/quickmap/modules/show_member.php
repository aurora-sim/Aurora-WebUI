<? 
include("../includes/config.php");
include("../includes/mt_header.php");
include("../languages/translator.php");

$agent = $_GET[agent];

if($agent){

  mysql_connect($CONF_db_server,$CONF_db_user,$CONF_db_pass);
  mysql_select_db($CONF_db_database);

  $z = mysql_query("SELECT PrincipalID,FirstName,LastName,Created FROM useraccounts where PrincipalID='$agent'");
 while($userdb=mysql_fetch_array($z))
   {
     $uuid           = $userdb[PrincipalID];
     $firstN         = $userdb[FirstName];
     $lastN          = $userdb[LastName];
     $created        = $userdb[Created];
   }
 $w = mysql_query("SELECT UserID,IsOnline,LastLogin,LastLogout FROM userinfo where UserID='$agent'");
 while($userdb=mysql_fetch_array($w))
   {
     $uuid           = $userdb[UserID];
     $lastLogin      = $userdb[LastLogin];
     $lastLogout     = $userdb[LastLogout];
     $agentOnline    = $userdb[IsOnline];
   }
 $x = mysql_query("SELECT OwnerUUID,RegionUUID,RegionName FROM gridregions where OwnerUUID='$agent'");
 while($regiondb=mysql_fetch_array($x))
   {
     $uuid           = $regiondb[OwnerUUID];
     $RegionUUID     = $regiondb[RegionUUID];
     $RegionName     = $regiondb[RegionName];
   }
  $q = mysql_query("SELECT Archive FROM wi_appearance where Picture='$profileImage'");
  while($imagedb=mysql_fetch_array($q))
  {
    $data = $imagedb[data];
    $input = fopen( "../tmp/".$profileImage.".jp2", "w" );
    fwrite( $input, $data, strlen( $data ));
    fclose($input);
    if (strlen($data) >= 1000)
    {$counter = 1;}
  }



 $date=date("d.m.Y - H:i",$created);
 $last_login=date("d.m.Y - H:i",$lastLogin);
 $last_logout=date("d.m.Y - H:i",$lastLogout);

 }
?>

<div id="content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="70%" valign="top">
    
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td width="30%">&nbsp;</td>
        <td width="70%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td width="30%" align="right" class="styleTitel"><?=$CONF_txt_citizen?>:&nbsp;</td> 
        <td align="left" class="styleTitel1"><? print $firstN;?> <? print $lastN; ?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_status?>:&nbsp;</td> 
        <td align="left"><? if($agentOnline == '1'){echo"<span class='styleOnline'>Online</span>";}else{echo"<span class='styleOffline'>Offline</span>";} ?>         </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><? echo $CONF_txt_avatar_uuid;?>:&nbsp;</td> 
        <td align="left" class="styleDesc"><?=$uuid?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_birthday?>:&nbsp;</td> 
        <td align="left" class="styleDesc"><?=$date?></td>
      </tr>

      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_lastlogin?>:&nbsp;</td>
        <td align="left" class="styleDesc"><?=$last_login?></td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_lastlogout?>:&nbsp;</td>
        <td align="left" class="styleDesc"><?=$last_logout?></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_home?>:&nbsp;</td>
        <td align="left" class="styleLink"> <a href="./show_region.php?region=<?=$RegionUUID?>"><?=$RegionName?></a></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td align="right" valign="top" class="styleItem"><?=$CONF_txt_profiletext?>:&nbsp;</td>
        <td align="left" class="styleDesc">
        <? if ($profileTXT){ echo "$profileTXT"; } else {echo"$CONF_txt_noprofile";}?></td>
      </tr>
      
    </table>
    </td>
    <td width="45%" valign="top">

	<?
	$SERVER ="http://$serverIP:$serverHttpPort";
	$UUID = str_replace("-", "", $UUID);

    if ($counter == 1)
    { 
    ?> 
      <iframe width="275" height="275" frameborder="0" src="http://metropolis.hypergrid.org/webassets/jp2-to-jpg.php?uuid=<?=$profileImage?>&image=<?=$CONF_sim_domain?><?=$CONF_install_path?>/tmp/<?=$profileImage?>.jp2"> &nbsp;
      </iframe>
    <?
    }
    else
    {
    ?>
    
    <br /><br /><br />
    
    <center>
    <img src="../images/no_profile.jpg" alt="<?=$CONF_txt_noproimage?>" title="<?=$CONF_txt_noproimage?>" width="150" height="150" />
    </center>
    <? } ?>
    </td>
  </tr>
</table>
</div></div></div>



<div id="footer">
<? include("../includes/mt_footer.php"); ?>
</div><!-- fin de #footer -->



</body></html>

