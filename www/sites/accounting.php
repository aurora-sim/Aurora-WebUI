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
// Get a Database connection
$DbLink = new DB;

if($_POST[purge])
{
	$query = "SELECT COUNT(*) FROM ".C_APPEARANCE_TBL." WHERE PrincipalID ='".$_SESSION[USERID]."'";
	$DbLink->query($query);
	list($numrows) = $DbLink->next_record();

	if($numrows > 0)
	{
		$remove = "DELETE FROM ".C_APPEARANCE_TBL." WHERE PrincipalID ='".$_SESSION[USERID]."'";
		
		$DbLink = new DB;
		$DbLink->query($remove);
		
		$ERRORS = "Succesfully removed your appearance";
	}
	else
	{
		$ERRORS = "Could not find a appearance for you";
	}
}
?>

<table width="100%" height="425" border="0" align="center">
  <tr>
    <td valign="top">
      <table width="50%" border="0" align="center">
	      <tr>
          <td><p align="center" class="Stil1">Additional Account settings</p></td>
        </tr>
      </table>
      
      <br />
      
      <table width="64%" height="19" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#666666">
        <tr>
          <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><strong>Purge Avatar Appearance</strong></div></td>
        </tr>
        
          <? if($ERRORS){?>
      
        <tr>
          <td colspan="2" valign="top" bgcolor="#666666"><div align="center"><?=$ERRORS?></div></td>
        </tr>
	
        <? } ?>
	
        <form name="form1" method="post" action="index.php?page=accounting">
          <tr>
            <td valign="top" align="center" bgcolor="#FFFFFF"><input type="submit" name="purge" value="Purge my Avatar Appearance"></td>
          </tr>
	     </form>
    </table>
  </td>
</tr>
</table>
<? } ?>
