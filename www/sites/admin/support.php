<?php
use Aurora\Addon\WebUI\Configs;
if(!isset($_SESSION['ADMINID'])){
	header("Location: index.php?page=Home");
	exit;
}

if(isset($_POST['method'])){
	if($_POST["method"] == "Save Notes"){
		Configs::d()->AbuseReportSaveNotes($_POST['Number'], $_POST['Notes']);
	}
	if ($_POST["method"] == "Mark Complete"){
		Configs::d()->AbuseReportMarkComplete($_POST['Number']);
	}
}

$recieved = Configs::d()->GetAbuseReports();
?>
<script type="text/javascript">
	function rowClicked(row, clas){
		var
			el = document.getElementById('workrow_' + row)
		;
		if (el.className == clas){
			el.className = 'hiddenrow';
		}else{
			el.className = clas;
		}
	}
</script>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_support; ?></h5></div>
	<div id="support">
		<div id="info"><p><?php echo $webui_support_info; ?></p></div>
		<?php echo isset($_POST['method']) ? $_POST['method'] : ''; ?>
		<table width="100%">
			<tr>
				<td>From</td>
				<td>Category</td>
				<td>Summary</td>
			</tr>
<?php
	$w=0;
	if($recieved->count() > 0){
		foreach($recieved as $ar){
			$w++;
?>
			<tr class="<?php echo ($odd = $w%2 )? "odd" : "even"; ?>" onclick="rowClicked('<?php echo $ar->Number(); ?>', '<?php echo ($odd = $w%2 ) ? "odd" : "even"; ?>');">
				<td><?php echo $ar->ReporterName(); ?></td>
				<td><?php echo $ar->Category(); ?></td>
				<td><?php echo $ar->Summary(); ?></td>
			</tr>
			<tr id="workrow_<?php echo $ar->Number(); ?>" class="hiddenrow">
				<td colspan="3">
					<form method="post"action="index.php?page=adminsupport&btn=webui_menu_item_adminsupport">
						<table width="100%">
							<tr>
								<td align="right" colspan="3">
									<a href="<?php echo $ar->Location(); ?>">TP</a>
									<input type="Submit" value="Mark Complete" name="method" />
									<input type="button" value="X" onclick="rowClicked('<?php echo $ar->Number(); ?>', '<?php echo ($odd = $w%2 )? "odd":"even" ?>');" />
									<input type="hidden" name="Number" value="<?php echo $ar->Number(); ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="3"><b>Details</b></td>
							</tr>
							<tr>
								<td colspan="3"><?php echo $ar->Details(); ?></td>
							</tr>
							<tr>
								<td><b>AbuserName</b></td>
								<td><b>ObjectName</b></td>
								<td><b>ObjectPosition</b></td>
							</tr>
							<tr>
								<td><?php echo $ar->UserName(); ?></td>
								<td><?php echo $ar->ObjectName(); ?></td>
								<td><a href="<?php echo $ar->Location(); ?>"><?php echo $ar->ObjectPosition(); ?></a></td>
							</tr>
<?php		if($ar->Screenshot() !== '00000000-0000-0000-0000-000000000000'){ ?>
							<tr>
								<td colspan="3" align="center"><img src="<?php echo Configs::d()->GridTexture($ar->Screenshot()); ?>" /></td>
							</tr>
<?php		} ?>
							<tr>
								<td colspan="3">
									<textarea name="Notes" cols="100" rows="10"><?php echo $ar->Notes(); ?></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="right">
									<input type="Submit" value="Save Notes" name="method" />
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
<?php
		}
	}else{
?>
			<tr>
				<td colspan="3" align="center">There are no abuse reports</td>
			</tr>
<?php } ?>
		</table>
	</div>
</div>
