<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.style3 {font-size: 4px}
.style4 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<?
if($_SESSION[ADMINUID]){
$DbLink = new DB;

//DELTE CATEGORY INCLUDE SUBSITES
if($_GET[action] == 'confcatdelete'){
$DbLink->query("DELETE from ".C_PAGE_TBL." WHERE code='$_GET[delcode]'");
}
//DELETE CATEGORY INCLUDE SUBSITES END

//DELTE SUBSITE
if($_GET[action] == 'confsubdelete'){
$DbLink->query("DELETE from ".C_PAGE_TBL." WHERE id='$_GET[delcode]'");
}
//DELETE SUBSITE END

##SITE ACTIVATION/DEACTIVATION
//Activate and Deactivate Sites
if($_GET[status] == 'deactivate'){
$DbLink->query("UPDATE ".C_PAGE_TBL." SET active='0' WHERE id='$_GET[id]'");
}
if($_GET[status] == 'activate'){
$DbLink->query("UPDATE ".C_PAGE_TBL." SET active='1' WHERE id='$_GET[id]'");
}
//Activate and Deactivate Sites End

## SITE UPDATE
//Updates sites if save button was pressed
if($_POST[id]){
$DbLink->query("UPDATE ".C_PAGE_TBL." SET sitename='$_POST[sitename]',url='$_POST[url]',target='$_POST[target]',rank='$_POST[rank]',display='$_POST[display]' WHERE id='$_POST[id]'");
}
if($_POST[subid]){
$DbLink->query("UPDATE ".C_PAGE_TBL." SET sitename='$_POST[subname]',url='$_POST[suburl]',target='$_POST[subtarget]',rank='$_POST[subrank]',display='$_POST[subdisplay]' WHERE id='$_POST[subid]'");
}
//Updates sites if save button was pressed END

## SITE CREATION
//Create Sites if create button was pressed
if(($_POST[create]) && ($_POST[menu] == 'main') && ($_POST[name] != "")){

$DbLink->query("SELECT count(*) from ".C_PAGE_TBL." WHERE type='1'");
list($ranking) = $DbLink->next_record();
$ranking=$ranking+1;

$DbLink->query("INSERT INTO ".C_PAGE_TBL." (code,sitename,rank,type,active,url,target,display) Values (".time().",'$_POST[name]','$ranking','1','0','$_POST[url]','$_POST[target]','$_POST[display]')");
}

if(($_POST[create]) && ($_POST[menu] != 'main') && ($_POST[name] != "")){
$DbLink->query("SELECT count(*) from ".C_PAGE_TBL." WHERE type='2' and code='$_POST[menu]'");
list($subranking) = $DbLink->next_record();
$subranking=$subranking+1;

$DbLink->query("INSERT INTO ".C_PAGE_TBL." (code,sitename,rank,type,active,url,target,display) Values ('$_POST[menu]','$_POST[name]','$subranking','2','0','$_POST[url]','$_POST[target]','$_POST[display]')");
}
//Create Sites if create button was pressed END

?>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><div align="center" class="style1">Page Manager</div>
      <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td colspan="6" bgcolor="#0099CC"><p class="style4">Display -&gt; 0 = only seen if logged out<br />
Display-&gt; 1 = only seen if logged in<br />
Display-&gt; 2 = seen if logged in or out </p>
          </td>
        </tr>
        <tr>
          <td width="28%" bgcolor="#0099CC"><strong>Name</strong></td>
          <td width="20%" bgcolor="#0099CC"><strong>Create in </strong></td>
          <td width="24%" bgcolor="#0099CC"><strong>URL</strong></td>
          <td width="15%" bgcolor="#0099CC"><strong>Target</strong></td>
          <td width="15%" bgcolor="#0099CC"><strong>Display</strong></td>
          <td width="13%" bgcolor="#0099CC">&nbsp;</td>
        </tr>
		<form method="post" action="index.php?page=pagemanager">
        <tr>
          <td bgcolor="#0099CC">
            <input style="background-color:#CCCCCC" name="name" type="text" id="name" size="35" />          </td>
          <td bgcolor="#0099CC">
            <select style="background-color:#CCCCCC" name="menu" id="menu">
              <option value="main"> >New Mainmenu< </option>
			  <option value="main"> -------------- </option>
			  <?
			  $DbLink->query("SELECT code,sitename  FROM ".C_PAGE_TBL." WHERE type='1' order by rank ASC");
		while(list($code,$sitename) = $DbLink->next_record()){
			  echo"<option value='$code'>$sitename</option>";
			  }
			  ?>
            </select>          </td>
          <td bgcolor="#0099CC">
            <input style="background-color:#CCCCCC" name="url" type="text" id="url" size="30" />          </td>
          <td bgcolor="#0099CC"><select style="background-color:#CCCCCC" name="target" id="target">
            <option value="_self">_self</option>
            <option value="_blank">_blank</option>
          </select></td>
          <td bgcolor="#0099CC"><select style="background-color:#CCCCCC" name="display" id="display">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
                                        </select></td>
          <td bgcolor="#0099CC">
            <input type="submit" name="create" value="Create" />          </td>
        </tr>
		</form>
      </table>
	  <? if($_GET[action] == 'delete'){
	  $DbLink->query("SELECT sitename,code from ".C_PAGE_TBL." WHERE id='$_GET[delid]'");
	  list($categoryname,$categorycode) = $DbLink->next_record();
	  ?>
      <br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF0000">
        <tr>
          <td bgcolor="#FF4A4A"><div align="center"><strong>Are you sure you want to delete the category 
              <?=$categoryname?> 
            and all of its subsites?<br />
            <a href="index.php?page=pagemanager&action=confcatdelete&delcode=<?=$categorycode?>">YES</a> / <a href="index.php?page=pagemanager">NO</a></strong></div></td>
        </tr>
      </table>
	  <? } ?>
	  <? if($_GET[action] == 'subdelete'){
	  $DbLink->query("SELECT sitename from ".C_PAGE_TBL." WHERE id='$_GET[delid]'");
	  list($sitename) = $DbLink->next_record();
	  ?>
      <br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF0000">
        <tr>
          <td bgcolor="#FF4A4A"><div align="center"><strong>Are you sure you want to delete the Subsite <?=$sitename?> ?<br />
            <a href="index.php?page=pagemanager&action=confsubdelete&delcode=<?=$_GET[delid]?>">YES</a> / <a href="index.php?page=pagemanager">NO</a></strong></div></td>
        </tr>
      </table>
	  <? } ?>
      <br />
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="31%" bgcolor="#0099CC"><strong>Name</strong></td>
        <td width="23%" bgcolor="#0099CC"><strong>URL</strong></td>
        <td width="11%" bgcolor="#0099CC"><strong>Target</strong></td>
        <td width="6%" bgcolor="#0099CC"><strong>Sort</strong></td>
        <td width="9%" bgcolor="#0099CC"><strong>Display</strong></td>
        <td width="9%" bgcolor="#0099CC"><strong>Status</strong></td>
        <td width="5%" bgcolor="#0099CC"><strong>Edit</strong></td>
        <td width="9%" bgcolor="#0099CC"><strong>Delete</strong></td>
        <td width="6%" bgcolor="#0099CC">&nbsp;</td>
      </tr>
      <?
		$DbLink1 = new DB;
		$DbLink1->query("SELECT id,code,sitename,rank,active,url,target,display  FROM ".C_PAGE_TBL." WHERE type='1' order by rank ASC");
		while(list($id,$code,$sitename,$rank,$active,$url,$target,$display) = $DbLink1->next_record()){
		?>
      <form action="index.php?page=pagemanager" method="post">
        <input type="hidden" name="id" value="<?=$id?>" />
        <tr>
          <td bgcolor="#0099CC"><input style="background-color:#CCCCCC" name="sitename" type="text" id="sitename" value="<?=$sitename?>" size="40" /></td>
          <td bgcolor="#0099CC"><input style="background-color:#CCCCCC" name="url" type="text" id="url" value="<?=$url?>" size="25" /></td>
          <td bgcolor="#0099CC"><select style="background-color:#CCCCCC" name="target" id="target" >
              <option value="_self" <? if($target == '_self'){echo"selected";} ?>>_self</option>
              <option value="_blank" <? if($target == '_blank'){echo"selected";} ?>>_blank</option>
          </select></td>
          <td bgcolor="#0099CC"><input style="background-color:#CCCCCC" name="rank" type="text" id="rank" size="2" value="<?=$rank?>" />          </td>
          <td bgcolor="#0099CC"><div align="center">
            <select style="background-color:#CCCCCC" name="display" id="display">
              <option <? if($display == '0'){echo"selected";} ?> value="0">0</option>
              <option <? if($display == '1'){echo"selected";} ?> value="1">1</option>
              <option <? if($display == '2'){echo"selected";} ?> value="2">2</option>
            </select>
          </div></td>
          <td bgcolor="#0099CC"><? if($active == '1'){?>
              <input style="background-color:#00FF00" type="button" name="active" value="Active" onclick="document.location.href='index.php?page=pagemanager&status=deactivate&id=<?=$id?>'" />
              <? } else { ?>
              <input style="background-color:#FF0000" type="button" name="active" value="Inactive" onclick="document.location.href='index.php?page=pagemanager&status=activate&id=<?=$id?>'" />
              <? } ?>          </td>
          <td bgcolor="#0099CC"><input name="edit" type="button" id="edit" value="edit" onclick="document.location.href='index.php?page=pageedit&id=<?=$id?>'" />          </td>
          <td bgcolor="#0099CC"><input name="delete" type="button" value="delete" id="delete" onclick="document.location.href='index.php?page=pagemanager&action=delete&delid=<?=$id?>'" /></td>
          <td bgcolor="#0099CC"><input name="save" type="submit" id="save" value="save" /></td>
        </tr>
      </form>
      <?
	  	$DbLink2 = new DB;
		$DbLink2->query("SELECT id,code,sitename,rank,active,url,target,display  FROM ".C_PAGE_TBL." WHERE type='2' and code='$code' order by rank ASC");
		while(list($subid,$subcode,$subname,$subrank,$subactive,$suburl,$subtarget,$subdisplay) = $DbLink2->next_record()){
	  	?>
      <form action="index.php?page=pagemanager" method="post">
        <input type="hidden" name="subid" value="<?=$subid?>" />
        <tr>
          <td bgcolor="#0099CC"><div align="right"><img src="../images/icons/subarrow.gif" width="26" height="16" />
                  <input style="background-color:#CCCCCC" name="subname" type="text" id="subname" value="<?=$subname?>" size="25" />
          </div></td>
          <td bgcolor="#0099CC"><input style="background-color:#CCCCCC" name="suburl" type="text" id="suburl" value="<?=$suburl?>" size="25" /></td>
          <td bgcolor="#0099CC"><select style="background-color:#CCCCCC" name="subtarget" id="subtarget" >
              <option value="_self" <? if($subtarget == '_self'){echo"selected";} ?>>_self</option>
              <option value="_blank" <? if($subtarget == '_blank'){echo"selected";} ?>>_blank</option>
          </select></td>
          <td bgcolor="#0099CC"><input style="background-color:#CCCCCC" name="subrank" type="text" id="subrank" size="2" value="<?=$subrank?>" /></td>
          <td bgcolor="#0099CC"><div align="center">
            <select style="background-color:#CCCCCC" name="subdisplay" id="subdisplay">
              <option <? if($subdisplay == '0'){echo"selected";} ?> value="0">0</option>
              <option <? if($subdisplay == '1'){echo"selected";} ?> value="1">1</option>
              <option <? if($subdisplay == '2'){echo"selected";} ?> value="2">2</option>
            </select>
          </div></td>
          <td bgcolor="#0099CC"><? if($subactive == '1'){?>
              <input style="background-color:#00FF00" type="button" name="active" value="Active" onclick="document.location.href='index.php?page=pagemanager&status=deactivate&id=<?=$subid?>'" />
              <? } else { ?>
              <input style="background-color:#FF0000" type="button" name="active" value="Inactive" onclick="document.location.href='index.php?page=pagemanager&status=activate&id=<?=$subid?>'" />
              <? } ?>          </td>
          <td bgcolor="#0099CC"><input name="subedit" type="button" id="subedit" value="edit" onclick="document.location.href='index.php?page=pageedit&id=<?=$subid?>'" /></td>
          <td bgcolor="#0099CC"><input name="delete" type="button" value="delete" id="delete" onclick="document.location.href='index.php?page=pagemanager&action=subdelete&delid=<?=$subid?>'" /></td>
          <td bgcolor="#0099CC"><input name="subsave" type="submit" id="subsave" value="save" /></td>
        </tr>
      </form>
      <? }?>
      <tr>
        <td colspan="9"><span class="style3">.</span></td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
</table>
<?
} else{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}
?>