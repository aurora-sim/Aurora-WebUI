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
?>
<div style="height:100%">
<br />
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCC00">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td bgcolor="#FFFFFF">
          <div align="center"><b>This menu has been disabled at this moment.<br></b></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<?
}
?>