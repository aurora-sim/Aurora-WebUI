<?
if (!$_SESSION[ADMINID]) 
{
	header("Location: Index.php?page=Home");
	Exit();
}
else
{
	if ($_POST["method"] == "Save Notes")
	{
		$found = array(); 
		$found[0] = json_encode(array('Method' => 'AbuseReportSaveNotes', 'WebPassword' => md5(WIREDUX_PASSWORD),
			'Number' => $_POST["Number"], 
			'Notes' => $_POST["Notes"]
		));
		do_post_request($found);
	}
	if ($_POST["method"] == "Mark Complete")
	{
		$found = array(); 
		$found[0] = json_encode(array('Method' => 'AbuseReportMarkComlete', 'WebPassword' => md5(WIREDUX_PASSWORD),
			'Number' => $_POST["Number"]
		));
		do_post_request($found);
	}
	
	$found = array(); 
	$found[0] = json_encode(array('Method' => 'GetAbuseReports', 'WebPassword' => md5(WIREDUX_PASSWORD),
		'start' => '1', 'count' => '10', 'filter' => ' Active = \'1\''));
	$do_post_request = do_post_request($found);
	$recieved = json_decode($do_post_request);
?> 
<script language="javascript">
	function rowClicked(row, clas)
	{
		if (document.getElementById('workrow_' + row).className == clas)
			document.getElementById('workrow_' + row).className = 'hiddenrow';
		else
			document.getElementById('workrow_' + row).className = clas;
	}
</script>
<div id="content">
	<h2><?= SYSNAME ?>: <? echo $webui_menu_item_adminsupport ?></h2>
	<?=$_POST["method"]?>
	<table width="100%">
		<tr>
			<td>
				From
			</td>
			<td>
				Catagory
			</td>
			<td>
				Summary
			</td>
		</tr>
		<?$w=0;foreach($recieved->{'abusereports'} as $ar) {$w++;?>
		<tr class="<? echo ($odd = $w%2 )? "odd":"even" ?>" onclick="rowClicked('<?=$ar->{'Number'}?>', '<? echo ($odd = $w%2 )? "odd":"even" ?>');">
			<td><?=$ar->{'ReporterName'}?></td>
			<td><?=$ar->{'Category'}?></td>
			<td><?=$ar->{'AbuseSummary'}?></td>
		</tr>
		<tr id="workrow_<?=$ar->{'Number'}?>" class="hiddenrow">
			<td colspan="3">
				<form method="post"action="index.php?page=adminsupport&btn=webui_menu_item_adminsupport">
					<table width="100%">
						<tr>
							<td align="right" colspan="3">
								
								<a href="<?=$ar->{'AbuseLocation'}?>">TP</a>
								<input type="Submit" value="Mark Complete" name="method" />
								<input type="button" value="X" onclick="rowClicked('<?=$ar->{'Number'}?>', '<? echo ($odd = $w%2 )? "odd":"even" ?>');" />
								<input type="hidden" name="Number" value="<?=$ar->{'Number'}?>" />
							</td>
						</tr>
						<tr>
							<td colspan="3"><b>Details</b></td>
						</tr>
						<tr>
							<td colspan="3"><?=$ar->{'AbuseDetails'}?></td>
						</tr>
						<tr>
							<td><b>AbuserName</b></td>
							<td><b>ObjectName</b></td>
							<td><b>ObjectPosition</b></td>
						</tr>
						<tr>
							<td><?=$ar->{'AbuserName'}?></td>
							<td><?=$ar->{'ObjectName'}?></td>
							<td><a href="<?=$ar->{'AbuseLocation'}?>"><?=$ar->{'ObjectPosition'}?></a></td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="Notes" cols="100" rows="10"><?=$ar->{'Notes'}?></textarea>
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
		<?}	?>
	</table>
</div>

<?
}
?>