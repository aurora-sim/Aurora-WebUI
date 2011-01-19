<div id="content"><h2><?= SYSNAME ?>: Login</h2>
  <div id="login">
      <form action="index.php" method="POST" onSubmit="return Form(this)">
        <table>
          <tr>         
            <td class="even"> <? echo $wiredux_first_name ?></td>
            <td class="even"><input id="login_input" name="logfirstname" type="text" class="box" value="<?= $_POST[logfirstname] ?>" /> </td>
          </tr>
      
          <tr>
            <td class="odd"> <? echo $wiredux_last_name ?></td>
           <td class="odd"><input id="login_input" name="loglastname" type="text" class="box" value="<?= $_POST[loglastname] ?>" /></td>
          </tr>
    
          <tr>
            <td class="even"> <? echo $wiredux_password ?></td>
            <td class="even"><input id="login_input" type="password" name="logpassword" class="box"/></td>
          </tr>
    
          <tr>
            <td class="odd"><a href="index.php?page=forgotpass"> <? echo $wiredux_forgot_password ?></a></td>
            <td class="odd"><input id="login_bouton" style="cursor:pointer" type="submit" name="Submit" value="<? echo $wiredux_login ?>" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>


