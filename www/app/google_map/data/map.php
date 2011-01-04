<?
include("../../../settings/config.php");
include("../../../settings/mysql.php");

//Creates XML string and XML document using the DOM 
$dom = new DomDocument('1.0', "UTF-8"); 

$map = $dom->appendChild($dom->createElement('Map')); 

$DbLink = new DB;
$DbLink->query("SELECT UUID,regionName,locX,locY FROM ".C_REGIONS_TBL);
	while(list($UUID,$regionName,$locX,$locY) = $DbLink->next_record())
	{
	$grid = $map->appendChild($dom->createElement('Grid')); 

	$uuid = $grid->appendChild($dom->createElement('Uuid')); 
	$uuid->appendChild($dom->createTextNode($UUID)); 

	$region = $grid->appendChild($dom->createElement('RegionName')); 
	$region->appendChild($dom->createTextNode($regionName)); 

	$locationX = $grid->appendChild($dom->createElement('LocX')); 
	$locationX->appendChild($dom->createTextNode($locX)); 

	$locationY = $grid->appendChild($dom->createElement('LocY')); 
	$locationY->appendChild($dom->createTextNode($locY)); 
	}

$dom->formatOutput = true; // set the formatOutput attribute of 
                            // domDocument to true 
// save XML as string or file 
$test1 = $dom->saveXML(); // put string in test1 
echo $test1;

?>