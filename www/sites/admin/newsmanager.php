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
    $DbLink->query("DELETE from " . C_NEWS_TBL . " WHERE (id = '" . cleanQuery($_GET[id]) . "')");
}
////////////////////////////////// ADMIN END ///////////////////////////////////
?>


<div id="content">
    <div id="annonce10">
        <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
        <div id="ContentHeaderCenter"></div>
        <div id="ContentHeaderRight"><h5><? echo $webui_admin_edit_loginscreen; ?></h5></div>

        <div id="loginscreen_manager">

            <div id="info">
                <p><? echo $webui_admin_loginscreen_info ?></p>
            </div>
            <a href="index.php?page=news_add"><? echo $webui_admin_create_news ?></a>

            <h3><? echo $webui_admin_news_online ?></h3>

            <table>
                <tr>
                    <td>
                        <b><? echo $webui_admin_news_title ?></b>
                    </td>

                    <td>
                        <b><? echo $webui_admin_news_date ?></b>
                    </td>

                    <td colspan=2></td>
                </tr>

                <?
                $DbLink->query("SELECT id,title,time from " . C_NEWS_TBL . " ORDER BY time DESC");
                while (list($id, $title, $TIME) = $DbLink->next_record()) {

                    if (strlen($title) > 67) {
                        $title = substr($title, 0, 32);
                        $title .= "...";
                    }
                ?>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr class="<? echo ($odd = $w % 2 ) ? "even" : "odd" ?>">
                        <td>    
                            &nbsp;&nbsp;&nbsp;&nbsp;<?= $title ?>
                        </td>

                        <td>
<? $TIMES = date("l M d Y", $TIME);
                    echo"$TIMES"; ?>
                    </td>
                    <td>
                        <a href=index.php?page=news_edit&editid=<?= $id ?>><? echo $webui_admin_news_edit ?></a>
                    </td>

                    <td>
                        <a href=index.php?page=adminloginscreen&delete=1&id=<?= $id ?>><? echo $webui_admin_news_delete ?></a>
                        </td>
                    </tr>
<? } ?>

            </table>
        </div>
    </div>
</div>
