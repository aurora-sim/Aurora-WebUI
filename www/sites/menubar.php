<?php
/*
 * Copyright (c) 2007 - 2011 Contributors, http://opensimulator.org/, http://aurora-sim.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
 */
 
 function WriteMenu($siteid, $siteurl, $sitetarget, $a, $Display, $AdminDisplay)
 {
	$DbLink2 = new DB;
	$DbLink2->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where parent = '$siteid' and active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
	if ($siteurl != "") {
		if ($sitetarget == '_self') {
			if ($_GET[btn] == $siteid) 
			{
				echo "<li><a href=\"#\"><span>$a[$siteid]</span></a>";
				if ($DbLink2->num_rows() > 0)
				{
					echo "<ul>";
					while (list($siteid2, $siteurl2, $sitetarget2) = $DbLink2->next_record()) 
					{
						WriteMenu($siteid2, $siteurl2, $sitetarget2, $a, $Display, $AdminDisplay);
					}
					echo "</ul>";
				}
				echo "</li>";
			} 
			else 
			{
				echo "<li><a href=\"$siteurl&btn=$siteid\"><span>$a[$siteid]</span></a>";
				if ($DbLink2->num_rows() > 0)
				{
					echo "<ul>";
					while (list($siteid2, $siteurl2, $sitetarget2) = $DbLink2->next_record()) 
					{
						WriteMenu($siteid2, $siteurl2, $sitetarget2, $a, $Display, $AdminDisplay);
					}
					echo "</ul>";
				}
				echo "</li>";
			}
		} 
		else 
		{
			echo "<li><a href=\"#\" onclick=\"window.open('$siteurl','mywindow','width=400,height=200')\"><span>$a[$siteid]</span></a>";
			if ($DbLink2->num_rows() > 0)
			{
				echo "<ul>";
				while (list($siteid2, $siteurl2, $sitetarget2) = $DbLink2->next_record()) 
				{
					WriteMenu($siteid2, $siteurl2, $sitetarget2, $a, $Display, $AdminDisplay);
				}
				echo "</ul>";
			}
			echo "</li>";
		}
	} 
	else 
	{
		echo "<li><a href=\index.php?&page=smodul&id=$siteid&btn=$siteid\"><span>$a[$siteid]</span></a></li>";
	}
 }
 
?>
<div id="menu">
    <ul>
    
    <?
		$DbLink = new DB;
		if ($_SESSION[USERID])
			$Display = 1;
		else
			$Display = 0;
		
		if($_SESSION[ADMINID])
			$AdminDisplay = " or (display='3')";
		else
			$AdminDisplay = "";

		$DbLink->query("SELECT id,url,target FROM " . C_PAGE_TBL . " Where parent is null and active='1' and ((display='$Display') or (display='2') " . $AdminDisplay . ") ORDER BY rank ASC ");
		// $tableWidth = 1000 / $DbLink->num_rows();
		$a = get_defined_vars();
		while (list($siteid, $siteurl, $sitetarget) = $DbLink->next_record()) 
		{
			WriteMenu($siteid, $siteurl, $sitetarget, $a, $Display, $AdminDisplay);
		}
    ?>
    </ul>
</div>
