<style type="text/css">
<!--
.style7 {font-size: 13px}
.style8 {
	font-size: 14px;
	font-weight: bold;
}
.style9 {font-size: 14px}
-->
</style>
<CENTER>
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
	<tr>
		<td bgcolor="#FFFFFF"><table cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" class="style7"><span class="style8">Simulator Statistics</span></td>
				<td align="right" class="style7"><span class="style9"></span></td>
			</tr>
			<tr>
				<td colspan="5" class="style7"><span class="style9">
				These are the known versions that OSGrid regions are running.<br>
				Every 24 hours these stats will be refreshed</span>
				</td>
			</tr>
                        </table>
		</td>
	</tr>
</table>

<TABLE width="100%" border=0 align="center" cellPadding=5 cellSpacing=1 bgColor=#cccccc>
  <TBODY>
        <TR bgColor=#eeeeee>
          <TD><span style="font-size: 12px"><B style="COLOR: #000000">Version</B></span></TD>
          <TD><span style="font-size: 12px"><B style="COLOR: #000000">Count of Regions</B></span></TD>
		</TR>
<?
$DbLink = new DB;

$DbLink->query("SELECT version, count(*) FROM ".C_STATS_REGIONS_TBL." GROUP BY version having count(*) > 1");
while(list($version, $count) = $DbLink->next_record())
{
echo "<TR>";
echo "<TD><span style=\"font-size: 12px\"><B style=\"COLOR: #000000\">".$version."</B></span></TD>";
echo "<TD><span style=\"font-size: 12px\"><B style=\"COLOR: #000000\">".$count."</B></span></TD>";
echo "</TR>";
}
?>
	</TBODY>
</TABLE>

</CENTER>