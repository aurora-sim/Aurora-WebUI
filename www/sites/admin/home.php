<?
if ($_SESSION[ADMINID]) {
?>
    <div id="adminnote">
        <tr>
            <td valign="top"><p><strong>Welcome to the Aurora Admin Panel </strong><br />
                    <br />
                    Here you can create users, edit the login screen, and more.
                    <br />
            </td>
        </tr>    
    </div>
<?
} else {
?>
    <div id="content"><h2><?= SYSNAME ?>: <? echo $wiredux_admin_login ?></h2>
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
                        <td class="odd"></td>
                        <td class="odd"><input id="login_bouton" style="cursor:pointer" type="submit" name="Submit" value="<? echo $wiredux_admin_login ?>" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<? } ?>