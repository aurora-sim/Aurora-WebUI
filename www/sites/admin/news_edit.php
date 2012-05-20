<?php
use Aurora\Addon\WebAPI\Configs;
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}
$error = null;
if(isset($_POST['update']) && $_POST['update'] == '1'){
	if(Configs::d()->EditGroupNotice($_POST['id'], $_POST['title'], $_POST['message'])){
		header('Location: ' . SYSURL . 'index.php?page=adminnewsmanager');
		exit;
	}else{
		$error = 'Failed to update group notice.';
	}
}
?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_news; ?></h5></div>
	<div id="createnews">

<?php
try{
	$newsItem = Configs::d()->GetGroupNotice($_GET['editid']);
}catch(Aurora\Addon\Exception $e){
?>
		<div id="info"><p><?php echo $e->getMessage(); ?></p></div>
	</div>
</div>

<?php
	return;
}
$id       = $newsItem->NoticeID();
$title    = $newsItem->Subject();
$message  = $newsItem->Message();
?>
		<div id="info"><p><?php echo $webui_admin_edit_news_info ?></p><?php if(isset($error)){ ?><p><?php echo $error; ?></p><?php } ?></div>
		<form name="update" method="post" action="index.php?page=news_edit">
			<input type='hidden' name='update' value='1'>
			<input type='hidden' name='id' value='<?php echo $id; ?>'>
			<table width="90%" align="center" cellpadding="2" cellspacing="3">
				<tr>
					<td><font color="#FFFFFF"><b> <?php echo $webui_admin_news_title; ?>:<br /><input name="title" value="<?php echo $title; ?>" style="width:100%" type="text" maxlength="255" /></b></font></td>
				</tr>
			</table>
			<table>
				<tr>
					<td><textarea NAME=message STYLE='WIDTH:100%; HEIGHT:350px'><?php echo $message; ?></textarea></td>
				</tr>
			</table>
			<div align="center"><button id="edit_news_item_button" type="Submit" name="Submit"><?php echo $webui_admin_edit_news; ?></button></div>
		</form>
	</div>
</div>
