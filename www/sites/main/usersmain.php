<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_people_search; ?></h5></div>
  <div id="searchpeople">
  <div id="info"><p><? echo $webui_people_search_info; ?></p></div>      
<p>
<?
  $DbLink2 = new DB;
  $DbLink = new DB;
  
  if ($_SESSION[USERID])
	$Display = 1;
  
  else
	$Display = 0;

  if($_SESSION[ADMINID])
    $AdminDisplay = " or (display='3')";
  
  else
	$AdminDisplay = "";
  $DbLink2->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where parent = '".cleanQuery($_GET[btn])."' and active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
  $a = get_defined_vars();
  
  while (list($siteid, $siteurl, $sitetarget) = $DbLink2->next_record()) 
  {
    echo "<a href=\"$siteurl&btn=$siteid\"><span>$a[$siteid]</span></a><br/>";
  }
?>
</p>
</div>
</div>
