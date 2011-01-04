<style type="text/css">
<!--
.Stil9 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.boxmenu {font-size: 1px}
-->
</style>
<table width="245" border="0" align="center" cellpadding="0" cellspacing="0">
  <?
 $DbLink = new DB;
 $DbLink->query("SELECT id,code,sitename,url,target FROM ".C_PAGE_TBL." Where active='1' and type='1' and ((display='1') or (display='2')) ORDER BY rank ASC ");
 while(list($siteid,$sitecode,$sitename,$siteurl,$sitetarget) = $DbLink->next_record())
 {
 if(($siteurl=='index.php?page=transactions') and (($economy_sink_account =='00000000-0000-0000-0000-000000000000') or ($economy_source_account =='00000000-0000-0000-0000-000000000000'))){}else{
 ?>
 <tr>
    <td>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"
	<? if($siteurl != ""){
	  if(($siteurl != "") & ($sitetarget == '_self')){	
	 if($_GET[btn]== $siteid){
	echo"background=\"images/main/menu_selected.jpg\""; 
	}else {  
	echo"background=\"images/main/menu_unselected.jpg\""; 
	}
	
	echo"onclick=\"document.location.href='$siteurl&btn=$siteid'\""; 
	} else {
	echo"onclick=\"window.open('$siteurl','mywindow','width=400,height=200')\""; 
	}} else {
	echo"onclick=\"document.location.href='index.php?&page=smodul&id=$siteid&btn=$siteid'\"";
	if(($_GET[page]=='smodul') && ($_GET[btn]==$siteid)){
	echo"background=\"images/main/menu_selected.jpg\""; 
	}else {  
	echo"background=\"images/main/menu_unselected.jpg\""; 
	}
	} ?>
	>
  <tr>
    <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
   <td style="cursor:pointer;font-weight:bold;"><?=$sitename?></td>
  </tr>
</table>
	</td>
  </tr>
  <? if($_GET[btn] == $siteid){
  $DbLink1 = new DB;
 $DbLink1->query("SELECT id,code,sitename,url,target FROM ".C_PAGE_TBL." Where active='1' and type='2' and ((display='1') or (display='2')) and code='$sitecode' ORDER BY rank ASC ");
 while(list($subsiteid,$subsitecode,$subsitename,$subsiteurl,$subsitetarget) = $DbLink1->next_record())
 {
 if(($subsiteurl=='index.php?page=transactions') and (($economy_sink_account =='00000000-0000-0000-0000-000000000000') or ($economy_source_account =='00000000-0000-0000-0000-000000000000'))){}else{
  ?>
  <tr>
    <td>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0"
	<? if($subsiteurl != ""){
	  if(($subsiteurl != "") & ($subsitetarget == '_self')){	
	 if($_GET[subbtn]== $subsiteid){
	echo"background=\"images/main/submenu_selected.jpg\""; 
	}else {  
	echo"background=\"images/main/submenu_unselected.jpg\""; 
	}
	
	echo"onclick=\"document.location.href='$subsiteurl&btn=$siteid&subbtn=$subsiteid'\""; 
	} else {
	echo"onclick=\"window.open('$subsiteurl','mywindow','width=400,height=200')\""; 
	}} else {
	echo"onclick=\"document.location.href='index.php?&page=smodul&id=$subsiteid&btn=$siteid&subbtn=$subsiteid'\"";
	if(($_GET[page]=='smodul') && ($_GET[subbtn]==$subsiteid)){
	echo"background=\"images/main/submenu_selected.jpg\""; 
	}else {  
	echo"background=\"images/main/submenu_unselected.jpg\""; 
	}
	} ?>
	>
  <tr>
    <td width="25" style="cursor:pointer;font-weight:bold;">&nbsp;</td>
   <td style="cursor:pointer;font-weight:bold;"><?=$subsitename?></td>
  </tr>
</table>
	</td>
  </tr>
  <? }}}?>
  <tr>
  <td><span class="boxmenu">.</span></td>
  </tr>
  <?
  }} 
  ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
