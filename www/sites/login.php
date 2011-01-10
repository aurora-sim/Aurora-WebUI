
<DIV style="height:100%">
<br />
<table width="300" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td>
           <form action="index.php" method="POST" onSubmit="return Form(this)">
                    <tr>
                        <div align="center"><span class="style1">First Name</span></div>
                    </tr>
                    <tr>
                        <div align="center">
                                <input name="logfirstname" type="text" class="box" value="<?= $_POST[logfirstname] ?>" />
                            </div>
                    </tr>
                    <tr>
                        <div align="center"><span class="style1">Last Name</span></div>
                    </tr>
                    <tr>
                        <div align="center">
                                <input name="loglastname" type="text" class="box" value="<?= $_POST[loglastname] ?>" />
                            </div>
                    </tr>
                    <tr>
                        <div align="center"><span class="style1">Password</span></div>
                    </tr>
                    <tr>
                        <div align="center">
                                <input type="password" name="logpassword" class="box"/>
                            </div>
                    </tr>
                    <tr>
                        <div align="center"><a style="color:#FFFFFF; font-size:13px" href="index.php?page=forgotpass">Forgot my Password</a></div>
                    </tr>
                    <tr>
                        <div align="center">
                                <input style="cursor:pointer" type="submit" name="Submit" value="Login" />
                            </div>
                    </tr>
                </form>
      </tr>
    </table></td>
  </tr>
</table>
</DIV>