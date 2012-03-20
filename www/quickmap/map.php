<? 
include("includes/config.php");
include("languages/translator.php");

$grid_x = 0;
$grid_y = 0;

if (isset($_POST['x']) && ($_POST['y'])){
	$grid_x = $_POST['x'];
	$grid_y = $_POST['y'];
}else if(isset($_GET['x']) && ($_GET['y'])){
	$grid_x = $_GET['x'];
	$grid_y = $_GET['y'];
}

if($grid_x == 0){
	$grid_x = $CONF_center_coord_x;
}
if($grid_y == 0){
	$grid_y = $CONF_center_coord_y;
}
if($grid_y <= 30){
	$grid_y = "100";
}
if($grid_x <= 30){
	$grid_x = "100";
}
if($grid_x >=99999){
	$grid_x = $CONF_center_coord_x;
}
if($grid_y >=99999){
	$grid_y = $CONF_center_coord_y;
}

$start_x = $grid_x - 20;
$start_y = $grid_y + 10;

$end_x = $grid_x + 20;
$end_y = $grid_y - 10;

use Aurora\Addon\WebUI\Configs;
$region_sg = array();
foreach(Configs::d()->GetRegionsInArea($start_x * 256, $start_y * 256, $end_x * 256, $end_y * 256) as $region){
	$region_sg[] = $region->RegionID() . ';' . $region->RegionName() . ';' . $region->RegionLocX() . ';' . $region->RegionLocY();
}
?>

<link href="<?echo $CONF_sim_domain.$CONF_install_path.$CONF_style_sheet_webui;?>" type="text/css" rel="stylesheet" />

<body class="webui">

<div id="content">
<div id="region_quickmap">





<div id="modtopright">

<div id="topright1"><? echo $CONF_txt_nav;?>
  <table>
    <tr>
    <td align="center">
    <center>         
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="<?=SYSURL?>images/spacer.gif" alt="" /></td>
          <td><a href="index.php?x=<? echo $grid_x;?>&y=<? echo $grid_y + 10; ?>" target="_self"><img src="<?=SYSURL?>images/pan_up.png" border="0" alt="<? echo $CONF_txt_north;?>" title="<? echo $CONF_txt_north;?>" /></a>
          </td>
          <td><img src="<?=SYSURL?>images/spacer.gif" alt="" /></td>
        </tr>
        
        <tr>
          <td><a href="index.php?x=<? print $grid_x - 10; ?>&y=<? print $grid_y; ?>" target="_self"><img src="<?=SYSURL?>images/pan_left.png" border="0" alt="<? echo $CONF_txt_west;?>" title="<? echo $CONF_txt_west;?>" /></a>
          </td>
          <td><a href="index.php?x=<? echo $CONF_center_coord_x;?>&y=<? echo $CONF_center_coord_y;?>" target="_self"><img src="<?=SYSURL?>images/center.png" border="0" alt="<? echo $CONF_txt_center;?>" title="<? echo $CONF_txt_center;?>" /></a>
          </td>
          <td><a href="index.php?x=<? print $grid_x + 10; ?>&y=<? print $grid_y; ?>" target="_self"><img src="<?=SYSURL?>images/pan_right.png" border="0" alt="<? echo $CONF_txt_east;?>" title="<? echo $CONF_txt_east;?>" /></a>
          </td>
        </tr>
        
        <tr>
          <td><img src ="<?=SYSURL?>images/spacer.gif" alt="" /></td>
          <td><a href="index.php?x=<? print $grid_x; ?>&y=<? print $grid_y -10; ?>" target="_self"><img src="<?=SYSURL?>images/pan_down.png" border="0" alt="<? echo $CONF_txt_south;?>" title="<? echo $CONF_txt_south;?>" /></a>
          </td>
          <td><img src ="<?=SYSURL?>images/spacer.gif" alt="" /></td>
        </tr>
      </table>
    </center>
    </td>
     </tr>
  </table>
</div>

<div id="topright2"><? echo $CONF_txt_coords;?>
<form name="submit" action="index.php?page=quickmap" method="post">
<table>
  <tr>
    <td width="100%"></td>
  </tr>
  <tr>
    <td width="100%">X: <input type="text" value="<?print $grid_x;?>" name="x" size="4" /></td>
  </tr>
  <tr>
    <td width="100%">Y: <input type="text" name="y" size="4" value="<?print $grid_y;?>" /></td>
  </tr>
  <tr>
    <td width="100%"><input type="submit" class="submit" style="width:110px;" name="Submit" value="" /></td>
  </tr>
</table>
</form>  
</div>
</div>

<!--
<table width="100%">
<form name="submit" action="index.php" method="post">
  <tr>
    <td width="25%"><div align="center"><? // echo $CONF_txt_coords;?></td>
    <td width="25%">X: <input type="text" value="<? // print $grid_x;?>" name="x" size=4></td>
    <td width="25%">Y: <input type="text" name="y" size=4 value="<? // print $grid_y;?>"></td>
    <td width="25%"><input type="submit" class="submit" style="width:110px;" name="Submit" value=""></td>
  </tr>
  </form>
</table>
-->

<!-- <? // echo $CONF_txt_title;?> -->

<table border="0" cellpadding="1" cellspacing="1" style="border-collapse: collapse" width="100%">

<?
  $y = $start_y;
  $x = $start_x;

  while ($y >= $end_y)
    {
       $x = $start_x;
       ?>
       <tr valign="middle">
       
       <td valign="middle">
       <div class="styleCoords">
       <?
       if ($y <> $start_y)
           {
            echo $y;
           }
       ?>
       </div>
       <?
         while ($x <= $end_x)
         {
         if ($y == $start_y)
          {
          ?>
          </td>
          
          <td align="center"><div class="styleCoords">
          <?
            $xs="a";
            $xs=$x;
            $z1=""; $z2=""; $z3=""; $z4=""; $z5=""; $z6="";
            $z1= substr($xs,'0','1');
            $z2= substr($xs,'1','1');
            $z3= substr($xs,'2','1');
            $z4= substr($xs,'3','1');
            $z5= substr($xs,'4','1');
            $z6= substr($xs,'5','1');

            if (z1) {print $z1;}
            if (z2) {print $z2;}
            if (z3) {print "<br />".$z3;}
            if (z4) {print $z4;}
            if (z5) {print "<br />".$z5;}
            if (z6) {print $z6;}

          ?>
          </div>
          <? $x++; }
          
          else
          {
            $count = count($region_sg);
            for ($q = 0; $q < $count; $q++)
            {
              $region_value = $region_sg[$q];
              $sim_new = 0;
              list($region_uuid, $region_name, $region_locx, $region_locy) = explode(";",$region_value);

              if ($region_locx >= 100000)
              {
                $region_locx = $region_locx / 256;
                $region_locy = $region_locy / 256;
              }

              if (($region_locx == $x) && ($region_locy == $y))
              {$sim_new = 1; break;}
            }

 
            if (($x == $CONF_center_coord_x) && ($y == $CONF_center_coord_y)) { ?>
            </td>
             
             <td>
                <a style="cursor:pointer" onClick="window.open('quickmap/modules/show_region.php?region=<?print $region_uuid; ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=950,height=600')">
                  <img src="<?=SYSURL?>images/grid_mainland.jpg" alt="Region=<? print $region_name; ?> | X=<?print $x; ?> | Y=<?print $y; ?> | Status: <? echo $CONF_txt_occupied;?>" title="Region=<? print $region_name; ?> | X=<?print $x; ?> | Y=<?print $y; ?> | Status: <? echo $CONF_txt_occupied;?>" /></a>
                <? $x++; }
              else { if ($sim_new == 1) { ?>
              
              </td>
              
              <td>
                <a style="cursor:pointer" onClick="window.open('quickmap/modules/show_region.php?region=<?print $region_uuid; ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=950,height=600')">
                <img src="<?=SYSURL?>images/grid_occupied.jpg" alt="Region=<? print $region_name; ?> | X=<?print $x; ?> | Y=<?print $y; ?> | Status: occupied" title="Region=<? print $region_name; ?> | X=<?print $x; ?> | Y=<?print $y; ?> | Status: occupied" /></a>
                <? $x++; }
              
                else { ?>
              </td>
              
              <td>
                <img src="<?=SYSURL?>images/grid_free.jpg" alt= "X=<?print $x; ?> | Y=<?print $y; ?> | Status: <? echo $CONF_txt_free;?>" title="X=<?print $x; ?> | Y=<?print $y; ?> | Status: <? echo $CONF_txt_free;?>" />
                <? $x++; }}}}
                $y--; } ?>
          </td>
    </tr>
</table>

</div></div>
