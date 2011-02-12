<div id="content"><h2><?= SYSNAME ?>: <? echo $wiredux_login ?></h2>
    <div id="login">
        <form action="index.php" method="POST" onSubmit="return Form(this)">
            <table>
                <tr>
                    <td class="even"> <? echo $wiredux_first_name ?>*</td>
                    <td class="even"><input id="login_input" name="logfirstname" type="text" value="<?= $_POST[logfirstname] ?>" /></td>
                </tr>

                <tr>
                    <td class="odd"> <? echo $wiredux_last_name ?>*</td>
                    <td class="odd"><input id="login_input" name="loglastname" type="text" value="<?= $_POST[loglastname] ?>" /></td>
                </tr>

                <tr>
                    <td class="even"> <? echo $wiredux_password ?>*</td>
                    <td class="even"><input id="login_input" type="password" name="logpassword" /></td>
                </tr>

                <tr>
                    <td class="odd"><a href="index.php?page=forgotpass"><? echo $webui_forgot_password ?></a></td>
                    <td class="odd"><input id="login_bouton" type="submit" name="Submit" value="<? echo $wiredux_login ?>" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
