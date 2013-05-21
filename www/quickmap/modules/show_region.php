<?php
include("../includes/config.php");
include("../includes/header.php");
include("../languages/translator.php");

$region = mysql_real_escape_string($_GET['region']);

if($region)
{
    mysql_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass);
    mysql_select_db($CONF_db_database);

    $z = mysql_query("SELECT RegionUUID, RegionName, Access, Flags, Info, LocX, LocY, SizeX, SizeY, OwnerUUID FROM gridregions where RegionUUID='$region'");
    while($regiondb = mysql_fetch_array($z))
    {
        $UUID           = $regiondb['RegionUUID'];
        $regionName     = $regiondb['RegionName'];
        $regionMaturity = $regiondb['Access'];	
        $locX           = $regiondb['LocX'];
        $locY           = $regiondb['LocY'];
        $sizeX          = $regiondb['SizeX'];
        $sizeY          = $regiondb['SizeY'];
        $owner          = $regiondb['OwnerUUID'];
        $regionOnline   = $regiondb['Flags'];
        $info           = $regiondb['Info'];
        $recieved       = json_decode($info);
        $serverIP       = $recieved->{'serverIP'};
        $serverHttpPort = $recieved->{'serverHttpPort'};
    }
    $arr = Array();

    $SERVER         = "http://$serverIP:$serverHttpPort";
    $REGIONUUID     = str_replace("-", "", $UUID);
    $source         = $SERVER."/index.php?method=regionImage".$REGIONUUID."";

    $y = mysql_query("SELECT FirstName,LastName FROM useraccounts where PrincipalID='$owner'");
    while($ownerdb=mysql_fetch_array($y))
    {
        $firstN = $ownerdb[FirstName];
        $lastN  = $ownerdb[LastName];
    }
}
?>

<div id="content">
    <table id="quickmap_show_region">
    <tr>
        <td class="first">

        <table id="show_region">
        <tr>
            <td class="right"><span class="styleTitel"><?php echo $CONF_txt_region; ?>:&nbsp;</span></td>
            <td class="left"><span class="styleTitel1"><?php echo $regionName; ?></span></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_status; ?>:&nbsp;</span></td> 
            <td class="left"><?php if($regionOnline){echo"<span class='styleOnline'>$CONF_txt_status_online</span>";}else{echo"<span class='styleOffline'>$CONF_txt_status_offline</span>";} ?></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?=$CONF_txt_maturity?>:&nbsp;</span></td> 
            <td class="left"><?php if($regionMaturity == '13'){echo"<span>$CONF_txt_maturity_general</span>";}elseif($regionMaturity=='21'){echo"<span>$CONF_txt_maturity_mature</span>";}elseif($regionMaturity=='42'){echo"<span>$CONF_txt_maturity_adult</span>";} ?></td>
        </tr>

        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_region_uuid;?>:&nbsp;</span></td>
            <td class="left"><span class="styleDesc"> <?php echo $UUID?></span></td>
        </tr>

        <tr>
            <?php if ($locX > 80000) {$locX = $locX / 256; $locY = $locY / 256;} ?>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_coordinates; ?>:&nbsp;</span></td>
            <td class="left"><span class="styleDesc"> X: <?php echo $locX; ?>&nbsp;&nbsp; Y: <?php echo $locY; ?></span></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_size;?> X:&nbsp;</span></td> 
            <td class="left"><span class="styleDesc"> <?php echo $sizeX; ?></span></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_size;?> Y:&nbsp;</span></td>
            <td class="left"><span class="styleDesc"> <?php echo $sizeY; ?></span></td>
        </tr>

        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_owner; ?>:&nbsp;</span></td>
            <td class="left"><span class="styleLink"><a href="./show_member.php?agent=<?php echo $owner; ?>"><?php echo $firstN; ?> <?php echo $lastN; ?></a></span></td>
        </tr>
    </table>
    </td>

    <td>
	    <?php if ($regionOnline) { ?>
            <img class="mapimage" src="<?php echo $source ?>" alt="<?php echo $regionName; ?>" title="<?php echo $regionName; ?>" width="<?php echo $CONF_image_size; ?>" height="<?php echo $CONF_image_size; ?>" />
        <?php } else { ?>
            <img class="mapimage" src="../images/offline.jpg" alt="<?php echo $CONF_txt_noregimage?>" title="<?php echo $CONF_txt_noregimage?>" width="<?php echo $CONF_image_size; ?>" height="<?php echo $CONF_image_size; ?>" />
        <?php } ?>
    </td>
    </tr>
</table>

</div></div></div>

<div id="footer">
    <?php include("../includes/footer.php"); ?>
</div><!-- fin de #footer -->

</body></html>