<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_news; ?></h5></div>
  
  	<div class="clear"></div>
        	
  <div id="news">
    <div id="info"><p><? echo $webui_news; ?></p></div>
    
<?php
	use Aurora\Framework;
	use Aurora\Addon\WebAPI\Configs;

	$querypage = max(isset($_GET['pagenum']) ? (integer)$_GET['pagenum'] : 0, 0);
	try{
		$news = isset($_GET['scr']) ? null : Configs::d()->NewsFromGroupNotices($querypage * 5, 5);
	}catch(Aurora\Addon\LengthException $e){
		header('Location: ' . SYSURL . 'index.php?page=news&pagenum=' . ($querypage - 1));
		exit;
	}
	$showNext = isset($news) ? (($querypage * 5) + 5) < $news->count() : false;
?>
<!-- STYLE TO DO -->
        <div style="text-align: left; width: 50%; float: left;">
<?php if($querypage > 0) { ?>
            <a href="<?=SYSURL?>index.php?page=news&pagenum=<?=$querypage-1?>">Previous Page</a>
<?php } ?>&nbsp;
        </div>
        <div style="text-align: right; width: 50%; float: left;">
<?php if($showNext) { ?>
            <a href="<?=SYSURL?>index.php?page=news&pagenum=<?=$querypage+1?>">Next Page</a>
<?php } ?>&nbsp;
        </div>
<!-- STYLE TO DO -->        
        	
            <table>
<?php

	function OutputNews(Framework\GroupNoticeData $item){
		$title = $item->Subject();
		if (strlen($title) > 92) {
			$title = substr($title, 0, 92);
			$title .= "...";
		}
		$TIMES = date("l M d Y", $item->Timestamp());
		$message = $item->Message();
		$user = $item->FromName();
		$id = $item->NoticeID();
?>

                    <tr>
                        <td width="100"><div class="news_time"><b><?= $TIMES ?></b>
						</br></br>
						<b>By <?php echo $user;?>
						</div></td>
                        <td><div class="news_title"><h3> <a href="<?=SYSURL?>index.php?page=news&scr=<?=$id?>" ><?=$title?></a></h3></div></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><div class="news_content"><?= $message ?></div></td>
                    </tr>

                    <tr>
                        <td colspan="2"><hr /></td>
                    </tr>
<?php
	}

	if(isset($_GET['scr']) === false){
		while($news->valid() && $news->key() < (($querypage * 5) + 5)){
			OutputNews($news->current());
			$news->next();
		}
	}else{
		OutputNews(Configs::d()->GetGroupNotice($_GET['scr']));
	}
?>
            </table>
	  </div>
</div>
