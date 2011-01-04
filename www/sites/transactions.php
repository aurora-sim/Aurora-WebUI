<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META HTTP-EQUIV="expires" CONTENT="Tue, 31 Dec 2003 23:00:00 GMT">
<?
if($_SESSION[USERID] == ""){
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}else{ 

if($_POST[TIME]){$TIME=$_POST[TIME];}else{$TIME=time();}

if($_POST[date_start])
{
	$START=$_POST[date_start];
	$END=$_POST[date_end];

	$TIMESELECT="and timeOccurred between $START and $END";
}
else
{
	$START = time();
	$END = time();
	$TIMESELECT="and timeOccurred between $START and $END";
}

if($_POST[freetrans] == "false")
{
	$FREETRANSFERS="and amount != '0'";
}

// Added function to convert the unixtimestamp to readable date
function convert($value)
{
$date = date("Y/m/d",$value);
return $date;
}

?>
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

<FORM method="post" action="index.php?page=transactions">
<input type="hidden" name="TIME" value="<?=$TIME?>" />
<br />
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td bgcolor="#FFFFFF"><table cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" class="style7"><span class="style8">Transaction History </span></td>
          <td align="right" class="style7"><span class="style9"></span></td>
        </tr>
        <tr>
          <td colspan="5" class="style7"><span class="style9">These are your L$ transactions for the previous 30 days.</span></td>
        </tr>
      </table>
      <br />
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E6E6E6">
        <tbody>
          <tr>
            <th colspan="3" class="style7">Select a date range</th>
          </tr>
          <tr>
            <td class="style7">
			Display between</td><td> 
			<select name="date_start">
			<? 
			$starttime=$TIME;
			for($i=31; $i>=0; $i--)
			{
			$datestart= date("Y/m/d",$starttime);
			$timestring=$starttime;
			$starttime=$starttime-86400;
			
			echo("<OPTION VALUE=\"$timestring\" ");
			if($START != ""){ if($START == $timestring){echo" selected ";}}else{ if($i==0){echo(" selected ");}}
			echo(">$datestart");
			}
			echo"</option>";
			?> 
            </select>
            </td><td>&nbsp;and&nbsp;</td><td>
            <select name="date_end">
            <? 
			$endtime=$TIME;
			for($i=31; $i>=0; $i--)
			{
			$dateend= date("Y/m/d",$endtime);
			$timeendstring=$endtime;
			$endtime=$endtime-86400;
			
			echo("<OPTION VALUE=\"$timeendstring\" ");
			if($END != ""){ if($END == $timeendstring){echo" selected ";}}else{ if($i==31){echo(" selected ");}}
			echo(">$dateend");
			}
			echo"</option>";
			?> 
            </select></td>
          </tr>
          <tr>
            <td class="style7"><input type='checkbox' <? if($_POST[freetrans]=="false"){echo"checked='checked'";} ?> value='false' name='freetrans' />
              Exclude L$0 transactions?</td>
            <td class="style7"><table>
                <tbody>
                  <tr>
                    <td><input type="submit" value="Show (max. 500)" name="submit" /></td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </table>
</FORM>
 
<TABLE width="90%" 
        border=0 align="center" cellPadding=5 cellSpacing=1 bgColor=#cccccc>
  <TBODY>
        <TR bgColor=#eeeeee>
          <TD width="6%"><span style="font-size: 12px"><B style="COLOR: #000000">#</B></span></TD>
          <TD width="17%"><span style="font-size: 12px"><B style="COLOR: #000000">Transaction Number</B></span></TD>
          <TD width="35%"><span style="font-size: 12px"><B style="COLOR: #000000">Detail</B></span></TD>
          <TD align=right width="14%"><span style="font-size: 12px"><B style="COLOR: #000000">Debit</B></span></TD>
          <TD align=right width="14%"><span style="font-size: 12px"><B style="COLOR: #000000">Credit</B></span></TD>
          <TD align=right width="14%"><span style="font-size: 12px"><B style="COLOR: #000000">Balance</B></span></TD></TR>
<?
 
$w=0;
 
$DbLink = new DB;

$DbLink->query("SELECT SUM(amount) FROM ".C_TRANSACTION_TBL." where amount > 0 ".$TIMESELECT." ".$FREETRANSFERS." and destId='$_SESSION[USERID]' ");
list($incoming) = $DbLink->next_record();

$DbLink->query("SELECT SUM(amount) FROM ".C_TRANSACTION_TBL." where amount < 0 ".$TIMESELECT." ".$FREETRANSFERS." and destId='$_SESSION[USERID]'");
list($outgoing) = $DbLink->next_record();

$DbLink->query("SELECT a.id,(SELECT regionName FROM ".C_REGIONS_TBL." g WHERE g.uuid = a.RegionGenerated LIMIT 1) AS region,(SELECT FirstName FROM ".C_USERS_TBL." f WHERE f.PrincipalID = a.sourceId  LIMIT 1) AS source1,(SELECT LastName FROM ".C_USERS_TBL." e WHERE e.PrincipalID = a.sourceId  LIMIT 1) AS source2,(SELECT FirstName FROM ".C_USERS_TBL." d WHERE d.PrincipalID= a.destId  LIMIT 1) AS dest1,(SELECT LastName FROM ".C_USERS_TBL." c WHERE c.PrincipalID= a.destId  LIMIT 1) AS dest2,a.amount,a.flags,a.description,a.transactionType,a.timeOccurred, (SELECT SUM(amount) FROM ".C_TRANSACTION_TBL." b WHERE b.destId = a.destId AND b.id <= a.id) AS balance FROM ".C_TRANSACTION_TBL." a WHERE destId='$_SESSION[USERID]' ".$TIMESELECT." ".$FREETRANSFERS." ORDER BY timeOccurred DESC LIMIT 500");
while(list($id,$region,$source1,$source2,$from1,$from2,$amount,$flags,$description,$type,$time,$balance) = $DbLink->next_record()){
 
$date= date("Y-n-j g:h:s ",$time);
$w++;  
?>
        <TR bgColor=#ffffff>
          <TD style="COLOR: #000000" vAlign=top><span class="style7">
          <?=$w?>
          </span></TD>
          <TD style="COLOR: #000000" vAlign=top><span class="style7">
          <?=$id?>
          </span></TD>
          <TD style="COLOR: #000000" vAlign=top>
            <TABLE cellSpacing=0 cellPadding=1 width="100%" border=0>
              <TBODY>
              <TR>
                <TD class="style7">Date: <?=$date?></TD></TR>
              <TR>
                <TD><span class="style7">Type: <?=$description?></span></TD></TR>
              <TR>
                <TD><span class="style7">Region: <?=$region?></span></TD></TR>
              <TR>
                <TD><span class="style7"><? if($amount < 0){
				echo"Destination: $source1 $source2";
				}else if($amount > 0){
				echo"Source: $source1 $source2";
				}
				?></span></TD></TR>
              </TBODY>
            </TABLE>          </TD>
          <TD style="COLOR: #000000" vAlign=top align=right><span class="style7">
          <? if($amount < 0){echo"L$ $amount";} ?></span></TD>
          <TD style="COLOR: #000000" vAlign=top align=right bgColor=#eeeeee><span class="style7">
		  <? if($amount > 0){echo"L$ $amount";} ?></span></TD>
          <TD style="COLOR: #000000" vAlign=top align=right><span class="style7"><? echo"L$ $balance";?></span></TD>
        </TR>
<? } 
?>    
        <TR bgColor=#ffffff>
          <TD style="COLOR: #000000" align=right colSpan=3><span class="style7"><B>Totals:</B></span></TD>
          <TD style="COLOR: #000000" align=right><span class="style7">L$ 
          <? if($outgoing == ""){echo"0";}else{echo"$outgoing";}?>
          </span></TD>
          <TD style="COLOR: #000000" align=right bgColor=#eeeeee>
		  <span class="style7">L$ <? if($incoming == ""){echo"0";}else{echo"$incoming";}?></span>		  </TD>
         <TD><span class="style7"></span></TD>
        </TR></TBODY></TABLE>
<? } ?>