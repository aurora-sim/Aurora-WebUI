<?
if($_GET[order]=="name"){
$ORDERBY=" ORDER by regionName ASC";
}else if($_GET[order]=="x"){
$ORDERBY=" ORDER by locX ASC";
}else if($_GET[order]=="y"){
$ORDERBY=" ORDER by locY ASC";
}else{
$ORDERBY=" ORDER by regionName ASC";
}

$GoPage= "index.php?page=regions";

$AnzeigeStart 		= 0;
$AnzeigeLimit		= 25;

// LINK SELECTOR
$LinkAusgabe="page=$GoPage&";

if($_GET[AStart]){$AStart=$_GET[AStart];};
if($_GET[ALimit]){$ALimit=$_GET[ALimit];};

if(!$AStart) $AStart = $AnzeigeStart;
if(!$ALimit) $ALimit = $AnzeigeLimit;

$Limit = "LIMIT $AStart, $ALimit";

$DbLink->query("SELECT COUNT(*) FROM ".C_REGIONS_TBL.""); 
list($count) = $DbLink->next_record();

$sitemax=round($count / $ALimit,0);
$sitestart=round($AStart / $ALimit ,0)+1;
if($sitemax == 0){$sitemax=1;}

?>
<DIV style="height:100%">
<br />
<table width="80%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCC00">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td bgcolor="#FFFFFF">
           <div align="center">This is the Regions List, click on a Region Name to get more information about that Region </div></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<TABLE width="80%" border=0 align=center cellpadding="0" cellspacing="0">
  <TBODY>
    <TR>
      <TD width="25" background="images/main/regions_left.gif">&nbsp;</TD>
      <TD width="221" height="40" valign="bottom" background="images/main/regions_middle.jpg">
	  <a style="cursor:pointer" onclick="document.location.href='index.php?page=regions&order=name'"><b><U>Region Name</U></b></a></TD>
      <TD width="178" valign="bottom" background="images/main/regions_middle.jpg">
	  <a style="cursor:pointer" onclick="document.location.href='index.php?page=regions&order=x'"><b><U>Location: X</U></b></a></TD>
      <TD width="175" valign="bottom" background="images/main/regions_middle.jpg">
	  <a style="cursor:pointer" onclick="document.location.href='index.php?page=regions&order=y'"><b><U>Location: Y</U></b></a></TD>
      <TD width="195" valign="bottom" background="images/main/regions_middle.jpg"><b>Info</b></TD>
      <TD width="25" background="images/main/regions_right.gif">&nbsp;</TD>
    </TR>
    <TR>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
      <TD colspan="4" bgcolor="#FFFFFF"><hr /></TD>
        <TD bgcolor="#FFFFFF">&nbsp;</TD>
    </TR>
    <TR>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
      <TD colspan="4">
<!--//START LIMIT AND SEARCH ROW -->	  
	  <TABLE WIDTH=100% align="center" CELLPADDING=3 CELLSPACING=0 BGCOLOR=#999999>
	<TR><TD style="filter:progid:DXImageTransform.Microsoft.Gradient(startColorStr='#CC0000', endColorStr='#FFFFFF', gradientType='1')">

	<TABLE CELLPADDING=0 CELLSPACING=0 WIDTH=100%><TR><TD><FONT COLOR=#FFFFFF><B><?=$count?> Regions found</B></FONT></TD>
	<TD ALIGN=right>
<?
// ################################## Navigation ###################################### 	
?>

<TABLE CELLPADDING=1 CELLSPACING=0><TR><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD>
<TD WIDTH=100 ALIGN=center>
<FONT COLOR="#000000">Page <?=$sitestart ?>  of  <?=$sitemax ?></FONT></TD>
<TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self"><IMG SRC=images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0"></a></TD><TD WIDTH="10"></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=10&amp;" target="_self"><IMG SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10"></a></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=25&amp;" target="_self"><IMG SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25"></a></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=50&amp;" target="_self"><IMG SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50"></a></TD><TD>
<a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=100&amp;" target="_self"><IMG SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100"></a></TD><TD>
</TD></TR></TABLE></TD></TR></TABLE>
</TD></TR></TABLE>
<!--//END LIMIT AND SEARCH ROW -->	  </TD>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
    </TR>
    <TR>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
      <TD colspan="4" bgcolor="#FFFFFF"><hr /></TD>
        <TD bgcolor="#FFFFFF">&nbsp;</TD>
    </TR>
	<?
	$w=0;
	$DbLink->query("SELECT regionHandle,regionName,locX,locY,serverIP FROM ".C_REGIONS_TBL." $ORDERBY $Limit");
	while(list($UUID,$regionName,$locX,$locY,$serverIP) = $DbLink->next_record()){
	$w++;
	?>
    <TR <? if($w==2){$w=0; echo"style='BACKGROUND-COLOR: #e8e0c5'";}else{echo"style='BACKGROUND-COLOR: #e8eff5'";}?>>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
      <TD><DIV style="COLOR: #000000"><B><?=$regionName?></B></DIV></TD>
      <TD><DIV style="COLOR: #ff0000"><B><?=$locX/256?></B></DIV></TD>
      <TD><DIV style="COLOR: #339900"><B><?=$locY/256?></B></DIV></TD>
      <TD><DIV style="COLOR: #9966ff"><A style="cursor:pointer" onClick="window.open('<?=SYSURL?>/app/region/?x=<?=$locX?>&y=<?=$locY?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=800,height=400')"><B><u>Click for more Info</u></B></A></DIV></TD>
      <TD bgcolor="#FFFFFF">&nbsp;</TD>
	</TR>
	<?
	}
	?>
    <TR>
      <TD height="40" background="images/main/regions_d_left.gif">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_middle.jpg">&nbsp;</TD>
      <TD background="images/main/regions_d_right.gif">&nbsp;</TD>
    </TR>
    </TBODY>
  </TABLE>
</DIV>