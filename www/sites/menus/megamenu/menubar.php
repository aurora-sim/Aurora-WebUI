<?php
/*
 * Copyright (c) 2007 - 2012 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/
use libAurora\Template\navigation\Pages as WebUIPages;

function WriteMenu(WebUIPages $pages, $a){
	$display = array(2);
	$display[] = isset($_SESSION['USERID']) ? 1 : 0;
	if(isset($_SESSION['ADMINID']) === true){
		$display[] = 3;
	}
	foreach($pages as $page){
		if(in_array($page->display(), $display) === true){
			echo '<li>';
			if($page->target() === '_self'){
				echo '<a href="', ($_GET['btn'] === $page->id() ? '#' : $page->url()), '"><span>', $a[$page->id()], '</span></a>';
			}else if($page->target() === '_external'){
				echo '<a href="', $page->url(), '"><span>', $a[$page->id()], '</span></a>';			
			}else if($page->target() === '_none'){
				echo '<a><span>', $a[$page->id()], '</span></a>';			
			}else{
				echo '<a href="#" onclick="window.open(\'', $page->url(), '\', \'mywindow\', \'\')"><span>',$a[$page->id()],'</span></a>';
			}
			if($page->count() > 0){
				echo '<ul>';
				WriteMenu($page, $a);
				echo '</ul>';
			}
			echo '</li>';
		}
	}
}
?>

<div id="megamenu" class="<?php echo $MegaMenuSkin; ?>">
    <ul id="mega-menu-<?php echo $MegaMenuPreset; ?>" class="mega-menu">
    <?php
		WriteMenu(Globals::i()->wi_pagemanager, get_defined_vars());
    ?>
    </ul>
</div>
