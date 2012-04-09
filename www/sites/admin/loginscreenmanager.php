<?php
// Admin
if ($_SESSION[ADMINID]) {
  $DbLink = new DB;

  if ($_GET[delete] == 1) {
    $DbLink->query("DELETE from " . C_NEWS_TBL . " WHERE (id = '" . cleanQuery($_GET['id']) . "')");
  }

  if ($_POST[infobox] == "save") {
    $message = $_POST['infomessage'];
    $DbLink->query("UPDATE " . C_INFOWINDOW_TBL . " SET gridstatus='" . cleanQuery($_POST['gridstatus']) . "',active='" . cleanQuery($_POST['boxstatus']) . "',color='" . cleanQuery($_POST['boxcolor']) . "',title='" . cleanQuery($_POST['infotitle']) . "',message='" . cleanQuery($message) . "'");
  }
}

else {
  echo "<script language=\"javascript\">
  <!--
  window.location.href=\"index.php?page=home\";
  // -->
</script>";
}

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM " . C_INFOWINDOW_TBL . " ");
list($gridstatus, $boxstatus, $boxcolor, $infotitle, $infomessage) = $DbLink->next_record();
// admin end
?>

<div id="content">
  <div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_loginscreen; ?></h5></div>

  <div id="loginscreen_manager">
    <div id="info"><p><?php echo $webui_admin_loginscreen_info ?></p></div>

    <table>
      <form action="index.php?page=adminloginscreen" method="post">
        <input type="hidden" name="infobox" value="save" />
        <tr>
          <td>
            <div align="right"><?php echo $webui_admin_grid_status ?></div>
          </td>

          <td>
            <select name="gridstatus" id="gridstatusselectbox">
              <option value="1" style="background-color:#00FF00" <?php if ($gridstatus == "1") {echo"selected";} ?>>Online</option>
              <option value="0" style="background-color:#FF0000" <?php if ($gridstatus == "0") {echo"selected";} ?>>Offline</option>
            </select>
          </td>

          <td>
            <div align="right"><?php echo $webui_admin_windows_status ?></div>
          </td>

          <td>
            <select name="boxstatus" id="boxstatus">
              <option value="1" style="background-color:#00FF00" <?php if ($boxstatus == "1") {echo"selected";} ?>>Active</option>
              <option value="0" style="background-color:#FF0000" <?php if ($boxstatus == "0") {echo"selected";} ?>>Inactive</option>
            </select>
          </td>

          <td>
            <div align="right"><?php echo $webui_admin_windows_color ?></div>
          </td>

          <td>
            <select name="boxcolor" id="boxcolor">
              <option value="white" style=" background-color:#FFFFFF" <?php if ($boxcolor == "white") {echo"selected";} ?>>white</option>
              <option value="green" style="background-color:#00FF00"  <?php if ($boxcolor == "green") {echo"selected";} ?>>green</option>
              <option value="yellow" style="background-color:#FFFF00" <?php if ($boxcolor == "yellow") {echo"selected";} ?>>yellow</option>
              <option value="red" style="background-color:#FF0000" <?php if ($boxcolor == "red") {echo"selected";} ?>>red</option>
            </select>
          </td>
        </tr>

        <tr><td colspan="6"></td></tr>

        <tr>
          <td><?php echo $webui_admin_windows_title ?></td>
          <td colspan="5"><input name="infotitle" type="text" id="infotitle" size="119" value="<?php echo $infotitle ?>" /></td>
        </tr>

        <tr>
          <td><?php echo $webui_admin_windows_message ?></td>
          <td colspan="5"><textarea name="infomessage" cols="90" rows="10" id="infomessage"><?php echo $infomessage ?></textarea></td>
        </tr>

        <tr>
          <td colspan="6">
            <div align="center">
              <button id="info_loginscreen_button" type="submit" name="Submit"><?php echo $webui_admin_windows_settings ?></button>
            </div>
          </td>
        </tr>
      </form>
    </table>
  </div>
</div>
