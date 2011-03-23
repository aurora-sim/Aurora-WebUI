<?
if($_SESSION[ADMINID]){

$DbLink = new DB;
if($_POST[userdata]=="set"){
$DbLink->query("SELECT PrincipalID FROM ".C_USERS_TBL." WHERE FirstName='".cleanQuery($_POST[accfirst])."' and LastName='".cleanQuery($_POST[acclast])."'");
list($CHECKUSER) = $DbLink->next_record();

$DbLink->query("UPDATE ".C_WIUSR_TBL." SET 
realname1 ='".cleanQuery($_POST[fname])."',
realname2 ='".cleanQuery($_POST[lname])."',
adress1 ='".cleanQuery($_POST[street])."',
zip1 ='".cleanQuery($_POST[zip])."',
city1 ='".cleanQuery($_POST[city])."',
country1 ='".cleanQuery($_POST[country])."',
emailadress ='".cleanQuery($_POST[email])."'
WHERE UUID='".cleanQuery($_POST[uuid])."'");

if($CHECKUSER == ''){

$DbLink->query("UPDATE ".C_USERS_TBL." SET 
Name ='".cleanQuery($_POST[name])."'
WHERE PrincipalID='".cleanQuery($_POST[uuid])."'");
}

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=edit&userid=".$_POST[uuid]."';
// -->
</script>";
}

if($_POST[state]=="set"){
$DbLink->query("SELECT PrincipalID,Created FROM ".C_USERS_TBL." WHERE PrincipalID='".cleanQuery($_POST[uuid])."'");
list($uuid,$created) = $DbLink->next_record();

if($_POST[active] !=3){
if($_POST[status]==0){
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET active='".cleanQuery($_POST[status])."' WHERE UUID='".cleanQuery($_POST[uuid])."'");
}else{
$DbLink->query("UPDATE ".C_WIUSR_TBL." SET active='".cleanQuery($_POST[status])."' WHERE UUID='".cleanQuery($_POST[uuid])."'");
}
}else{
if($_POST[status]==1){
$DbLink->query("DELETE FROM ".C_CODES_TBL." WHERE UUID='".cleanQuery($_POST[uuid])."'");
}
}

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=edit&userid=".$_POST[uuid]."';
// -->
</script>";
 
}
$found = array();
$found[0] = json_encode(array('Method' => 'GetProfile', 'WebPassword' => md5(WIREDUX_PASSWORD)
            , 'Name' => cleanQuery($_GET['name'])));
$do_post_requested = do_post_request($found);
$recieved = json_decode($do_post_requested);
$profileTXT = $recieved->{'profile'}->{'AboutText'};
$profileImage = $recieved->{'profile'}->{'Image'};
$created = $recieved->{'account'}->{'Created'};
$uuid = $recieved->{'account'}->{'PrincipalID'};
$diff = $recieved->{'account'}->{'TimeSinceCreated'};
$type = $recieved->{'account'}->{'AccountInfo'};
$partner = $recieved->{'account'}->{'Partner'};
$date = date("D d M Y - g:i A", $created);

$DbLink->query("SELECT PrincipalID,Name FROM ".C_USERS_TBL." WHERE PrincipalID='".cleanQuery($_GET[userid])."'");
list($uuid,$accName) = $DbLink->next_record();

$DbLink->query("SELECT realname1,realname2,adress1,zip1,city1,country1,emailadress FROM ".C_WIUSR_TBL." WHERE UUID='".cleanQuery($_GET[userid])."'");
list($firstnm,$lastnm,$street,$zip,$city,$country,$email) = $DbLink->next_record();

$DbLink->query("SELECT a.active,(SELECT info FROM ".C_CODES_TBL." b WHERE b.uuid = a.uuid ) as confirm FROM ".C_WIUSR_TBL." a where UUID='".cleanQuery($_GET[userid])."'");
list($active,$confirm) = $DbLink->next_record(); 

if($confirm == 'confirm'){
$active=3;
} 
?>



<div id="content">
    <h2><?= SYSNAME ?>: <? echo $webui_admin_edit_manage; ?></h2>
  
    <div id="managepanel">

        <div id="info">
            <p><? echo $webui_admin_edit_manage_info; ?></p>
        </div>
        
        <table>
            <form name="form1" method="post" action="index.php?page=edit">
            <input type="hidden" name="userdata" value="set" />
            <input type="hidden" name="uuid" value="<?=$uuid?>" />
               
            <tr>
                <td class="odd" width="50%"><? echo $webui_admin_edit_manage_userid; ?></td>
                <td class="odd"><?=$uuid?></td>
            </tr>
            
      		  <tr>
		            <td class="even"><? echo $webui_admin_edit_manage_avatar_firstname; ?></td> 
		            <td class="even"><input style="width:99%" name="accfirst" type="text" id="accfirst" value="<?=$accfirst?>"</td>
		        </tr>
		        
            <tr>
		            <td class="odd">
                    <? echo $webui_admin_edit_manage_avatar_lastname; ?>
                </td>
                
                <td class="idd">
                    <input style="width:99%" name="acclast" type="text" id="acclast" value="<?=$acclast?>" />
                </td>
            </tr>
            
            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_real_firstname; ?></td>
                <td class="even">
                    <input style="width:99%" name="fname" type="text" id="fname" value="<?=$firstnm?>" />
                </td>
            </tr>
          
            <tr>
                <td class="odd"><? echo $webui_admin_edit_manage_real_lastname; ?></td>
                <td class="odd"><input style="width:99%" name="lname" type="text" id="lname" value="<?=$lastnm?>" /></td>
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

            <form name="form1" method="post" action="index.php?page=edit">

            <tr>
                <td class="even"><? echo $webui_admin_edit_manage_currentstatus; ?></td>
                <td class="even">
                  <? if($active==1){echo"<font COLOR=#00FF00>$webui_admin_edit_manage_active</font>";}
				            else if($active==3){echo"<font COLOR=#FF0000>$webui_admin_edit_manage_notconf</font>";}
				            else{echo"<font COLOR=#FF0000>$webui_admin_edit_manage_inactive</font>";}
                  ?>
                </td>
            </tr>
              
            <tr>
                <td class="odd"><? echo $webui_admin_edit_manage_setstatus; ?></td>
                <td class="odd">
                    <input type="hidden" name="state" value="set" />
                    <input type="hidden" name="uuid" value="<?=$uuid?>" />
				            <input type="hidden" name="active" value="<?=$active?>" />
                    
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
