<div id="content">
  <div id="ContentHeaderLeft"><h5><?php echo SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><?php echo $webui_news; ?></h5></div>
  
  	<div class="clear"></div>
        	
  <div id="news">
    <div id="info">
		<p><?php echo $webui_news; ?></p>
	</div>
    
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
<?php
	if($querypage > 0) { ?>
		<div style="text-align: left; width: 50%; float: left;">
			<a href="<?php echo SYSURL?>index.php?page=news&pagenum=<?php echo $querypage-1?>">Previous Page</a>
		</div>
<?php } ?>

<?php
	if($showNext) { ?>
		<div style="text-align: right; width: 50%; float: left;">
			<a href="<?=SYSURL?>index.php?page=news&pagenum=<?=$querypage+1?>">Next Page</a>
		</div>
<?php } ?>
<!-- STYLE TO DO -->

<table>
	<?php
		$query = "";
        if($_GET[scr] != "") {
			$query = " where id='".cleanQuery($_GET[scr])."'";
        }
            
		$querypage = $querypage * 5;
        $DbLink->query("SELECT id,title,message,time,user from " . C_NEWS_TBL . $query . " ORDER BY time DESC LIMIT $querypage,".($querypage+5));
        $count = 0;

        while (list($id, $title, $message, $time, $user) = $DbLink->next_record()) {
			$count++;
            if (strlen($title) > 92) {
				$title = substr($title, 0, 92);
                $title .= "...";
            }
            $TIMES = date("l M d Y", $time);
    ?>

    <tr>       
	<td>
		<div class="news_title">
			<h4><a href="<?php echo SYSURL?>index.php?page=news&scr=<?php echo $id?>" ><?php echo $title?></a></h4>
			<div class="author"><?php echo $user;?>: <?php echo $TIMES ?></div>
				<?php echo $message ?>
		</div>
	</td>
	</tr>
		
	<?php }
		$DbLink->clean_results();
		$DbLink->close();
	?>
    </table>
</div>
</div>