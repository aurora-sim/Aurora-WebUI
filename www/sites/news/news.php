<div id="content">
    <?php

                $querypage = 0;
                if($_GET[pagenum] != "") {
                    $querypage = cleanQuery($_GET[pagenum]);
                }
                $showNext = true;
                $DbLink = new DB;
                $DbLink->query("SELECT COUNT(*) from " . C_NEWS_TBL . $query);
while (list($count) = $DbLink->next_record()) {
if($querypage*5 + 5 > $count)
    $showNext = false;
}
                ?>
    <div id="annonce10">
    <center><h2> <? echo $webui_news; ?><p> </h2></center>
    <div id="info">
        <div style="text-align: left; width: 50%; float: left;">
        <?php
        if($querypage > 0) { ?>
            <a href="<?=SYSURL?>index.php?page=news&pagenum=<?=$querypage-1?>">Previous Page</a>
            <?php } ?>&nbsp;
        </div>
        <div style="text-align: right; width: 50%; float: left;">
            <?php
            if($showNext) { ?>
            <a href="<?=SYSURL?>index.php?page=news&pagenum=<?=$querypage+1?>">Next Page</a>
            <?php } ?>&nbsp;
        </div>
        <br><center><p><strong><? echo $webui_news; ?>     </strong></p></center>
        </div>
            <table>
                <?
                $query = "";
                if($_GET[scr] != "") {
                    $query = " where id='".cleanQuery($_GET[scr])."'";
                }
                $querypage = $querypage * 5;
                $DbLink->query("SELECT id,title,message,time from " . C_NEWS_TBL . $query . " ORDER BY time DESC LIMIT $querypage,".($querypage+5));
                $count = 0;

                while (list($id, $title, $message, $time) = $DbLink->next_record()) {
                    $count++;

                    if (strlen($title) > 92) {
                        $title = substr($title, 0, 92);
                        $title .= "...";
                    }
                    $TIMES = date("l M d Y", $time);
                ?>

                    <tr>
                        <td width="100"><b><?= $TIMES ?></b></td>
                        <td><h3> <a href="<?=SYSURL?>index.php?page=news&scr=<?=$id?>" target="_blank"><?=$title?></a></h3></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td width="89%"><?= $message ?></td>
                    </tr>

                    <tr>
                        <td colspan="2"><hr /></td>
                    </tr>
                <? } $DbLink->clean_results();
                $DbLink->close(); ?>
            </table>
      </div>
</div>
