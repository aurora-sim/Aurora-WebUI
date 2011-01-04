<?

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

?>

<style type="text/css">
<!--
.box {font-size: 12px;height: 20;width: 100;}
.Stil12 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif}
.style1 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
-->
</style>
<form name="adminauth" method="post" action="index.php?page=home">
<input type="hidden" name="adminlogin" value="admincheck" />
<input type="hidden" name="check" value="1" />
<table width="245" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="129" class="style1">&nbsp;</td>
    <td width="894" class="style1">Username:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input class="box" type="textfield" name="username" />    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="style1">Password:</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input class="box" type="password" name="password" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <input type="submit" name="Submit" value="Login" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>