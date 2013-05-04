<?
if ($_SESSION[ADMINID]) {
?>

<div id="content">

    <div id="ContentHeaderLeft"><h5><p><?= SYSNAME ?></p></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><p><? echo $webui_admin_home; ?></p></h5></div>

	<h3><p><? echo $webui_admin_welcome; ?> <? echo $webui_admin_panel; ?> <?= SYSNAME ?></p></h3>
	<div id="info">
		<p><? echo $webui_admin_home_info; ?></p>
	</div>
	<div>
	<p>
<?
	$DbLink2 = new DB;
	$DbLink = new DB;
	if ($_SESSION[USERID])
		$Display = 1;
	else
		$Display = 0;

	if($_SESSION[ADMINID])
		$AdminDisplay = " or (display='3')";
	else
		$AdminDisplay = "";
	$DbLink2->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where parent = '".cleanQuery($_GET[btn])."' and active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
	$a = get_defined_vars();
	while (list($siteid, $siteurl, $sitetarget) = $DbLink2->next_record()) 
	{
		echo "<a href=\"$siteurl&btn=$siteid\"><span>$a[$siteid]</span></a><br/>";
	}
?>
	</p>
	</div>
</div>

  <? } else { ?>
	<div id="content">  	
    <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
    <div id="ContentHeaderCenter"></div>
    <div id="ContentHeaderRight"><h5><? echo $webui_admin_login; ?></h5></div>
		<div id="login">        
			<form action="index.php?page=adminhome" method="POST" onsubmit="if (!validate(this)) return false;">
				<table>
					<tr><td class="error" colspan="2" align="center" id="error_message"><?=$_SESSION[ERROR];$_SESSION[ERROR]="";?><?=$_GET[ERROR]?></td></tr>
					<tr>
						<td class="odd"><span id="logname_label"><? echo $webui_user_name ?>*</span></td>
						<td class="odd">
              <div class="roundedinput">
                <input require="true" label="logname_label" id="login_input" name="logname" type="text" value="<?= $_POST[logname] ?>" />
              </div>
            </td>
					</tr>
					<tr>
						<td class="even"><span id="password_label"><? echo $webui_password ?>*</span></td>
						<td class="even">
              <div class="roundedinput">
                <input require="true" label="password_label" id="login_input" type="password" name="logpassword" />
              </div>
            </td>
					</tr>
					<tr>
						<td class="even"><a href="index.php?page=forgotpass"><? echo $webui_forgot_password ?></a></td>
            <td class="odd"><button id="adminlogin_button" type="Submit" name="Submit" value="<? echo $webui_admin_login ?>"><? echo $webui_admin_login; ?></button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
  <? } ?>
