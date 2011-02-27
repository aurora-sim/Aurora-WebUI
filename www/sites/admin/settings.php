<?
if ($_SESSION[ADMINID]) {
?>


<?
    $DbLink = new DB;

    if ($_POST[Submitreg] == "Save") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET adress='$_POST[adressset]',region='$_POST[regtyp]',startregion='$_POST[region]'");
    }

    if ($_POST[Submit2] == "Save") {
        if ($_POST[lastname] != "") {
            $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " Where name='$_POST[lastname]'");
            list($checkname) = $DbLink->next_record();

            if ($checkname) {
                
            } else {
                $DbLink->query("INSERT INTO " . C_NAMES_TBL . " (name,active)VALUES('$_POST[lastname]','1')");
            }
        }
    }

    if ($_POST[Submit3] == "Save") {
        $DbLink->query("UPDATE " . C_NAMES_TBL . " SET active='0' WHERE name='$_POST[deactivelast]'");
    }

    if ($_POST[Submit4] == "Save") {
        $DbLink->query("UPDATE " . C_NAMES_TBL . " SET active='1' WHERE name='$_POST[activatelast]'");
    }

    if ($_POST[Submit5] == "Save") {
        $DbLink->query("DELETE FROM " . C_NAMES_TBL . " WHERE name='$_POST[delname]'");
    }

    if ($_POST[Submitgau] == "Save") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET griddir='$_POST[griddir]',assetdir='$_POST[assetdir]',userdir='$_POST[userdir]'");
    }

    if ($_POST[Submitnam2] == "Activate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET lastnames='1'");
    }

    if ($_POST[Submitnam2] == "Deactivate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET lastnames='0'");
    }

    if ($_POST[allowRegistrationSubmit] == "Activate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET allowRegistrations='1'");
    }

    if ($_POST[allowRegistrationSubmit] == "Deactivate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET allowRegistrations='0'");
    }

    if ($_POST[verifyusersSubmit] == "Activate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET verifyUsers='1'");
    }

    if ($_POST[verifyusersSubmit] == "Deactivate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET verifyUsers='0'");
    }
	
	if ($_POST[Submitage] == "Activate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET ForceAge='1'");
    }

    if ($_POST[Submitage] == "Deactivate") {
        $DbLink->query("UPDATE " . C_ADM_TBL . " SET ForceAge='0'");
    }

    $DbLink->query("SELECT lastnames,region,startregion,adress,allowRegistrations,verifyUsers,ForceAge FROM " . C_ADM_TBL . "");
    list($LASTNMS, $REGIOCHECK, $STARTREGION, $ADRESSCHECK, $ALLOWREGISTRATION, $VERIFYUSERS, $FORCEAGE) = $DbLink->next_record();
?>

<div id="content">
  <h2><?= SYSNAME ?>: <? echo $webui_admin_settings; ?></h2>
  
  <div id="adminsettings">
  
  <div id="info">
      <p><? echo $webui_admin_home_info; ?></p>
  </div>


  <table>
      <form id="form41" name="form41" method="post" action="index.php?page=adminsettings">
          <tr>
              <td class="odd" width="50%">
                  <span class="Stil4">Start Region changeable at:</span>
                      <select class="box" wide="25" name="regtyp">
                        <?
                            echo "<option value='0' " . ($REGIOCHECK == '0' ? 'selected' : '') . ">Create/Edit Account</option>
                                  <option value='1' " . ($REGIOCHECK == '1' ? 'selected' : '') . ">Edit Account</option>
                                  <option value='2' " . ($REGIOCHECK == '2' ? 'selected' : '') . ">Admin only</option>";
                        ?>
                      </select>
              </td>
                      
              <td class="odd" width="50%">
                  <span class="Stil4">Startregion:</span>
                      <select class="box" wide="25" name="region">
                        <?
                            $DbLink->query("SELECT RegionName FROM " . C_REGIONS_TBL . " ORDER BY RegionName ASC ");
                                  
                            while (list($RegionName, $RegionUUID) = $DbLink->next_record()) {
                                echo"<option value='$RegionUUID' " . ($STARTREGION == '$RegionUUID' ? 'selected' : '') . ">$RegionName</option>";
                            }
                        ?>
                      </select>
              </td>
          </tr>
                      
          <tr>
              <td class="even">
                  <span class="Stil4">Require address for account creation?</span>
                      <select class="box" wide="25" name="adressset" >
                        <?
                            echo "<option value='0' " . ($ADRESSCHECK == '0' ? 'selected' : '') . ">NO</option>
                                  <option value='1' " . ($ADRESSCHECK == '1' ? 'selected' : '') . ">YES</option>";
                       ?>
                      </select>
              </td>
                              
              <td class="even">
                  <div align="center">
                      <input type="submit" name="Submitreg" value="Save" />
                  </div>
             </td>
          </tr>
        </form>

        <form id="form9" name="form9" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="odd"><span class="Stil4">Allow Registration</span></td>
              <td class="odd">
                  <? if ($ALLOWREGISTRATION == 0) { ?>
                  <input type="submit" name="allowRegistrationSubmit" value="Activate" />
                  <? } else { ?>
                  <input type="submit" name="allowRegistrationSubmit" value="Deactivate" />
                  <? } ?>
              </td>
            </tr>
        </form>
        
        <form id="form9" name="form9" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="even"><span class="Stil4">Verify Users by Validating their email</span></td>
              <td class="even">
                  <? if ($VERIFYUSERS == 0) { ?>
                  <input type="submit" name="verifyusersSubmit" value="Activate" />
                  <? } else { ?>
                  <input type="submit" name="verifyusersSubmit" value="Deactivate" />
                  <? } ?>
              </td>
            </tr>
        </form>
        
        <form id="form9" name="form9" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="odd"><span class="Stil4">Activate Lastnames </span></td>
              <td class="odd">
                  <? if ($LASTNMS == 0) { ?>
                  <input type="submit" name="Submitnam2" value="Activate" />
                  <? } else { ?>
                  <input type="submit" name="Submitnam2" value="Deactivate" />
                  <? } ?>
              </td>
            </tr>
        </form>
        
        <form id="form2" name="form2" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="even"><span class="Stil4">Add last name </span></td>
              <td class="even">
                  <input type="text" name="lastname" />
                  <input type="submit" name="Submit2" value="Save" />
              </td>
            </tr>
        </form>
              
        <form id="form3" name="form3" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="odd"><span class="Stil4">Deactivate last name </span></td>
              <td class="odd">
                  <select class="box" wide="25" name="deactivelast">
                      <?
                        $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=1 ORDER BY name ASC ");
                        while (list($NAMEDB) = $DbLink->next_record()) {
                      ?>
                              
                      <option><?= $NAMEDB ?></option><? } ?>
                  </select>
                          
                  <input type="submit" name="Submit3" value="Save" />
              </td>
            </tr>
        </form>
              
        <form id="form4" name="form4" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="even"><span class="Stil4">Reactivate last name </span></td>
              <td class="even">
                  <select class="box" wide="25" name="activatelast">
                      <?
                        $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " WHERE active=0 ORDER BY name ASC ");
                        while (list($NAMEDB) = $DbLink->next_record()) {
                      ?>
                          
                      <option><?= $NAMEDB ?></option><? } ?>
                  </select>
                          
                  <input type="submit" name="Submit4" value="Save" />
              </td>
            </tr>
        </form>
              
        <form id="form5" name="form5" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="odd"><span class="Stil4">Delete last name </span></td>
              <td class="odd">
                  <select class="box" wide="25" name="delname">
                      <?
                        $DbLink->query("SELECT name FROM " . C_NAMES_TBL . " ORDER BY name ASC ");
                        while (list($NAMEDB) = $DbLink->next_record()) {
                      ?>
                      
                      <option><?= $NAMEDB ?></option><? } ?>
                  </select>
                          
                  <input type="submit" name="Submit5" value="Save" />
              </td>
            </tr>
        </form>
		
		<form id="form6" name="form6" method="post" action="index.php?page=adminsettings">
            <tr>
              <td class="even"><span class="Stil4">Restrict age to 18 or older</span></td>
              <td class="even">
                  <? if ($FORCEAGE == 0) { ?>
                  <input type="submit" name="Submitage" value="Activate" />
                  <? } else { ?>
                  <input type="submit" name="Submitage" value="Deactivate" />
                  <? } ?>
              </td>
            </tr>
        </form>
    </table>
  </div>
</div>
<? } ?>              
