<script>
function OpenAgent(firstname, lastname)
{
	locate = "<?=SYSURL?>/app/agent/?first="+firstname+"&last="+lastname
	window.open(locate,'mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=400')
}
</script>

<div id="content">

  <h2><?= SYSNAME ?>: <? echo $webui_online_users ?></h2>
  
  <div id="usersonline">
  
  <div id="info">
      <p><? echo $webui_online_users_info ?></p>
  </div>


<table>
  <tbody>
    <tr class="<? echo ($odd = $w%2 )? "even":"odd" ?>" >
      <td>
        <b><? echo $webui_user_name ?>:</b>
      </td>
      
      <td>
        <b><? echo $webui_region_name ?>:</b>
      </td>
      
      <td>
        <b>Info</b>
      </td>
    </tr>
<?
	$DbLink = new DB;
	$DbLink->query("SELECT UserID FROM ".C_GRIDUSER_TBL." where Online != 'False' AND ".
					"Login < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) AND ".
					"Logout < (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now())))) ".
					"ORDER BY Login DESC");
	while(list($UUID) = $DbLink->next_record())
	{
		// Let's get the user info
		$DbLink2 = new DB;
		$DbLink2->query("SELECT FirstName, LastName from ".C_USERS_TBL." where PrincipalID = '".$UUID."'");
		list($firstname, $lastname) = $DbLink2->next_record();
		$DbLink3 = new DB;
		$DbLink3->query("SELECT RegionID from ".C_PRESENCE_TBL." where UserID = '".$UUID."'");
		list($regionUUID) = $DbLink3->next_record();

		$username = $firstname." ".$lastname;
		// Let's get the region information
		$DbLink3 = new DB;
		$DbLink3->query("SELECT RegionName from ".C_REGIONS_TBL." where RegionUUID = '".$regionUUID."'");
		list($region) = $DbLink3->next_record();
		if ($region != "")
		{
			echo '<tr>';
			echo '<td class="even"><b>'.$username.'</b></td>';
			echo '<td class="even"><b>'.$region.'</b></td>';
			echo "<td class='even'><a onClick=\"OpenAgent('".$firstname."','".$lastname."')\"><b><u>Click for more Info</u></b></a></td>";
			echo '</tr>';
		}
	}
?>

    </tbody>
  </table>

</div>
</div>

<?


$DbLink->query("SELECT count(*) FROM ".C_GRIDUSER_TBL." where Online != 'False' and 
Login > (UNIX_TIMESTAMP(FROM_UNIXTIME(UNIX_TIMESTAMP(now()) - 86400)))");
list($NOWONLINE) = $DbLink->next_record();
?>
