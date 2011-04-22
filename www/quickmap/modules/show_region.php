<? 
include("../includes/config.php");
include("../includes/mt_header.php");
include("../languages/translator.php");

if($_GET[region]){

  mysql_connect($CONF_db_server,$CONF_db_user,$CONF_db_pass);
  mysql_select_db($CONF_db_database);
  $z=mysql_query("SELECT RegionUUID,RegionName,Access,LocX,LocY,SizeX,SizeY,OwnerUUID FROM gridregions where RegionUUID='$_GET[region]'");
  while($regiondb=mysql_fetch_array($z))
  {
    $UUID           = $regiondb[RegionUUID];
    $regionName     = $regiondb[RegionName];  
    $locX           = $regiondb[LocX];
    $locY           = $regiondb[LocY];
    $sizeX          = $regiondb[SizeX];
    $sizeY          = $regiondb[SizeY];
    $owner          = $regiondb[OwnerUUID];
    $regionOnline   = $regiondb[Access];    
    $mapTexture     = $regiondb[regionMapTexture];
  }

  $y = mysql_query("SELECT FirstName,LastName FROM useraccounts where PrincipalID='$owner'");
  while($ownerdb=mysql_fetch_array($y))
  {
    $firstN = $ownerdb[FirstName];
    $lastN  = $ownerdb[LastName];
  }

  $x = mysql_query("SELECT regiomMapTexture FROM wi_regions where id='$regionMapTexture'");
  while($imagedb=mysql_fetch_array($x))
  {
    $data = $imagedb[data];
    $input = fopen( "../tmp/".$mapTexture.".jp2", "w" );
    fwrite( $input, $data, strlen( $data ));
    fclose($input);
  }

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
        <td align="right"><span class="styleTitel"><? echo $CONF_txt_region;?>:&nbsp;</span></td>
        <td><span class="styleTitel1"><?=$regionName?></span></td>
      </tr>
     
      <tr>
        <td align="right" class="styleItem"><?=$CONF_txt_status?>:&nbsp;</td> 
        <td align="left"><? if($regionOnline == '21'){echo"<span class='styleOnline'>Online</span>";}else{echo"<span class='styleOffline'>Offline</span>";} ?>         </td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
            
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_region_uuid;?>:&nbsp;</span></td>
        <td><span class="styleDesc"> <?=$UUID?></span></td>
      </tr>
      
      <tr>
        <? if ($locX > 80000) { $locX = $locX / 256; $locY = $locY / 256; } ?>

        <td align="right"><span class="styleItem"><? echo $CONF_txt_coordinates;?>:&nbsp;</span></td>
        <td><span class="styleDesc"> X: <?=$locX?>&nbsp;&nbsp; Y: <?=$locY?></span></td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_size;?> X:&nbsp;</span></td> 
        <td><span class="styleDesc"> <?=$sizeX?></span></td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_size;?> Y:&nbsp;</span></td>
        <td><span class="styleDesc"> <?=$sizeY?></span></td>
      </tr>
      <tr>
        <td class="styleText">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><span class="styleItem"><? echo $CONF_txt_owner; ?>:&nbsp;</span></td>
        <td><span class="styleLink"><a href="./show_member.php?agent=<?=$owner?>"><?=$firstN?> <?=$lastN?></a></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
      <iframe width="275" height="275" frameborder="0" src="regionimage.php?uuid=<?=$mapTexture?>&image=<?=$CONF_sim_domain?><?=$CONF_install_path?>/tmp/<?=$mapTexture?>.jp2"></iframe>
      </iframe>
    <?
    }
    else
    {
    ?>
    
    <br /><br /><br />
    
    <center>
    <img src="../images/no_region.jpg" alt="<?=$CONF_txt_noregimage?>" title="<?=$CONF_txt_noregimage?>" width="150" height="150" />
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



