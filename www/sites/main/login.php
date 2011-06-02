<script language="javascript" type="text/javascript">
	addEvent(window, "load", function() { document.getElementById("login_input").focus(); } );
</script>
<div id="content">
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_login; ?></h5></div>
    <div id="login">

	<?if ($_GET[next_page]){
	if ($_GET[purchase_id]){?>
	<form action="index.php?page=<?=$_GET[next_page]?>&purchase_id=<?=$_GET[purchase_id]?>" method="POST" onsubmit="if (!validate(this)) return false;">
	<?}else{?>
	<form action="index.php?page=<?=$_GET[next_page]?>" method="POST" onsubmit="if (!validate(this)) return false;">
<?}}else{?>
	<form action="index.php" method="POST" onsubmit="if (!validate(this)) return false;">
<?}?>
        <table>
				        <tr>
                    <td class="error" colspan="2" align="center" id="error_message"><?=$_SESSION[ERROR];$_SESSION[ERROR]="";?><?=$_GET[ERROR]?></td>
                </tr>
                <tr>
                    <td class="odd" width="51%"><span id="logname_label"><? echo $webui_user_name ?>*</span></td>
                    <td class="odd"><div class="roundedinput"><input require="true" label="logname_label" id="login_input" name="logname" type="text" value="<?= $_POST[logname] ?>" /></div></td>
                </tr>
                <tr>
                    <td class="even"><span id="password_label"><? echo $webui_password ?>*</span></td>
                    <td class="even"><div class="roundedinput"><input require="true" label="password_label" id="login_input" type="password" name="logpassword" /></div></td>
                </tr>
                <tr>
                    <td class="odd"><a href="index.php?page=forgotpass"><? echo $webui_forgot_password ?></a></td>                
                    <td class="odd">
                      <div class="center">
                        <button id="login_bouton" type="Submit" name="Submit" value="<? echo $webui_login ?>"><? echo $webui_login; ?></button>
                      </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>