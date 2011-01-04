<?
if($_SESSION[ADMINUID]){

$DbLink = new DB;

if($_POST[id]){
//USING FCK EDITOR
if($editor_to_use == 'fckeditor'){
if ( isset( $_POST ) )
   $postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
   $postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
if($sForm != 'id'){
$DbLink->query("UPDATE ".C_PAGE_TBL." SET content='$value' WHERE id='$_POST[id]'");

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=pagemanager';
// -->
</script>";
}
}
//USING STANDARD EDITOR
}else{
$DbLink->query("UPDATE ".C_PAGE_TBL." SET content='$_POST[content]' WHERE id='$_POST[id]'");

echo "<script language='javascript'>
<!--
window.location.href='index.php?page=pagemanager';
// -->
</script>";
}

}


$DbLink->query("SELECT id,sitename,content from ".C_PAGE_TBL." WHERE id = '$_GET[id]'");
list($id,$title,$content) = $DbLink->next_record();


//USING FCK EDITOR
if($editor_to_use == 'fckeditor'){
include("fckeditor/fckeditor.php") ;
?>
<TABLE CELLSPACING="1" CELLPADDING="0" BGCOLOR="#7F9DB9" WIDTH="100%" HEIGHT="616">
<FORM name="update" method="post" action="index.php?page=pageedit">

	<TR>
	 <TD height="22"><b>Page: <?=$title?></b></TD>
	</TR>
	<TR>
	  <TD height="330" valign="top" BGCOLOR=#FFFFFF>
	  <?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = "".SYSURL."/admin/fckeditor/" ; 

$oFCKeditor = new FCKeditor('content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Value		= $content ;
$oFCKeditor->Create() ;
?>	  </TD>
	</TR>
	<TR>
	  <TD height="22" ALIGN="right">
	  <INPUT type='hidden' name='id' value=<?=$id?>>
	  <INPUT TYPE='submit' VALUE="save site">
	  </TD>
	</TR>
</FORM>
</TABLE>
<?
//USING STANDARD EDITOR
}else{
?>
<TABLE CELLSPACING="1" CELLPADDING="0" BGCOLOR="#7F9DB9" WIDTH="98%" HEIGHT="500">
<FORM name="update" method="post" action="index.php?page=pageedit">
<INPUT type='hidden' name='id' value=<?=$id?>>
	<TR>
	 <TD><b>Page: <?=$title?></b></TD>
	</TR>
	<TR>
	  <TD BGCOLOR=#FFFFFF><TEXTAREA NAME='content' STYLE='WIDTH:100%; HEIGHT:100%'><?=$content?></TEXTAREA>
	  <? INCLUDE("editor/content.php"); ?></TD>
	</TR>
	<TR>
	  <TD ALIGN="right"><INPUT TYPE='submit' VALUE="save site"></TD>
	</TR>
</FORM>
</TABLE>
<?
}
} else{
echo "<script language='javascript'>
<!--
window.location.href='index.php?page=home';
// -->
</script>";
}
?>