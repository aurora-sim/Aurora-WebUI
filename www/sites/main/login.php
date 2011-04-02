<div id="content">
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_login; ?></h5></div>
    <div id="login">
        <form action="index.php" method="POST" onsubmit="if (!validate(this)) return false;">
            <table>
				<tr><td class="error" colspan="2" align="center" id="error_message"><?=$_SESSION[ERROR];$_SESSION[ERROR]="";?><?=$_GET[ERROR]?></td></tr>
                <tr>
                    <td class="odd"><span id="logname_label"><? echo $webui_user_name ?>*</span></td>
                    <td class="odd"><input require="true" label="logname_label" id="login_input" name="logname" type="text" value="<?= $_POST[logname] ?>" /></td>
                </tr>
                <tr>
                    <td class="even"><span id="password_label"><? echo $webui_password ?>*</span></td>
                    <td class="even"><input require="true" label="password_label" id="login_input" type="password" name="logpassword" /></td>
                </tr>
                <tr>
                    <td class="odd"><a href="index.php?page=forgotpass"><? echo $webui_forgot_password ?></a></td>                
                    <td class="odd"><button id="Submit" type="Submit" name="Submit" value="<? echo $webui_login ?>"><? echo $webui_login; ?></button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
