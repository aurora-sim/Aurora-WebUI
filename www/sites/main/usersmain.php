<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_people_search; ?></h5></div>
  <div id="searchpeople">
  <div id="info"><p><? echo $webui_people_search_info; ?></p></div>      
<p>
<?
	$a = get_defined_vars();
	$display = array(2);
	$display[] = isset($_SESSION['USERID']) ? 1 : 0;
	if(isset($_SESSION['ADMINID']) === true){
		$display[] = 3;
	}
	
	foreach(Globals::i()->wi_pagemanager->query($_GET['btn'], $display) as $page){
		echo '<a href="', $page->url(), '"><span>', $a[$page->id()], '</span></a><br/>',"\n";
	}
?>
</p>
</div>
</div>
