<?php
include("../includes/config.php");
include("../includes/header.php");
include("../languages/translator.php");

// $agent = $_GET[agent];
$agent = mysql_real_escape_string($_GET['agent']);

if($agent)
{
    mysql_connect($CONF_db_server,$CONF_db_user,$CONF_db_pass);
    mysql_select_db($CONF_db_database);

    $z = mysql_query("SELECT PrincipalID, FirstName, LastName, Created FROM useraccounts where PrincipalID='$agent'");
    while($userdb=mysql_fetch_array($z))
    {
        $uuid           = $userdb['PrincipalID'];
        $firstN         = $userdb['FirstName'];
        $lastN          = $userdb['LastName'];
        $created        = $userdb['Created'];
    }
	
    $w = mysql_query("SELECT UserID, IsOnline, LastLogin, LastLogout FROM userinfo where UserID='$agent'");
    while($userdb=mysql_fetch_array($w))
    {
        $uuid           = $userdb['UserID'];
        $lastLogin      = $userdb['LastLogin'];
        $lastLogout     = $userdb['LastLogout'];
        $agentOnline    = $userdb['IsOnline'];
    }

    $x = mysql_query("SELECT OwnerUUID, RegionUUID, RegionName FROM gridregions where OwnerUUID='$agent'");
    while($regiondb=mysql_fetch_array($x))
    {
        $uuid           = $regiondb['OwnerUUID'];
        $RegionUUID     = $regiondb['RegionUUID'];
        $RegionName     = $regiondb['RegionName'];
    }

    // $q = mysql_query("SELECT ID, Value FROM userdata where ID='$agent'");
    $q = mysql_query("SELECT Value FROM userdata where ID='$agent'");
    while($imagedb=mysql_fetch_array($q))
    {	
        $value = new SimpleXMLElement($imagedb['Value']);
        // $FirstPick   = $value->map->uuid[1];
        $AvatarPick     = $value->map->uuid[2];
        $profileTXT     = $value->map->string[3];
        $websiteURL     = $value->map->string[5];
    }
	
    // echo "<pre>". var_dump($value). "</pre>";
    // echo "<pre>". print_r($value). "</pre>";
    $source = $IMGURL. "index.php?method=GridTexture&amp;uuid=".$AvatarPick;

    $date        = date("d.m.Y - H:i", $created);
    $last_login  = date("d.m.Y - H:i", $lastLogin);
    $last_logout = date("d.m.Y - H:i", $lastLogout);
}
?>

<div id="content">
    <table id="quickmap_show_member">
    <tr>
        <td class="first">

        <table id="show_member">
        <tr>
            <td class="right"><span class="styleTitel"><?php echo $CONF_txt_citizen; ?>:&nbsp;</span></td> 
            <td class="styleTitel1"><?php echo $firstN; ?> <?php echo $lastN; ?></td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_status; ?>:&nbsp;</span></td> 
            <td class="left"><?php if($agentOnline == '1'){echo"<span class='styleOnline'>$CONF_txt_status_online</span>";}else{echo"<span class='styleOffline'>$CONF_txt_status_offline</span>";} ?>         </td>
        </tr>
      
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_avatar_uuid; ?>:&nbsp;</span></td>
            <td class="styleDesc"><?php echo $uuid; ?></td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_birthday; ?>:&nbsp;</span></td>
            <td class="styleDesc"><?php echo $date; ?></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_lastlogin; ?>:&nbsp;</span></td>
            <td class="styleDesc"><?php echo $last_login; ?></td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_lastlogout; ?>:&nbsp;</span></td>
            <td class="styleDesc"><?php echo $last_logout; ?></td>
        </tr>
      
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_home; ?>:&nbsp;</span></td>
            <td class="styleLink"> <a href="./show_region.php?region=<?=$RegionUUID?>"><?=$RegionName?></a></td>
        </tr>
      
        <tr>
            <td class="right">&nbsp;</td>
            <td class="left">&nbsp;</td>
        </tr>
      
        <tr>
            <td class="right"><span class="styleItem"><?php echo $CONF_txt_profiletext; ?>:&nbsp;</span></td>
            <td class="styleDesc">
            <?php if ($profileTXT) {echo $profileTXT;} else {echo $CONF_txt_noprofile;} ?></td>
        </tr>

        <tr>
            <td class="right"><span class="styleItem">Website:&nbsp;</span></td>
            <td><?php if ($websiteURL) {echo "<a target='_blank' href='$websiteURL'>$websiteURL</a>";} else {echo $CONF_txt_noprofile;} ?></td>
        </tr>

    </table>
    </td>
    <td>
        <?php
            if($AvatarPick == "00000000-0000-0000-0000-000000000000" || $AvatarPick == "") { ?>
                <img class="avatarimage" src="../images/no_profile.jpg" alt="<?php echo $CONF_txt_noproimage; ?>" title="<?php echo $CONF_txt_noproimage; ?>" width="<?php echo $CONF_image_size; ?>" height="<?php echo $CONF_image_size; ?>" />
            <?php } else { ?>
                <img class="mapimage" src="<?php echo $source ?>" alt="<?php echo $firstN; ?> <?php echo $lastN; ?>" title="<?php echo $firstN; ?> <?php echo $lastN; ?>" width="<?php echo $CONF_image_size; ?>" height="<?php echo $CONF_image_size; ?>" />
        <?php } ?>
    </td>
  </tr>
</table>
</div></div></div>

<div id="footer">
    <?php include("../includes/footer.php"); ?>
</div><!-- fin de #footer -->

</body></html>