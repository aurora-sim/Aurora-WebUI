<?
$AnzeigeStart = 0;

// LINK SELECTOR
$PageLink = "index.php?page=peoplesearch&btn=$_GET[btn]&";
$LinkAusgabe = $PageLink . "first=$_GET[first]&last=$_GET[last]&";

if ($_GET[AStart]) {
    $AStart = $_GET[AStart];
}

if (!$AStart)
    $AStart = $AnzeigeStart;
$ALimit = $AStart + 10;
$Limit = "LIMIT $AStart, $ALimit";

$whereclause = ' where ';
if ($_GET[first] != '') {
    $whereclause = $whereclause . 'FirstName like \'' . $_GET[first] . '%\' ';
}
if ($_GET[last] != '') {
    if ($whereclause != ' where ')//Add 'and' if necessary
        $whereclause = $whereclause . ' and ';
    $whereclause = $whereclause . 'LastName like \'' . $_GET[last] . '%\'';
}
if ($whereclause == ' where ')
    $whereclause = '';

$DbLink->query("SELECT COUNT(*) FROM " . C_USERS_TBL . $whereclause);
list($count) = $DbLink->next_record();

$sitemax = round($count / 10, 0);
$sitestart = round($AStart / 10, 0) + 1;
if ($sitemax == 0) {
    $sitemax = 1;
}
?>

<div id="content">
    <h2><?= SYSNAME ?>: <? echo $webui_people_search; ?></h2>
    
    <div id="searchpeople">
        
        <div id="info">
            <p>
                <? echo $webui_people_search_info; ?>

            </p>
        </div>
        
        <div id="message">
                
                <? echo $wiredux_first_name; ?>: <input id="first" name="first" type="text" size="25" maxlength="15" value="" />
                <? echo $wiredux_last_name; ?>: <input id="last" name="last" type="text" size="25" maxlength="15" value="" />
                <button id="search_bouton" type="button" onclick="document.location.href=('<?= $PageLink ?>'+ 'first=' + document.getElementById('first').value + '&last=' + document.getElementById('last').value)"><? echo $webui_people_search_bouton ?></button>
        </div>

        <table>
            <td colspan="2">
            <!--//START LIMIT AND SEARCH ROW -->
            <table>
                <tr>
                    <td>

                    <table>
                        <tr>
                            <td>
                                <font><b><?= $count ?> <? echo $webui_users_found ?></b></font>
                            </td>

                            <td>
                                <div id="region_navigation">
                                    <?
                                    // ################################## Navigation ######################################
                                    ?>
                                    
                                    <table>
                                        <tr>
                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=0&amp;ALimit=<?= $ALimit ?>" target="_self">
                                                    <img SRC=images/icons/icon_back_more_<? if (0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=<? if (0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?= $ALimit ?>" target="_self">
                                                    <img SRC=images/icons/icon_back_one_<? if (0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                                                </a>
                                            </td>

                                            <td>
                                                <font>Page <?= $sitestart ?>  of  <?= $sitemax ?></font>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=<? if ($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?= $ALimit ?>" target="_self">
                                                    <img SRC=images/icons/icon_forward_one_<? if ($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=<? if (0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?= $ALimit ?>" target="_self">
                                                    <img SRC=images/icons/icon_forward_more_<? if (0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                                                </a>
                                            </td>
            
                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=0&amp;ALimit=10&amp;" target="_self">
                                                    <img SRC=images/icons/<? if ($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10" />
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=0&amp;ALimit=25&amp;" target="_self">
                                                    <img SRC=images/icons/<? if ($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25" />
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=0&amp;ALimit=50&amp;" target="_self">
                                                    <img SRC=images/icons/<? if ($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50" />
                                                </a>
                                            </td>

                                            <td>
                                                <a href="<?= $LinkAusgabe ?>AStart=0&amp;ALimit=100&amp;" target="_self">
                                                    <img SRC=images/icons/<? if ($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100" />
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
          <!--//END LIMIT AND SEARCH ROW -->
        </td>

        <tr>
            <td>
                <a href="index.php?page=regions&order=name"><b><u><? echo $wiredux_user_name ?></u></b></a>
            </td>                
            
            <td><b><? echo $wiredux_info ?></b></td>
        </tr>
            
        <tr>
          <td colspan="2"></td>
        </tr>

        <?
          $w = 0;
          $DbLink->query("SELECT FirstName, LastName FROM " . C_USERS_TBL . $whereclause . " " . $Limit);
          while (list($FirstName, $LastName) = $DbLink->next_record()) {
          $w++;
        ?>

        <tr class="<? echo ($odd = $w%2 )? "odd":"even" ?>" >
            <td>
                <div><b><?= $FirstName . " " . $LastName ?></b></div>
            </td>
        
            <td>
                <div>
                    <a style="cursor:pointer" onClick="window.open('<?= SYSURL ?>/app/agent/?first=<?= $FirstName ?>&last=<?= $LastName ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')">
                        <b><u><? echo $wiredux_see_profile ?></u></b>
                    </a>
                </div>
            </td>
        </tr>
      <? } ?>
    </table>
  </div>
</div>
