<?php
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}
if(isset($_POST['update']) && $_POST['update'] == '1'){
	$DbLink = new DB;
	$DbLink->query("UPDATE " . C_NEWS_TBL . " SET title='" . cleanQuery($_POST['title']) . "',message='" . cleanQuery($_POST['message']) . "' WHERE id='" . cleanQuery($_POST['id']) . "'");
	$DbLink->close();
	
	header('Location: ' . SYSURL . 'index.php?page=adminnewsmanager');
	exit;
}
?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_news; ?></h5></div>
	<div id="createnews">
		<div id="info"><p><?php echo $webui_admin_edit_news_info ?></p></div>

<?php
$DbLink = new DB;
$DbLink->query("SELECT id,title,message from " . C_NEWS_TBL . " WHERE id = '" . cleanQuery($_GET['editid']) . "'");
if($DbLink->num_rows() != 0){
	list($id, $title, $message) = $DbLink->next_record();
}
$DbLink->clean_results();
$DbLink->close();
?>
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
