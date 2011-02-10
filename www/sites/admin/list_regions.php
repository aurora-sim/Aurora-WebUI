<?php
$DbLink = new DB;
$DbLink->query("SELECT RegionUUID,RegionName,locX,locY FROM ".C_REGIONS_TBL." ORDER BY locX ASC, locY ASC");

?>
<style type="text/css">
<!--
#scr {
  position:absolute;
  height:100%;
  width:100%;
  margin:0;
  padding:0;
  overflow:auto;
}
-->
</style>
<div style="height:100%;">
 <table width="640" border="1" align="center" cellpadding="2" cellspacing="2" bordercolor="#777777" bgcolor="#565051" style="border-collapse: collapse">
   <tr bgcolor="#CCCCCC">
     <td align="center"><div class="title"><b>UUID</b></div></td>
     <td align="center"><div class="title"><b>region name</b></div></td>
     <td align="center"><div class="title"><b>Loc X</b></div></td>
     <td align="center"><div class="title"><b>Loc Y</b></div></td>
   </tr>
   <?
while(list($RegionName,$locX,$locY,$uuid) = $DbLink->next_record()){
?>
   <tr>
     <td align="center"><div class="results"><b><? echo $RegionName; ?></b></div></td>
     <td align="center"><div class="results"><b><? echo $locX; ?></b></div></td>
     <td align="center"><div class="results"><b><? echo $locY; ?></b></div></td>
     <td align="center"><div class="results"><b><? echo $uuid; ?></b></div></td>
   </tr>
   <?	
}
?>
 </table>
 </div>