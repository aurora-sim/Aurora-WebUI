<?php
if($_SESSION[ADMINID]){

$DbLink = new DB;
if($_POST[userdata]=="set")
{
$found = array();
$found[0] = json_encode(array('Method' => 'EditUser', 'WebPassword' => md5(WEBUI_PASSWORD),
                    'UserID' => cleanQuery($_POST[userid]),
					'Name' => cleanQuery($_POST[name]),
                    'RLName' => cleanQuery($_POST[rlname]),
                    'RLAddress' => cleanQuery($_POST[street]),
                    'RLZip' => cleanQuery($_POST[zip]),
                    'RLCity' => cleanQuery($_POST[city]),
                    'RLCountry' => cleanQuery($_POST[country]),
                    'Email' => cleanQuery($_POST[email])));
$do_post_request = do_post_request($found);

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=adminedit&userid=".$_POST[userid]."';
// -->
</script>";
}

if($_POST[state]=="set")
{
if($_POST[status]==1){
$DbLink->query("UPDATE ".C_USERS_TBL." SET UserLevel='0' WHERE PrincipalID='".cleanQuery($_POST[userid])."'");
}else{
$DbLink->query("UPDATE ".C_USERS_TBL." SET UserLevel='-1' WHERE PrincipalID='".cleanQuery($_POST[userid])."'");
}
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=adminedit&userid=".$_POST[userid]."';
// -->
</script>";
}


$found = array();
$found[0] = json_encode(array('Method' => 'GetProfile', 'WebPassword' => md5(WEBUI_PASSWORD)
            , 'UUID' => cleanQuery($_GET['userid'])));
$do_post_requested = do_post_request($found);
$recieved = json_decode($do_post_requested);
$profileTXT = $recieved->{'profile'}->{'AboutText'};
$profileImage = $recieved->{'profile'}->{'Image'};
$created = $recieved->{'account'}->{'Created'};
$uuid = $recieved->{'account'}->{'PrincipalID'};
$name = $recieved->{'account'}->{'Name'};
$diff = $recieved->{'account'}->{'TimeSinceCreated'};
$type = $recieved->{'account'}->{'AccountInfo'};
$email = $recieved->{'account'}->{'Email'};
$partner = $recieved->{'account'}->{'Partner'};
$rlname = $recieved->{'agent'}->{'RLName'};
$street = $recieved->{'agent'}->{'RLAddress'};
$zip = $recieved->{'agent'}->{'RLZip'};
$city = $recieved->{'agent'}->{'RLCity'};
$country = $recieved->{'agent'}->{'RLCountry'};
$date = date("D d M Y - g:i A", $created);

$DbLink->query("SELECT PrincipalID,Name FROM ".C_USERS_TBL." WHERE PrincipalID='".cleanQuery($_GET[userid])."'");
list($uuid,$accName) = $DbLink->next_record();

$DbLink->query("SELECT UserLevel FROM ".C_USERS_TBL." a where PrincipalID='".cleanQuery($_GET[userid])."'");
list($active) = $DbLink->next_record(); 

if($active == "-1")
	$active = "0";
else
	$active = "1";

?>



<div id="content">
  <div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_manage; ?></h5></div>   
  <div id="managepanel">

        <div id="info">
            <p><?php echo $webui_admin_edit_manage_info; ?></p>
        </div>
        
		<div id="annonce10">
        <table>
            <form name="form1" method="post" action="index.php?page=adminedit">
            <input type="hidden" name="userdata" value="set" />
            <input type="hidden" name="userid" value="<?php echo $uuid ?>" />
               
            <tr>
                <td class="odd" width="50%"><?php echo $webui_admin_edit_manage_userid; ?></td>
                <td class="odd"><?php echo $uuid ?></td>
            </tr>
            
      		  <tr>
		            <td class="even"><?php echo $webui_admin_edit_manage_avatar_name; ?></td> 
		            <td class="even"><input style="width:99%" name="name" type="text" id="name" value="<?php echo $name?>"</td>
		        </tr>
            
            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_real_name; ?></td>
                <td class="even">
                    <input style="width:99%" name="rlname" type="text" id="fname" value="<?php echo $rlname?>" />
                </td>
            </tr>
            
          
            <tr>
                <td class="even"><?php echo $webui_admin_edit_manage_real_street; ?></td>
                <td class="even"><input style="width:99%" name="street" type="text" id="street" value="<?php echo $street ?>" /></td>
            </tr>
            
            <tr>
                <td class="odd"><?php echo $webui_admin_edit_manage_real_zip; ?></td>
                <td class="odd"><input style="width:99%" name="zip" type="text" id="city" value="<?php echo $zip ?>" size="8" /></td>
            </tr>
            
            <tr>                            
                <td class="even"><?php echo $webui_admin_edit_manage_real_city; ?></td>
                <td class="even"><input style="width:99%" name="city" type="text" id="street2" value="<?php echo $city ?>" /></td>                    
            </tr>
            
            <tr>
                <td class="odd"><?php echo $webui_admin_edit_manage_real_country; ?></td>
                <td class="odd">
                    <select style="width:100%" class="box" wide="25" name="country">
                    <?php
                      $DbLink->query("SELECT name FROM ".C_COUNTRY_TBL." ORDER BY name ASC ");
	                     while(list($COUNTRYDB) = $DbLink->next_record())
	                     { ?>
	                       <option <?php if($country == $COUNTRYDB){ echo"selected";} ?> value="<?php echo $COUNTRYDB ?>"><?php echo $COUNTRYDB ?></option>
                         <?php } ?>
                    </select>
                </td>
            </tr>
      
      		  <tr>
                <td class="even"><?php echo $webui_admin_edit_manage_real_email; ?></td>
                <td class="even"><input style="width:99%" name="email" type="text" id="email" value="<?php echo $email ?>" /></td>
            </tr>

            
            <tr>
                <td colspan="2" class="odd">
                    <div align="center">
                        <input type="submit" name="Submit2" value="<?php echo $webui_admin_edit_manage_savechanges; ?>" />
                    </div>
                </td>
            </tr>
            </form>

            <form name="form1" method="post" action="index.php?page=adminedit">

            <tr>
                <td class="even"><?php echo $webui_admin_edit_manage_currentstatus; ?></td>
                <td class="even">
                  <?php if($active==1){echo"<font COLOR=#00FF00>$webui_admin_edit_manage_active</font>";}
				     else{echo"<font COLOR=#FF0000>$webui_admin_edit_manage_inactive</font>";}
                  ?>
                </td>
            </tr>
              
            <tr>
                <td class="odd"><?php echo $webui_admin_edit_manage_setstatus; ?></td>
                <td class="odd">
                    <input type="hidden" name="state" value="set" />
                    <input type="hidden" name="userid" value="<?php echo $uuid ?>" />
                    
                    <select name="status">
                        <option value="1"><?php echo $webui_admin_edit_manage_active; ?></option> 
                        <option value="0"><?php echo $webui_admin_edit_manage_inactive; ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="odd">
                    <div align="center">
                        <input type="submit" name="Submit" value="<?php echo $webui_admin_edit_manage_savestatus; ?>" />
                    </div>
                </td>
            </tr>
            
            </form>
        </table>
		</div>
    </div>
</div>
<?php } ?>