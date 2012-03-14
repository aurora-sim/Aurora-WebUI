<script type="text/javascript" src="javascripts/highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="javascripts/highslide/highslide.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="javascripts/highslide/highslide-ie6.css" />
<![endif]-->
<script type="text/javascript"> 
    hs.graphicsDir = 'javascripts/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

<!--
    3) This is how you mark up the thumbnail image with an anchor tag around it.
    The anchor's href attribute defines the URL of the full-size image.
-->

<!--
    4 (optional). This is how you mark up the caption. The caption must be directly
    after the anchor above.
-->

<div id="content">
	<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><? echo $webui_addgrid; ?></h5></div>
	<div id="addgrid">
	<div id="info"><p><? echo $webui_addgrid_info; ?></p></div>

	<div id="addgrid01">
		<div align="center"><center>
		<table>
			<tr>
				<td width="20%" align="center">
					<h3><? echo $webui_addgrid_hippo; ?></h3>
					<a id="thumb1" href="images/viewers/aurora_hippo_01.jpg" class="highslide" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
					<img style="margin-top: 15px" width="120" height="80" src="images/viewers/aurora_hippo_thumb_01.jpg" alt="Highslide JS" title="<? echo $webui_addgrid_click_to_enlarge; ?>" /></a>
					<div class='highslide-caption' id="caption-for-thumb1"><? echo $webui_addgrid_config_hippo; ?>"</div>
				</td>
				<td width="20%" align="center">
					<h3><? echo $webui_addgrid_imprudence; ?></h3>
					<a id="thumb2" href="images/viewers/aurora_imprudence_01.jpg" class="highslide" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
					<img style="margin-top: 15px" width="120" height="80" src="images/viewers/aurora_imprudence_thumb_01.jpg" alt="Highslide JS" title="<? echo $webui_addgrid_click_to_enlarge; ?>" /></a>
					<div class='highslide-caption' id="caption-for-thumb2"><? echo $webui_addgrid_config_imprudence; ?>"</div>
				</td>
				<td width="20%" align="center">
					<h3><? echo $webui_addgrid_phoenix; ?></h3>
					<a id="thumb3" href="images/viewers/aurora_phoenix_01.jpg" class="highslide" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
					<img style="margin-top: 15px" width="120" height="80" src="images/viewers/aurora_phoenix_thumb_01.jpg" alt="Highslide JS" title="<? echo $webui_addgrid_click_to_enlarge; ?>" /></a>
					<div class='highslide-caption' id="caption-for-thumb3"><? echo $webui_addgrid_config_phoenix; ?>"</div>
				</td>
				<td width="20%" align="center">
					<h3><? echo $webui_addgrid_astra; ?></h3>
					<a id="thumb4" href="images/viewers/aurora_astra_01.jpg" class="highslide" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
					<img style="margin-top: 15px" width="120" height="80" src="images/viewers/aurora_astra_thumb_01.jpg" alt="Highslide JS" title="<? echo $webui_addgrid_click_to_enlarge; ?>" /></a>
					<div class='highslide-caption' id="caption-for-thumb4"><? echo $webui_addgrid_config_astra; ?>"</div>
				</td>
				<td width="20%" align="center">
					<h3><? echo $webui_addgrid_singularity; ?></h3>
					<a id="thumb5" href="images/viewers/aurora_singularity_01.jpg" class="highslide" onclick="return hs.expand(this, {wrapperClassName: 'borderless floating-caption', dimmingOpacity: 0.75, align: 'center'})">
					<img style="margin-top: 15px" width="120" height="80" src="images/viewers/aurora_singularity_thumb_01.jpg" alt="Highslide JS" title="<? echo $webui_addgrid_click_to_enlarge; ?>" /></a>
					<div class='highslide-caption' id="caption-for-thumb5"><? echo $webui_addgrid_config_singularity; ?>"</div>
				</td>
			</tr>
		</table>
		</center></div>
	</div>

	<div class="clear"></div>

		<div id="addgrid02">
			<h3><? echo $webui_addgrid_title; ?></h3>
			<p>&#149; <? echo $webui_addgrid_add; ?></p>
			<p>&#149; <? echo $webui_addgrid_complete; ?></p>
		
			<p><b><? echo $webui_addgrid_gridNick; ?> :</b> <?= AddGrid_GridNick ?></p>
			<p><b><? echo $webui_addgrid_gridName; ?> :</b> <?= AddGrid_GridName ?></p>

			<p><b><? echo $webui_addgrid_AvFirstName; ?> :</b> <?= AddGrid_AvFirstName ?></p>
			<p><b><? echo $webui_addgrid_AvlastName; ?> :</b> <?= AddGrid_AvLastName ?></p>
			<p><b><? echo $webui_addgrid_Avpassword; ?> :</b> <?= AddGrid_AvPassword ?></p>		
		
			<p><b><? echo $webui_addgrid_loginURL; ?> :</b> <?= AddGrid_LoginURL ?></p>
		
			<p>&#149; <? echo $webui_addgrid_getGridInfo; ?></p>
			<p><b><? echo $webui_addgrid_loginPage; ?> :</b> <?= AddGrid_LoginPage ?></p>
			<p><b><? echo $webui_addgrid_helperURL; ?> :</b> <?= AddGrid_HelperURL ?></p>
			<p><b><? echo $webui_addgrid_website; ?> :</b> <?= AddGrid_Website ?></p>
			<p><b><? echo $webui_addgrid_support; ?> :</b> <?= AddGrid_Support ?></p>
			<p><b><? echo $webui_addgrid_account; ?> :</b> <?= AddGrid_Account ?></p>
			<p><b><? echo $webui_addgrid_password; ?> :</b> <?= AddGrid_Password ?></p>
			<p><b><? echo $webui_addgrid_webSearch; ?> :</b> <?= AddGrid_WebSearch ?></p>
			<!-- <p><b>Select a grid :</b> digigrids</p> -->
			<!-- <p><b>Plateform :</b> OpenSim</p> -->
			<p>&#149; <? echo $webui_addgrid_apply; ?></p>
			<p>&#149; <? echo $webui_addgrid_login; ?></p>
			<p>* <? echo $webui_addgrid_valid; ?></p>
		</div>

		<?php if($displayWelcomeMessage) { ?>
			<?php
			if($_SESSION[NAME] != "") {
				// echo $webui_welcome_back." ";
				// echo $_SESSION[NAME];
				if($allowWebLogin == 'true')
				{
				echo "<div class='clear'></div><div id='addgrid10'><center><h3>";
				echo "<a href=\"secondlife:///app/login?first_name=$_SESSION[FIRSTNAME]&last_name=$_SESSION[LASTNAME]&location=last&grid=$gridNickName&web_login_key=$_SESSION[WEBLOGINKEY]\">$webui_login</a> au chat 3D.";
				echo "</h3></center></div>";
				}
			}
			else {;}
			?>
		<?php } ?>

		<div id="alert"><p><? echo $webui_addgrid_diff_info; ?></p></div>

		<div id="addgrid03">
			<h3><? echo $webui_addgrid_diff_title; ?></h3>
			<p>&#149; <? echo $webui_addgrid_diff_shortcut; ?></p>
			<p>&#149; <? echo $webui_addgrid_diff_propriete; ?></p>
			<p>&#149; <? echo $webui_addgrid_diff_complete; ?></p>

			<p>- <b><? echo $webui_addgrid_KokuaViewer; ?> :</b> Kokua.exe" -loginuri <?= AddGrid_KokuaURL ?></p>
			<p>- <b><? echo $webui_addgrid_SecondLifeViewer; ?> :</b> SecondLife.exe" -loginuri <?= AddGrid_SecondLifeURL ?></p>
			<p>- <b><? echo $webui_addgrid_KristenViewer; ?> :</b> Kirstens S20.exe" -loginuri <?= AddGrid_KristenURL ?></p>
		</div>

    <?php if($AddGrid_IWC_Actived) { ?>
		<div id="info"><p><? echo $webui_addgrid_IWC_info; ?></p></div>
		<div id="addgrid04">
			<h3><? echo $webui_addgrid_IWC_title; ?></h3>
			<p><b><? echo $webui_addgrid_IWC_content; ?> :</b> <?=AddGrid_IWC_URL_1 ?> </p>
		</div>
    <?php } ?>
    
    <?php if($AddGrid_HG_Actived) { ?>
		<div id="info"><p><? echo $webui_addgrid_HG_info; ?></p></div>
		<div id="addgrid04">
			<h3><? echo $webui_addgrid_HG_title; ?></h3>
			<p><b><? echo $webui_addgrid_HG_content; ?> :</b> <?=AddGrid_HG_URL_1 ?> </p>
		</div>
    <?php } ?>
		
    <div id="alert"><p><? echo $webui_addgrid_banned_info; ?></p></div>
		<div id="addgrid05">
			<h3><? echo $webui_addgrid_banned_title; ?></h3>
			<p><? echo $webui_addgrid_banned_content; ?></p>
		</div>
		<!-- <?php // include("sites/modules/steps123.php"); ?> -->
	</div>
</div>
