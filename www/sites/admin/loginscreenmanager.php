<?
////////////////////////////////// ADMIN ///////////////////////////////////////


if ($_SESSION[ADMINID]) {

} else {

    echo "<script language=\"javascript\">
<!--
window.location.href=\"index.php?page=home\";
// -->
</script>";
}

$DbLink = new DB;

if ($_GET[delete] == 1) {
    $DbLink->query("DELETE from " . C_NEWS_TBL . " WHERE (id = '$_GET[id]')");
}

if ($_POST[infobox] == "save") {
    $DbLink->query("UPDATE " . C_INFOWINDOW_TBL . " SET gridstatus='$_POST[gridstatus]',active='$_POST[boxstatus]',color='$_POST[boxcolor]',title='$_POST[infotitle]',message='$_POST[infomessage]'");
}

$DbLink->query("SELECT gridstatus,active,color,title,message  FROM " . C_INFOWINDOW_TBL . " ");
list($gridstatus, $boxstatus, $boxcolor, $infotitle, $infomessage) = $DbLink->next_record();
////////////////////////////////// ADMIN END ///////////////////////////////////
?>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <br/>
            <div id="loginManagerNote" align="center">
                <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#336EB2">
                    <FONT COLOR="#FFFFFF">
                        <B>Login Screen Manager</B> </FONT>
                </table>
            </div>
            <br/>
            <div id="loginManager" align="center">
                <tr>
                <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#336EB2">
                    <form action="index.php?page=loginscreen" method="post">
                        <input type="hidden" name="infobox" value="save" />
                        <tr>
                            <td width="18%"><div align="right"><font color="#FFFFFF">Grid Status</font></div></td>
                            <td width="10%"><font color="#FFFFFF">
                                    <select name="gridstatus" id="gridstatusselectbox">
                                        <option value="1" style="background-color:#00FF00" <?
if ($gridstatus == "1") {
    echo"selected";
}
?>>Online</option>
                                        <option value="0" style="background-color:#FF0000" <?
                                                if ($gridstatus == "0") {
                                                    echo"selected";
                                                }
?>>Offline</option>
                                    </select>
                                </font></td>
                            <td width="18%"><div align="right"><font color="#FFFFFF">Window Status </font></div></td>
                            <td width="13%"><font color="#FFFFFF">
                                    <select name="boxstatus" id="boxstatus">
                                        <option value="1" style="background-color:#00FF00" <?
                                                if ($boxstatus == "1") {
                                                    echo"selected";
                                                }
?>>Active</option>
                                        <option value="0" style="background-color:#FF0000" <?
                                                if ($boxstatus == "0") {
                                                    echo"selected";
                                                } ?>>Inactive</option>
                                    </select>
                                </font></td>
                            <td width="19%"><div align="right"><font color="#FFFFFF">Window Color </font></div></td>
                            <td width="22%"><font color="#FFFFFF">
                                    <select name="boxcolor" id="boxcolor">
                                        <option value="white" style=" background-color:#FFFFFF" <?
                                                if ($boxcolor == "white") {
                                                    echo"selected";
                                                } ?>>white</option>
                                        <option value="green" style="background-color:#00FF00"  <?
                                                if ($boxcolor == "green") {
                                                    echo"selected";
                                                }
?>>green</option>
                                        <option value="yellow" style="background-color:#FFFF00"  <?
                                                if ($boxcolor == "yellow") {
                                                    echo"selected";
                                                }
?>>yellow</option>
                                        <option value="red" style="background-color:#FF0000"  <?
                                                if ($boxcolor == "red") {
                                                    echo"selected";
                                                }
?>>red</option>
                                    </select>
                                </font></td>
                        </tr>
                        <tr>
                            <td colspan="6"><font color="#336EB2" size="1">.</font></td>
                        </tr>
                        <tr>
                            <td valign="top"><font color="#FFFFFF">Window Title </font></td>
                            <td colspan="5"><input name="infotitle" type="text" id="infotitle" size="59" value="<?= $infotitle ?>" /></td>
                        </tr>
                        <tr>
                            <td valign="top"><font color="#FFFFFF">Window Message </font></td>
                            <td colspan="5"><font color="#FFFFFF">
                                    <textarea name="infomessage" cols="45" rows="10" id="infomessage"><?= $infomessage ?></textarea>
                                </font></td>
                        </tr>
                        <tr>
                            <td colspan="6"><div align="right">
                                    <input type="submit" name="Submit" value="Save Info Window Settings" />
                                </div></td>
                        </tr>
                    </form>
                </table>
    </tr>
</div>
<br />

<div id="loginManagerNote" align="center">
    <table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#336EB2">
        <FONT COLOR="#FFFFFF">
            <B>News currently online</B><br/><br/> <a style="color:#FFFFFF"   href="index.php?page=news_add">Create News item</a><br /></FONT><br/>
    </table>
</div>
<br/>

<table align="center" WIDTH=90% CELLPADDING="2" CELLSPACING="1" BORDER="0" BGCOLOR="#FFFFFF">
    <tr>
        <td BGCOLOR="#336EB2">
            <table 	WIDTH=100% CELLPADDING="2" CELLSPACING="0" BORDER="0">
                <tr>
                    <td WIDTH=611 BGCOLOR="#1F5BA1"><font color="#FFFFFF"><b>Title</b></font></td>
                    <td WIDTH=154 BGCOLOR="#1F5BA1"><font COLOR="#FFFFFF"><B>Date</B></font></td>
                    <td BGCOLOR="#1F5BA1" COLSPAN=2><font COLOR="#FFFFFF"></font></td>
                </tr>

                <?
                                                $DbLink->query("SELECT id,title,time from " . C_NEWS_TBL . " ORDER BY time DESC");

                                                while (list($id, $title, $TIME) = $DbLink->next_record()) {

                                                    if (strlen($title) > 67) {
                                                        $title = substr($title, 0, 32);
                                                        $title .= "...";
                                                    }
                ?>

                                                    <tr>
                                                        <td><b><font color="#CCCCCC">
                                <?= $title ?>
                                                </font></b></td>
                                        <td><font COLOR=#CCCCCC><b>
                                <?
                                                    $TIMES = date("D d M", $TIME);
                                                    echo"$TIMES";
                                ?></b></font></td>
                                        <td WIDTH=55><a href=index.php?page=news_edit&editid=<?= $id ?>>EDIT</a></td>
                                        <td WIDTH=63><a href=index.php?page=loginscreen&delete=1&id=<?= $id ?>>DELETE</a></td>
                                    </tr>

                <?
                                                }
                ?>
            </table>
        </td>
    </tr>
</table>
</table>
