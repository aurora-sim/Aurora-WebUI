					<div id="content">
						<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
						<div id="ContentHeaderCenter"></div>
						<div id="ContentHeaderRight"><h5><? echo $webui_help; ?></h5></div>
						<div id="help">
							<div id="info"><p><? echo $webui_help_info; ?></p></div>
							<div id="info1">
								<h3><? echo $webui_help_title_comment01; ?></h3>
								<p><? echo $webui_help_comment01; ?></p>
							</div>
							<div id="info2">
								<h3><? echo $webui_help_title_comment02; ?></h3>
								<p><? echo $webui_help_comment02; ?></p>
							</div>
							<div id="info3">
								<h3><? echo $webui_help_title_comment03; ?></h3>
								<p><? echo $webui_help_comment03; ?></p>
							</div>
							<p>
<?php
$a = get_defined_vars();
$display = array(2);
$display[] = isset($_SESSION['USERID']) ? 1 : 0;
if(isset($_SESSION['ADMINID']) === true){
$display[] = 3;
}

foreach(Globals::i()->wi_pagemanager->query($_GET['btn'], $display) as $page){
	echo "\t\t\t\t\t\t\t\t",'<a href="', $page->url(), '"><span>', $a[$page->id()], '</span></a><br/>',"\n";
}
?>
							</p>
						</div>
					</div>
