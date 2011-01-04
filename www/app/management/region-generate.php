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
		$GENERATED = "There is already a region at the coordinates ".$_POST[region_location_x].", ".$_POST[region_location_y].". XML couldn't be made";
		}
		else
		{		
		$GENERATED = '<Root><Config sim_UUID="'.$_POST[region_uuid].'" sim_name="'.$_POST[region_name].'" sim_location_x="'.$_POST[region_location_x].'" sim_location_y="'.$_POST[region_location_y].'" internal_ip_address="0.0.0.0" internal_ip_port="'.$_POST[region_ip_port].'" allow_alternate_ports="false" external_host_name="'.$_POST[region_ip_hostname].'" master_avatar_uuid="00000000-0000-0000-0000-000000000000" master_avatar_first="'.$_POST[region_master_first].'" master_avatar_last="'.$_POST[region_master_last].'" master_avatar_pass="'.$_POST[region_master_password].'" lastmap_uuid="" lastmap_refresh="" nonphysical_prim_max="0" physical_prim_max="0" clamp_prim_size="false" object_capacity="0"></Root>';
		}
	}
?>
<DIV style="height:100%">
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
          <div align="center"><b>This is your region XML file:</b></div></td>
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
      <TD width="221" height="40" align="center" valign="bottom" background="images/main/regions_middle.jpg"><b>Region UUID</b></a></TD>
	  <TD width="221" height="40" align="center" valign="bottom" background="images/main/regions_middle.jpg"><b><input type=text name=region_uuid size=80 readonly value=<?$str = UUID::generate(UUID::UUID_TIME, UUID::FMT_STRING, "osgrid");echo $str;?>></b></a></TD>
    </TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Name</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_name size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Location X</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_location_x size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - Location Y</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_location_y size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - IP Port</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_ip_port size=80></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region - External Hostname</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_ip_hostname size=80></TD>
	</TR>
	<?
	$DbLink->query("SELECT FirstName,LastName FROM ".C_USERS_TBL." where PrincipalID='".$_SESSION[USERID]."'");
	list($first,$last) = $DbLink->next_record();
	?>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region Owner - First Name</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_master_first readonly size=80 value=<?echo $first?>></TD>
	</TR>
    <TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><b>Region Owner - Last Name</b></a></TD>
      <TD width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=text name=region_master_last readonly size=80 value=<?echo $last?>></TD>
	</TR>
	<TR style='BACKGROUND-COLOR: #e8eff5'>
      <TD colspan=2 width="221" height="40" align="center" valign="middle" bgcolor="#FFFFFF"><input type=submit name=makefile value="Make the file"></a></TD>
	</TR>
</TABLE>
</FORM>
<?
}
?>