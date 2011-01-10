<?
if($_SESSION[USERID] == "")
{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}
else
{ 
require_once("uuid.inc.php");

	if($_POST[makefile])
	{
		// Checking if the coords that the user gave already has a region settled
		$query = "SELECT COUNT(*) FROM ".C_REGIONS_TBL." where locX='".$_POST[region_location_x]."' and locY='".$_POST[region_location_y]."'";
		$DbLink->query($query);
		list($count) = $DbLink->next_record();
		if ($count > 0)
		{
		$GENERATED = "There is already a region at the coordinates ".$_POST[region_location_x].", ".$_POST[region_location_y].". ini couldn't be made";
		}
		else
		{		
		$GENERATED = '['.$_POST[region_name].']RegionUUID="'.$_POST[region_uuid].'" Location="'.$_POST[region_location_x].','.$_POST[region_location_y].'" InternalAddress="0.0.0.0" InternalPort="'.$_POST[region_ip_port].'" AllowAlternatePorts="false" ExternalHostName="'.$_POST[region_ip_hostname].'"';
		}
	}
?>
<div style="height:100%">
<br />
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCC00">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td bgcolor="#FFFFFF">
          <div align="center"><b>Generate a new region file<br></b></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<?
if($GENERATED)
{
?>
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCC00">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
	  <tr>
        <td bgcolor="#FFFFFF">
          <div align="center"><b>This is your region ini file:</b></div></td>
      </tr>
	  <tr>
        <td bgcolor="#FFFFFF">
          <div align="center"><textarea cols=120 rows=6><?=$GENERATED?></textarea></div></td>
      </tr>
    </table></td>
  </tr>
</table>
<BR>
<?
}
?>
<form name="form1" method="POST" action="index.php?page=region-generate">
<TABLE width="80%" border=0 align=center cellpadding="0" cellspacing="0">
   <TR>
      <TD width="221" height="40" align="center" valign="bottom" background="images/main/regions_middle.jpg"><b>Region UUID</b></TD>
	  <TD width="221" height="40" align="center" valign="bottom" background="images/main/regions_middle.jpg"><b><input type=text name=region_uuid size=80 readonly value=<?$str = UUID::generate(UUID::UUID_TIME, UUID::FMT_STRING, "osgrid");echo $str;?>></b></TD>
    </TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Name</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_name size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Location X</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_location_x size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Location Y</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_location_y size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - IP Port</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_ip_port size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - External Hostname</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_ip_hostname size=80></TD>
	</TR>
	<?
	$DbLink->query("SELECT FirstName,LastName FROM ".C_USERS_TBL." where PrincipalID='".$_SESSION[USERID]."'");
	list($first,$last) = $DbLink->next_record();
	?>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region Owner - First Name</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_master_first readonly size=80 value=<?echo $first?>></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region Owner - Last Name</b></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_master_last readonly size=80 value=<?echo $last?>></TD>
	</TR>
	<TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD colspan=2 width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=submit name=makefile value="Make the file"></TD>
	</TR>
</TABLE>
</form>
</div>
<?
}
?>