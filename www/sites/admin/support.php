<?php
if(!isset($_SESSION['ADMINID'])){
	header("Location: index.php?page=Home");
	exit;
}

if(isset($_POST['method'])){
	if($_POST["method"] == "Save Notes"){
		$found = array();
		$found[0] = json_encode(array(
			'Method' => 'AbuseReportSaveNotes',
			'WebPassword' => md5(WEBUI_PASSWORD),
			'Number' => cleanQuery($_POST["Number"]),
			'Notes' => cleanQuery($_POST["Notes"])
		));
		do_post_request($found);
	}
	if ($_POST["method"] == "Mark Complete"){
		$found = array();
		$found[0] = json_encode(array(
			'Method' => 'AbuseReportMarkComlete',
			'WebPassword' => md5(WEBUI_PASSWORD),
			'Number' => cleanQuery($_POST["Number"])
		));
		do_post_request($found);
	}
}

$found = array();
$found[0] = json_encode(array(
	'Method' => 'GetAbuseReports',
	'WebPassword' => md5(WEBUI_PASSWORD),
	'Start' => '1',
	'Count' => '10',
	'Active' => true
));
$do_post_request = do_post_request($found);
$recieved = json_decode($do_post_request);
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
	if(isset($recieved, $recieved->AbuseReports)){
		foreach($recieved->{'AbuseReports'} as $ar){
			$w++;
?>
			<tr class="<?php echo ($odd = $w%2 )? "odd" : "even"; ?>" onclick="rowClicked('<?php echo $ar->{'Number'}; ?>', '<?php echo ($odd = $w%2 ) ? "odd" : "even"; ?>');">
				<td><?php echo $ar->{'ReporterName'}; ?></td>
				<td><?php echo $ar->{'Category'}; ?></td>
				<td><?php echo $ar->{'AbuseSummary'}; ?></td>
			</tr>
			<tr id="workrow_<?php echo $ar->{'Number'}; ?>" class="hiddenrow">
				<td colspan="3">
					<form method="post"action="index.php?page=adminsupport&btn=webui_menu_item_adminsupport">
						<table width="100%">
							<tr>
								<td align="right" colspan="3">
									<a href="<?php echo $ar->{'AbuseLocation'}; ?>">TP</a>
									<input type="Submit" value="Mark Complete" name="method" />
									<input type="button" value="X" onclick="rowClicked('<?php echo $ar->{'Number'}; ?>', '<?php echo ($odd = $w%2 )? "odd":"even" ?>');" />
									<input type="hidden" name="Number" value="<?php echo $ar->{'Number'}; ?>" />
								</td>
							</tr>
							<tr>
								<td colspan="3"><b>Details</b></td>
							</tr>
							<tr>
								<td colspan="3"><?php echo $ar->{'AbuseDetails'}; ?></td>
							</tr>
							<tr>
								<td><b>AbuserName</b></td>
								<td><b>ObjectName</b></td>
								<td><b>ObjectPosition</b></td>
							</tr>
							<tr>
								<td><?php echo $ar->{'AbuserName'}; ?></td>
								<td><?php echo $ar->{'ObjectName'}; ?></td>
								<td><a href="<?php echo $ar->{'AbuseLocation'}; ?>"><?php echo $ar->{'ObjectPosition'}; ?></a></td>
							</tr>
							<tr>
								<td colspan="3">
									<textarea name="Notes" cols="100" rows="10"><?php echo $ar->{'Notes'}; ?></textarea>
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
