<?php
if(!isset($_SESSION['ADMINID'])){
	header('Location: ' . SYSURL . 'index.php?page=home');
	exit;
}

$DbLink = new DB;

if(isset($_GET['delete']) && $_GET['delete'] == 1){
	$DbLink->query("DELETE from " . C_NEWS_TBL . " WHERE (id = '" . cleanQuery($_GET['id']) . "')");
}
?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_edit_loginscreen; ?></h5></div>
	<div class="clear"></div>
	<div id="loginscreen_manager">
		<div id="info"><p><?php echo $webui_admin_loginscreen_info ?></p></div>
		<div id="ContentNewsLeft"><strong><?php echo $webui_admin_news_online ?> :</strong></div>
		<div id="ContentNewsRight"><a href="index.php?page=news_add"><?php echo $webui_admin_create_news ?></a></div>
		<div class="clear"></div>
		<div id="news_online">
			<table>
				<tr>
					<td><b><?php echo $webui_admin_news_title ?></b></td>
					<td><b><?php echo $webui_admin_news_date ?></b></td>
					<td colspan=2></td>
				</tr>
<?php
$DbLink->query("SELECT id,title,time from " . C_NEWS_TBL . " ORDER BY time DESC");
while (list($id, $title, $TIME) = $DbLink->next_record()){
	if (strlen($title) > 67){
		$title = substr($title, 0, 32) . '...';
	}
?>
				<tr><td colspan="4"></td></tr>
				<tr><td colspan="4"></td></tr>
				<tr><td colspan="4"></td></tr>
				<tr>
					<td><b><?php echo date("l M d Y", $TIME); ?></b></td>
					<td><?php echo $title ?></td>
					<td><a href=index.php?page=news_edit&editid=<?php echo $id; ?>><?php echo $webui_admin_news_edit ?></a></td>
					<td><a href=index.php?page=adminloginscreen&delete=1&id=<?php echo $id; ?>><?php echo $webui_admin_news_delete ?></a></td>
				</tr>
				<tr><td colspan="4"><hr /></td></tr>
<?php } ?>
			</table>
		</div>
	</div>
</div>
