<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_news; ?></h5></div>
  
  	<div class="clear"></div>
        	
  <div id="news">
    <div id="info"><p><? echo $webui_news; ?></p></div>
    
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
<!-- STYLE TO DO -->
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
<!-- STYLE TO DO -->        
        	
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
                        <td width="100"><div class="news_time"><b><?= $TIMES ?></b></div></td>
                        <td><div class="news_title"><h3> <a href="<?=SYSURL?>index.php?page=news&scr=<?=$id?>" ><?=$title?></a></h3></div></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><div class="news_content"><?= $message ?></div></td>
                    </tr>

                    <tr>
                        <td colspan="2"><hr /></td>
                    </tr>
                <? } $DbLink->clean_results();
				
                $DbLink->close(); ?>
            </table>
	  </div>
</div>
