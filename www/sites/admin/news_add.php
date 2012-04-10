<?php
use Aurora\Addon\WebUI\Configs;
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}
if(isset($_POST['group'], $_POST['title'], $_POST['message'])){
	$noticeID = Configs::d()->AddGroupNotice($_POST['group'], $_SESSION['ADMINID'], $_POST['title'], $_POST['message']);

	header('Location: ' . SYSURL . 'index.php?page=adminnewsmanager#' . $noticeID);
	exit;
}
$newsSources = Configs::d()->GetNewsSources();
?>

<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_create_news; ?></h5></div>
	<div id="createnews">
		<div id="info"><p><?php echo $webui_admin_create_news_info ?></p></div>
		<form name="update" method="post" action="index.php?page=news_add">
			<table width="90%" align="center" cellpadding="2" cellspacing="3">
				
				<tr>
					<td><font color="#fff"><b> <?php echo $webui_admin_news_title; ?>:<br /><input name="title" value="" style="width:100%" type="text" maxlength="255" /></b></font>
					<td><label for="news-source">Group: </label><br /><?php # note: as of the time of writing, the word Group is not listed in the language files so this needs to be fixed at a later date. ?>

<?php if($newsSources->count() > 0){ ?>
						<select id="news-source" name="group">
<?php	foreach($newsSources as $group){ ?>
							<option value="<?php echo $group->GroupID(); ?>" <?php if($newsSources->count() === 1){ ?>selected <?php } ?>><?php echo htmlentities($group->GroupName()); ?></option>

<?php	} ?>
						</select>

<?php }else{ ?>
						<p class="error">There are no groups as news sources, type <code>webui add group as news source</code> into the Aurora-Sim console to add a group.</p><?php # as with the word Group, this hasn't been translated yet. ?> 

<?php } ?>
				</tr>
				<tr>
					<td colspan="2"><textarea name="message" style="width:100%; height:350px;"></textarea></td>
				</tr>
			</table>
			<div align="center"><button id="create_news_button" type="Submit" name="Submit"><?php echo $webui_admin_create_news; ?></button>
		</form>
	</div>
</div>
