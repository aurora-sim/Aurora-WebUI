<?
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
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_admin_edit_manage; ?></h5></div>   
  <div id="managepanel">

        <div id="info">
            <p><? echo $webui_admin_edit_manage_info; ?></p>
        </div>
        
        <table>
            <form name="form1" method="post" action="index.php?page=adminedit">
            <input type="hidden" name="userdata" value="set" />
            <input type="hidden" name="userid" value="<?=$uuid?>" />
               
            <tr>
                <td class="odd" width="50%"><? echo $webui_admin_edit_manage_userid; ?></td>
                <td class="odd"><?=$uuid?></td>
            </tr>
            
      		  <tr>
		            <td class="even"><? echo $webui_admin_edit_manage_avatar_name; ?></td> 
		            <td class="even"><input style="width:99%" name="name" type="text" id="name" value="<?=$name?>"</td>
		        </tr>
            
            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_real_name; ?></td>
                <td class="even">
                    <input style="width:99%" name="rlname" type="text" id="fname" value="<?=$rlname?>" />
                </td>
            </tr>
            
          
            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_real_street; ?></td>
                <td class="even"><input style="width:99%" name="street" type="text" id="street" value="<?=$street?>" /></td>
            </tr>
            
            <tr>
                <td class="odd"><? echo $webui_admin_edit_manage_real_zip; ?></td>
                <td class="odd"><input style="width:99%" name="zip" type="text" id="city" value="<?=$zip?>" size="8" /></td>
            </tr>
            
            <tr>                            
                <td class="even"><? echo $webui_admin_edit_manage_real_city; ?></td>
                <td class="even"><input style="width:99%" name="city" type="text" id="street2" value="<?=$city?>" /></td>                    
            </tr>
            
            <tr>
                <td class="odd"><? echo $webui_admin_edit_manage_real_country; ?></td>
                <td class="odd">
                    <select style="width:100%" class="box" wide="25" name="country">
                    <?
                      $DbLink->query("SELECT name FROM ".C_COUNTRY_TBL." ORDER BY name ASC ");
	                     while(list($COUNTRYDB) = $DbLink->next_record())
	                     { ?>
	                       <option <? if($country == $COUNTRYDB){ echo"selected";} ?> value="<?=$COUNTRYDB?>"><?=$COUNTRYDB?></option>
                         <? } ?>
                    </select>
                </td>
            </tr>
      
      		  <tr>
                <td class="even"><? echo $webui_admin_edit_manage_real_email; ?></td>
                <td class="even"><input style="width:99%" name="email" type="text" id="email" value="<?=$email?>" /></td>
            </tr>

            
            <tr>
                <td colspan="2" class="odd">
                    <div align="center">
                        <input type="submit" name="Submit2" value="<? echo $webui_admin_edit_manage_savechanges; ?>" />
                    </div>
                </td>
            </tr>
            </form>

            <form name="form1" method="post" action="index.php?page=adminedit">

            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_currentstatus; ?></td>
                <td class="even">
                  <? if($active==1){echo"<font COLOR=#00FF00>$webui_admin_edit_manage_active</font>";}
				     else{echo"<font COLOR=#FF0000>$webui_admin_edit_manage_inactive</font>";}
                  ?>
                </td>
            </tr>
              
            <tr>
                <td class="odd"><? echo $webui_admin_edit_manage_setstatus; ?></td>
                <td class="odd">
                    <input type="hidden" name="state" value="set" />
                    <input type="hidden" name="userid" value="<?=$uuid?>" />
                    
                    <select name="status">
                        <option value="1"><? echo $webui_admin_edit_manage_active; ?></option> 
                        <option value="0"><? echo $webui_admin_edit_manage_inactive; ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="odd">
                    <div align="center">
                        <input type="submit" name="Submit" value="<? echo $webui_admin_edit_manage_savestatus; ?>" />
                    </div>
                </td>
            </tr>
            
            </form>
        </table>
    </div>
</div>
<? } ?>
