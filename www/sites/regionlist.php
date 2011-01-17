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

// LINK SELECTOR
$LinkAusgabe="page=$GoPage&";

if($_GET[AStart]){$AStart=$_GET[AStart];};

if(!$AStart) $AStart = $AnzeigeStart;
$ALimit = $AStart + 10;
$Limit = "LIMIT $AStart, $ALimit";

$DbLink->query("SELECT COUNT(*) FROM ".C_REGIONS_TBL.""); 
list($count) = $DbLink->next_record();

$sitemax=round($count / $ALimit,0);
$sitestart=round($AStart / $ALimit ,0)+1;
if($sitemax == 0){$sitemax=1;}
?>

<div id="content"><h2><?= SYSNAME ?>: Region List </h2>

  <div id="region">

  <div id="message">
    <p>This is the Regions List, click on a Region Name to get more information about that Region.</p>
  </div>


  <table border=0 align=center cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td width="25px" background="images/main/regions_left.gif"></td>
        
        <td width="195" height="40" valign="bottom" background="images/main/regions_middle.jpg">
	        <a href="index.php?page=regions&order=name"><b><u>Region Name</u></b></a></td>
        
        <td width="175" valign="bottom" background="images/main/regions_middle.jpg">
	        <a href="index.php?page=regions&order=x"><b><u>Location: X</u></b></a></td>
        
        <td width="175" valign="bottom" background="images/main/regions_middle.jpg">
	        <a href="index.php?page=regions&order=y"><b><u>Location: Y</u></b></a></td>
      
        <td width="195" valign="bottom" background="images/main/regions_middle.jpg"><b>Info</b></td>
        
        <td width="25px" background="images/main/regions_right.gif"></td>
     </tr>
     
     <tr>
       <td bgcolor="#FFFFFF"></td>
       
       <td colspan="4" bgcolor="#FFFFFF"><hr /></td>
       <td bgcolor="#FFFFFF"></td>
     </tr>
    
     <tr>
       <td bgcolor="#FFFFFF"></td>
       <td colspan="4">


       <!--//START LIMIT AND SEARCH ROW -->	  
       <table WIDTH=100% align="center" CELLPADDING=3 CELLSPACING=0 BGCOLOR=#999999>
         <tr>
           <td style="filter:progid:DXImageTransform.Microsoft.Gradient(startColorStr='#e1e1e1', endColorStr='#FFFFFF', gradientType='1')">
    
    	     <table CELLPADDING=0 CELLSPACING=0 WIDTH=100%>
             <tr>
               <td>
                 <font><b><?=$count?> Regions found</b></font>
               </td>
          
               <td align=right>
               <?
               // ################################## Navigation ###################################### 	
               ?>
          
               <table CELLPADDING=1 CELLSPACING=0>
                 <tr>
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=<?=$ALimit?>" target="_self">
                       <img SRC=images/icons/icon_back_more_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                     </a>
                   </td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($AStart - $ALimit)) echo 0; else echo $AStart - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                       <img SRC=images/icons/icon_back_one_<? if(0 > ($AStart - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                     </a>
                   </td>
              
                   <td WIDTH=100 ALIGN=center>
                     <font>Page <?=$sitestart ?>  of  <?=$sitemax ?></font>
                   </td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if($count <= ($AStart + $ALimit)) echo 0; else echo $AStart + $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                       <img SRC=images/icons/icon_forward_one_<? if($count <= ($AStart + $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                     </a>
                   </td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=<? if(0 > ($count - $ALimit)) echo 0; else echo $count - $ALimit; ?>&amp;ALimit=<?=$ALimit?>" target="_self">
                      <img SRC=images/icons/icon_forward_more_<? if(0 > ($count - $ALimit)) echo off; else echo on ?>.gif WIDTH=15 HEIGHT=15 border="0" />
                     </a>
                   </td>
              
                   <td WIDTH="10"></td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=10&amp;" target="_self">
                       <img SRC=images/icons/<? if($ALimit != 10) echo icon_limit_10_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 10" />
                     </a>
                   </td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=25&amp;" target="_self">
                       <img SRC=images/icons/<? if($ALimit != 25) echo icon_limit_25_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 25" />
                     </a>
                   </td>
              
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=50&amp;" target="_self">
                       <img SRC=images/icons/<? if($ALimit != 50) echo icon_limit_50_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 50" />
                     </a>
                   </td>
                
                   <td>
                     <a href="<?=$GoPage?>&<?=$Link1?>AStart=0&amp;ALimit=100&amp;" target="_self">
                       <img SRC=images/icons/<? if($ALimit != 100) echo icon_limit_100_on; else echo icon_limit_off; ?>.gif WIDTH=15 HEIGHT=15 border="0" ALT="Limit 100" />
                     </a>
                   </td>
              
                   <td></td>
                 </tr>
               </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!--//END LIMIT AND SEARCH ROW -->

  </td>

  <TD bgcolor="#FFFFFF"></TD>
    </TR>
      <TR>
        <TD bgcolor="#FFFFFF"></TD>
        <TD colspan="4" bgcolor="#FFFFFF"><hr /></TD>
        
        <TD bgcolor="#FFFFFF"></TD>
      </TR>


  	<?
	  $w=0;
  	$DbLink->query("SELECT RegionName,LocX,LocY FROM ".C_REGIONS_TBL." $ORDERBY $Limit");
  	 while(list($regionName,$locX,$locY) = $DbLink->next_record()){
	   $w++;
	 ?>
	 

   <TR <? if($w==2){$w=0; echo"style='BACKGROUND-COLOR: #e8e0c5'";}else{echo"style='BACKGROUND-COLOR: #e8eff5'";}?>>
      <TD bgcolor="#FFFFFF"></TD>
      <TD><DIV style="COLOR: #000000"><B><?=$regionName?></B></DIV></TD>
      <TD><DIV style="COLOR: #ff0000"><B><?=$locX/256?></B></DIV></TD>
      <TD><DIV style="COLOR: #339900"><B><?=$locY/256?></B></DIV></TD>
      <TD>
        <DIV style="COLOR: #9966ff">
          <a style="cursor:pointer" onClick="window.open('<?=SYSURL?>/app/region/?x=<?=$locX?>&y=<?=$locY?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=800,height=400')">
          <b><u>Click for more Info</u></b></a>
          </DIV></TD>
      <TD bgcolor="#FFFFFF"></TD>
	</TR>
	<?
	}
	?>
    <TR>
      <TD height="40" background="images/main/regions_d_left.gif"></TD>
      <TD background="images/main/regions_d_middle.jpg"></TD>
      <TD background="images/main/regions_d_middle.jpg"></TD>
      <TD background="images/main/regions_d_middle.jpg"></TD>
      <TD background="images/main/regions_d_middle.jpg"></TD>
      <TD background="images/main/regions_d_right.gif"></TD>
    </TR>
    </tbody>
  </table>
</div>

<p>World Map Demo @ <a href="index.php?page=map&btn=6">map.php</a></p>

</div>
