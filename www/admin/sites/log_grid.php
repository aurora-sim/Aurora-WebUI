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

 <table width="650" height="420" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td valign="top">
	 <div style="position:relative;height:420;">
     <div id="scr">
	 <?php
	 
$DbLink = new DB;
$DbLink->query("SELECT griddir FROM ".C_ADM_TBL."");
list($griddir) = $DbLink->next_record();
//Reads each file in array and displays last N lines
$logname="opengrid-gridserver-console.log";
$griddir=$griddir.$logname;
$files = array($griddir);

//Change or add files to this array to list different files, make sure they're readable by the webserver.
$numberoflines = 1000; //Change this number to change the number of lines to read from the end of the file.

foreach ($files as $file)
{

	$filecontents = file($file);

	echo '<center><h1>'.basename($file).'</h1><br />';
	echo '<center><table width="640"><tr><td><pre>'."\r\n";

	for($i = $numberoflines; $i >= 0; $i--)
	{
		$lines[] = $filecontents[count($filecontents)-$i];
	}

	foreach($lines as $line)
	{
		echo htmlentities($line);
	}
	unset($lines);
	echo '</pre>'."\r\n";
	echo '</td></tr></table><hr /><br />';
}

?>	 
     </div>
	 </div>
	 </td>
   </tr>
 </table>
 