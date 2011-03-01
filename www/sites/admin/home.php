<?
if ($_SESSION[ADMINID]) {
?>

<div id="content">
  <h2><?= SYSNAME ?>: <? echo $webui_admin_home ?></h2>

  <? echo $webui_welcome_userid; ?>
  
  <h1><? echo $webui_admin_welcome; ?> <? echo $webui_admin_panel; ?> <?= SYSNAME ?></h1>

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
	$DbLink2->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where parent = '$_GET[btn]' and active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
	$a = get_defined_vars();
	while (list($siteid, $siteurl, $sitetarget) = $DbLink2->next_record()) 
	{
		echo "<a href=\"$siteurl&btn=$siteid\"><span>$a[$siteid]</span></a><br/>";
	}
		
	?>
	</p>
  </div></div>

  <? } else { ?>
<div id="content">  <h2><?= SYSNAME ?>: <? echo $webui_admin_login ?></h2>      <div id="login">        <form action="index.php" method="POST" onSubmit="return Form(this)">                <table>          <tr>            <td class="even"> <? echo $webui_first_name ?></td>            <td class="even"><input id="login_input" name="logfirstname" type="text" class="box" value="<?= $_POST[logfirstname] ?>" /> </td>          </tr>  
          <tr>
            <td class="odd"> <? echo $webui_last_name ?></td>
            <td class="odd"><input id="login_input" name="loglastname" type="text" class="box" value="<?= $_POST[loglastname] ?>" /></td>
          </tr>

          <tr>
            <td class="even"> <? echo $webui_password ?></td>
            <td class="even"><input id="login_input" type="password" name="logpassword" class="box"/></td>
          </tr>

          <tr>
            <td class="odd"></td>
            <td class="odd"><input id="login_bouton" style="cursor:pointer" type="submit" name="Submit" value="<? echo $webui_admin_login ?>" /></td>
          </tr>
        </table>
        </form>
      </div>
  <? } ?>
</div>
