<?php
$DbLink = new DB;
$DbLink->query("SELECT uuid,regionName,locX,locY FROM ".C_REGIONS_TBL." ORDER BY locX ASC, locY ASC");

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
 <table width="640" border="1" align="center" cellpadding="2" cellspacing="2" bordercolor="#777777" bgcolor="#FFFFFF" style="border-collapse: collapse">
   <tr bgcolor="#CCCCCC">
     <td align="center"><div class="title"><b>UUID</div></td>
     <td align="center"><div class="title"><b>region name</div></td>
     <td align="center"><div class="title"><b>loc x</div></td>
     <td align="center"><div class="title"><b>loc y</div></td>
   </tr>
   <?
while(list($regionName,$locX,$locY,$uuid) = $DbLink->next_record()){
?>
   <tr>
     <td align="center"><div class="results"><b><? echo $regionName; ?></div></td>
     <td align="center"><div class="results"><b><? echo $locX; ?></div></td>
     <td align="center"><div class="results"><b><? echo $locY; ?></div></td>
     <td align="center"><div class="results"><b><? echo $uuid; ?></div></td>
   </tr>
   <?	
}
?>
 </table>
 </div>