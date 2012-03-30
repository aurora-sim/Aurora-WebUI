<script>
function OpenAgent(firstname, lastname){
	window.open("<?php echo SYSURL; ?>/app/agent/?name="+firstname+" "+lastname,'mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')
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
$DbLink = new DB;
$DbLink->query(
'SELECT
	UserID
FROM
	' . C_USERINFO_TBL . '
WHERE
	IsOnline = 1 AND 
	LastLogin < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND 
	LastLogout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) 
ORDER BY
	LastLogin DESC');
while(list($UUID) = $DbLink->next_record()){
	// Let's get the user info
	$DbLink2 = new DB;
	$DbLink2->query('
SELECT
	FirstName,
	LastName
FROM
	' . C_USERS_TBL . '
WHERE
	PrincipalID = "' . cleanQuery($UUID) . '"');
	list($firstname, $lastname) = $DbLink2->next_record();
	$DbLink3 = new DB;
	$DbLink3->query('
SELECT
	CurrentRegionID
FROM
	' . C_USERINFO_TBL . '
WHERE
	UserID = "' . cleanQuery($UUID) . '"');
	list($regionUUID) = $DbLink3->next_record();
	$username = $firstname . ' ' . $lastname;
	// Let's get the region information
	$DbLink3 = new DB;
	$DbLink3->query(
'SELECT
	RegionName
FROM
	' . C_REGIONS_TBL . '
WHERE
	RegionUUID = "' . cleanQuery($regionUUID) . '"');
	list($region) = $DbLink3->next_record();
	if ($region != ""){
		echo
			'<tr>',
			'<td class="even"><b>', $username , '</b></td>',
			'<td class="even"><b>'.$region.'</b></td>',
			'<td class="even"><a onClick="OpenAgent(\'' , $firstname, '\', \'', $lastname, '\')"><b><u>Click for more Info</u></b></a></td>',
			'</tr>'
		;
	}
}
?>
			</tbody>
		</table>
	</div>
</div>
<?
$DbLink->query(
'SELECT
	COUNT(*)
FROM
	' . C_USERINFO_TBL . '
WHERE
	IsOnline = 1 AND
	LastLogin > (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 86400)))');
list($NOWONLINE) = $DbLink->next_record();
?>
