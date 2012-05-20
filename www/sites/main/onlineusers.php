<script>
function OpenAgent(firstname, lastname){
	window.open("<?php echo SYSURL; ?>app/agent/?name="+firstname+" "+lastname,'mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')
}
</script>

<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_online_users; ?></h5></div>
	<div id="usersonline">
		<div id="info"><p><?php echo $webui_online_users_info; ?></p></div>
		<table>
			<tbody>
				<tr class="<?php echo (($odd = $w % 2 ) ? 'even' : 'odd'); ?>" >
					<td><b><?php echo $webui_user_name; ?>:</b></td>
					<td><b><?php echo $webui_region_name; ?>:</b></td>
					<td><b>Info</b></td>
				</tr>
<?php
use Aurora\Addon\WebAPI\Configs;
foreach(Configs::d()->RecentlyOnlineUsers(3930, true) as $UserInfo){
	if ($UserInfo->CurrentRegionName() != ''){
		echo
			'<tr>',
			'<td class="even"><b>', $UserInfo->Name() , '</b></td>',
			'<td class="even"><b>', $UserInfo->CurrentRegionName(), '</b></td>',
			'<td class="even"><a onClick="OpenAgent(\'' , $UserInfo->FirstName(), '\', \'', $UserInfo->LastName(), '\')"><b><u>Click for more Info</u></b></a></td>',
			'</tr>'
		;
	}
}
?>
			</tbody>
		</table>
	</div>
</div>
