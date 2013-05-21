<?php
/*
 * Copyright (c) Metropolis Metaversum [ http://hypergrid.org ]
 *
 * The MetroTools are BSD-licensed. For more infornmations about BSD-licensed
 * Software use this link: http://www.wikipedia.org/BSD-License
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Metropolis Project nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE DEVELOPERS ``AS IS'' AND ANY
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

include("includes/config.php");
include("includes/header.php");
include("languages/translator.php");

    $dbort  = $CONF_db_server;
    $dbuser = $CONF_db_user;
    $dbpw   = $CONF_db_pass;
    $dbdb   = $CONF_db_database;

    $grid_x = 0;
    $grid_y = 0;

    if (isset($_POST['x']) && ($_POST['y']))
    {
        $grid_x = $_POST['x'];
        $grid_y = $_POST['y'];
    }

    else
    {
        if (isset($_GET['x']) && ($_GET['y']))
        {
            $grid_x = $_GET['x'];
            $grid_y = $_GET['y'];
        } 
    }

    if ($grid_x == 0)     {$grid_x = $CONF_center_coord_x;}
    if ($grid_y == 0)     {$grid_y = $CONF_center_coord_y;}
    if ($grid_y <= 30)    {$grid_y = "100";}
    if ($grid_x <= 30)    {$grid_x = "100";}
    if ($grid_x >= 99999) {$grid_x = $CONF_center_coord_x;}
    if ($grid_y >= 99999) {$grid_y = $CONF_center_coord_y;}

    $start_x = $grid_x - 20;
    $start_y = $grid_y + 10;
    $end_x   = $grid_x + 20;
    $end_y   = $grid_y - 10;

    mysql_connect($dbort,$dbuser,$dbpw); 
    mysql_select_db($dbdb); 
    $z=mysql_query("SELECT RegionUUID,RegionName,LocX,LocY FROM gridregions");
  
    $xx = 0;
    while($region=mysql_fetch_array($z))
    {
        $work_reg = $region[RegionUUID].";".$region[RegionName].";".$region[LocX].";".$region[LocY];
        $region_sg[$xx] = $work_reg;
        $xx++;
    } 
?>

<div id="modtopright">

<div id="topright1">
  <?php echo $CONF_txt_nav;?>
  <table>
    <tr>
    <td>
      <table id="map">
        <tr>
          <td><img src="<?php echo $SYSURL; ?>images/spacer.gif" alt="" /></td>
          <td><a href="index.php?x=<?php echo $grid_x;?>&amp;y=<?php echo $grid_y + 10; ?>" target="_self">
		  <img src="<?php echo $SYSURL; ?>images/pan_up.png" alt="<?php echo $CONF_txt_north;?>" title="<?php echo $CONF_txt_north;?>" /></a>
          </td>
          <td><img src="<?php echo $SYSURL; ?>images/spacer.gif" alt="" /></td>
        </tr>
        
        <tr>
          <td><a href="index.php?x=<?php print $grid_x - 10; ?>&amp;y=<? print $grid_y; ?>" target="_self">
		  <img src="<?php echo $SYSURL; ?>images/pan_left.png" alt="<?php echo $CONF_txt_west;?>" title="<?php echo $CONF_txt_west;?>" /></a>
          </td>
          <td><a href="index.php?x=<?php echo $CONF_center_coord_x;?>&amp;y=<? echo $CONF_center_coord_y;?>" target="_self">
		  <img src="<?php echo $SYSURL; ?>images/center.png" alt="<?php echo $CONF_txt_center;?>" title="<?php echo $CONF_txt_center;?>" /></a>
          </td>
          <td><a href="index.php?x=<?php print $grid_x + 10; ?>&amp;y=<? print $grid_y; ?>" target="_self">
		  <img src="<?php echo $SYSURL; ?>images/pan_right.png" alt="<?php echo $CONF_txt_east;?>" title="<?php echo $CONF_txt_east;?>" /></a>
          </td>
        </tr>
        
        <tr>
          <td><img src ="<?php echo $SYSURL; ?>images/spacer.gif" alt="" /></td>
          <td><a href="index.php?x=<?php print $grid_x; ?>&amp;y=<?php print $grid_y -10; ?>" target="_self">
		  <img src="<?php echo $SYSURL; ?>images/pan_down.png" alt="<?php echo $CONF_txt_south; ?>" title="<?php echo $CONF_txt_south; ?>" /></a>
          </td>
          <td><img src ="<?php echo $SYSURL; ?>images/spacer.gif" alt="" /></td>
        </tr>
      </table>

    </td>
     </tr>
  </table>
</div>

<div id="topright2"><?php echo $CONF_txt_coords; ?>
<form name="submit" action="index.php" method="post">
<table>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>X: <input type="text" value="<?php print $grid_x; ?>" name="x" size="4" /></td>
  </tr>
  <tr>
    <td>Y: <input type="text" name="y" size="4" value="<?php print $grid_y; ?>" /></td>
  </tr>
  <tr>
    <td><input type="submit" class="submit" style="width:110px;" name="Submit" value="" /></td>
  </tr>
</table>
</form>  
</div>
</div>

<div id="content">

<table id="quickmap">

<?php
$y = $start_y;
$x = $start_x;

  while ($y >= $end_y) {
    $x = $start_x; ?>
    
    <tr >
      <td>
        <div class="styleCoords">
          <?php if ($y <> $start_y) {echo $y;} ?>
        </div>
        <?php while ($x <= $end_x) {if ($y == $start_y) { ?>
      </td>  
      
      <td>
        <div class="styleCoords">
          <?php
          $xs = "a";
          $xs = $x;
          $z1 = ""; $z2 = ""; $z3 = ""; $z4 = ""; $z5 = ""; $z6 = "";
          $z1 = substr($xs,'0','1');
          $z2 = substr($xs,'1','1');
          $z3 = substr($xs,'2','1');
          $z4 = substr($xs,'3','1');
          $z5 = substr($xs,'4','1');
          $z6 = substr($xs,'5','1');

          if (z1) {print $z1;}
          if (z2) {print $z2;}
          if (z3) {print "<br />".$z3;}
          if (z4) {print $z4;}
          if (z5) {print "<br />".$z5;}
          if (z6) {print $z6;}
          ?>
        </div>
        
        <?php $x++; }
          
        else {
          $count = count($region_sg);
          
          for ($q = 0; $q < $count; $q++) {
            $region_value = $region_sg[$q];
            $sim_new = 0;
            list($region_uuid, $region_name, $region_locx, $region_locy) = explode(";",$region_value);

            if ($region_locx >= 100000) {
              $region_locx = $region_locx / 256;
              $region_locy = $region_locy / 256;
            }

            if (($region_locx == $x) && ($region_locy == $y))
              {$sim_new = 1; break;}
          }
          
          if (($x == $CONF_center_coord_x) && ($y == $CONF_center_coord_y)) { ?>
      </td>
             
      <td>
        <a style="cursor:pointer" onClick="window.open('./modules/show_region.php?region=<?php print $region_uuid; ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=980,height=500')">
        <img src="<?php echo $SYSURL; ?>images/grid_mainland.jpg" alt="Region=<?php print $region_name; ?> | X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_occupied; ?>" title="Region=<?php print $region_name; ?> | X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_occupied; ?>" /></a>
        <?php $x++; }
        else { if ($sim_new == 1) { ?>
              
      </td>
              
      <td>
        <a style="cursor:pointer" onClick="window.open('./modules/show_region.php?region=<?php print $region_uuid; ?>','mywindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=980,height=500')">
        <img src="<?php echo $SYSURL; ?>images/grid_occupied.jpg" alt="Region=<?php print $region_name; ?> | X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_occupied; ?>" title="Region=<?php print $region_name; ?> | X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_occupied; ?>" /></a>
        <?php $x++; }
              
        else { ?>
      </td>

      <td>
        <img src="<?php echo $SYSURL; ?>images/grid_free.jpg" alt= "X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_free; ?>" title="X=<?php print $x; ?> | Y=<?php print $y; ?> | Status: <?php echo $CONF_txt_free; ?>" />
        <?php $x++; }}}}
        $y--; } ?>
      </td>
    </tr>
</table>

</div><!-- fin de #content -->
</div><!-- fin de #container -->
</div><!-- fin de #topcontainer -->

<div id="footer">
  <?php  include("./includes/footer.php"); ?>
</div><!-- fin de #footer -->

</body>
</html>
