<?php
if ($_SESSION['ADMINID']){

	$DbLink = new DB;

#region Update

#region For Top Panel Slider
	if ($_POST['displayTopPanelSlider'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTopPanelSlider = '1' ");
	}else if ($_POST['displayTopPanelSlider'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTopPanelSlider = '0' ");
	}

#endregion

#region For Template Selector

	if ($_POST['displayTemplateSelector'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTemplateSelector = '1' ");
	}else if ($_POST['displayTemplateSelector'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTemplateSelector = '0' ");
	}

#endregion

#region For Style Switcher

	if($_POST['displayStyleSwitcher'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSwitcher = '1' ");
	}else if ($_POST['displayStyleSwitcher'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSwitcher = '0' ");
	}

#endregion

#region For Style Sizer

	if($_POST['displayStyleSizer'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSizer = '1' ");
	}else if ($_POST['displayStyleSizer'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSizer = '0' ");
	}

#endregion

#region For Font Sizer

	if($_POST['displayFontSizer'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayFontSizer = '1' ");
	}else if($_POST['displayFontSizer'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayFontSizer = '0' ");
	}

#endregion

#region For Language Selector

	if($_POST['displayLanguageSelector'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLanguageSelector = '1' ");
	}else if($_POST['displayLanguageSelector'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLanguageSelector = '0' ");
	}

#endregion

#region For Scrolling Text

	if($_POST['displayScrollingText'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayScrollingText = '1' ");
	}else if($_POST['displayScrollingText'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayScrollingText = '0' ");
	}

#endregion

#region For Welcome Message

	if($_POST['displayWelcomeMessage'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayWelcomeMessage = '1' ");
	}else if($_POST['displayWelcomeMessage'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayWelcomeMessage = '0' ");
	}

#endregion

#region For Logo Effect

	if($_POST['displayLogoEffect'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLogoEffect = '1' ");
	}else if($_POST['displayLogoEffect'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLogoEffect = '0' ");
	}

#endregion

#region For Slide Show

	if($_POST['displaySlideShow'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displaySlideShow = '1' ");
	}else if($_POST['displaySlideShow'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displaySlideShow = '0' ");
	}

#endregion

#region For Mega Menu

	if($_POST['displayMegaMenu'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayMegaMenu = '1' ");
	}else if($_POST['displayMegaMenu'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayMegaMenu = '0' ");
	}

#endregion

#region For Date
	if($_POST['displayDate'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayDate = '1' ");
	}else if($_POST['displayDate'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayDate = '0' ");
	}

#endregion

#region For Time

	if($_POST['displayTime'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTime = '1' ");
	}else if($_POST['displayTime'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTime = '0' ");
	}

#endregion

#region For Rounded Corner

	if($_POST['displayRoundedCorner'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRoundedCorner = '1' ");
	}else if($_POST['displayRoundedCorner'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRoundedCorner = '0' ");
	}

#endregion

#region For Background Color Animation

	if($_POST['displayBackgroundColorAnimation'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayBackgroundColorAnimation = '1' ");
	}else if($_POST['displayBackgroundColorAnimation'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayBackgroundColorAnimation = '0' ");
	}

#endregion

#region For Page Load Time

	if($_POST['displayPageLoadTime'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayPageLoadTime = '1' ");
	}else if($_POST[displayPageLoadTime] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayPageLoadTime = '0' ");
	}

#endregion

#region For W3c

	if($_POST['displayW3c'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayW3c = '1' ");
	}else if($_POST['displayW3c'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayW3c = '0' ");
	}

#endregion

#region For Rss

	if($_POST['displayRss'] == $webui_admin_settings_activate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRss = '1' ");
	}else if($_POST['displayRss'] == $webui_admin_settings_desactivate_bouton){
		$DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRss = '0' ");
	}

#endregion

#endregion

	$DbLink->query('SELECT
		id,
		displayTopPanelSlider,
		displayTemplateSelector,
		displayStyleSwitcher,
		displayStyleSizer,
		displayFontSizer,
		displayLanguageSelector,
		displayScrollingText,
		displayWelcomeMessage,
		displayLogo,
		displayLogoEffect,
		displaySlideShow,
		displayMegaMenu,
		displayDate,
		displayTime,
		displayRoundedCorner,
		displayBackgroundColorAnimation,
		displayPageLoadTime,
		displayW3c,
		displayRss FROM ' . C_ADMINMODULES_TBL . ' ');

	list(
		$id,
		$displayTopPanelSlider,
		$displayTemplateSelector,
		$displayStyleSwitcher,
		$displayStyleSizer,
		$displayFontSizer,
		$displayLanguageSelector,
		$displayScrollingText,
		$displayWelcomeMessage,
		$displayLogo,
		$displayLogoEffect,
		$displaySlideShow,
		$displayMegaMenu,
		$displayDate,
		$displayTime,
		$displayRoundedCorner,
		$displayBackgroundColorAnimation,
		$displayPageLoadTime,
		$displayW3c,
		$displayRss
	) = $DbLink->next_record();
?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
	<div id="ContentHeaderCenter"></div>
	<div id="ContentHeaderRight"><h5><?php echo $webui_admin_options; ?></h5></div>
	<div id="adminsettings">
		<div id="info"><p><?php echo $webui_admin_options_info; ?></p></div>
		<form id="form" name="form" method="post" action="index.php?page=adminoptions">
			<table>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_TopPanelSlider; ?></td>
<?php	if ($displayTopPanelSlider == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_TopPanelSlider_desactive; ?>" title="<?php echo $webui_admin_options_TopPanelSlider_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_TopPanelSlider_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayTopPanelSlider" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_TopPanelSlider_active; ?>" title="<?php echo $webui_admin_options_TopPanelSlider_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_TopPanelSlider_active; ?></td>
					<td class="odd"><input type="submit" name="displayTopPanelSlider" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_TemplateSelector; ?></td>
<?php	if ($displayTemplateSelector == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_TemplateSelector_desactive; ?>" title="<?php echo $webui_admin_options_TemplateSelector_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_TemplateSelector_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayTemplateSelector" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_TemplateSelector_active; ?>" title="<?php echo $webui_admin_options_TemplateSelector_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_TemplateSelector_active; ?></td>
					<td class="odd"><input type="submit" name="displayTemplateSelector" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_StyleSwitcher; ?></td>
<?php	if ($displayStyleSwitcher == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_StyleSwitcher_desactive; ?>" title="<?php echo $webui_admin_options_StyleSwitcher_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_StyleSwitcher_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayStyleSwitcher" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_StyleSwitcher_active; ?>" title="<?php echo $webui_admin_options_StyleSwitcher_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_StyleSwitcher_active; ?></td>
					<td class="odd"><input type="submit" name="displayStyleSwitcher" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_StyleSizer; ?></td>
<?php	if ($displayStyleSizer == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_StyleSizer_desactive; ?>" title="<?php echo $webui_admin_options_StyleSizer_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_StyleSizer_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayStyleSizer" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_StyleSizer_active; ?>" title="<?php echo $webui_admin_options_StyleSizer_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_StyleSizer_active; ?></td>
					<td class="odd"><input type="submit" name="displayStyleSizer" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_FontSizer; ?></td>
<?php	if($displayFontSizer == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_FontSizer_desactive; ?>" title="<?php echo $webui_admin_options_FontSizer_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_FontSizer_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayFontSizer" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_FontSizer_active; ?>" title="<?php echo $webui_admin_options_FontSizer_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_FontSizer_active; ?></td>
					<td class="odd"><input type="submit" name="displayFontSizer" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_LanguageSelector; ?></td>
<?php	if ($displayLanguageSelector == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_LanguageSelector_desactive; ?>" title="<?php echo $webui_admin_options_LanguageSelector_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_LanguageSelector_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayLanguageSelector" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_LanguageSelector_active; ?>" title="<?php echo $webui_admin_options_LanguageSelector_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_LanguageSelector_active; ?></td>
					<td class="odd"><input type="submit" name="displayLanguageSelector" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_ScrollingText; ?></td>
<?php	if ($displayScrollingText == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_ScrollingText_desactive; ?>" title="<?php echo $webui_admin_options_ScrollingText_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_ScrollingText_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayScrollingText" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_ScrollingText_active; ?>" title="<?php echo $webui_admin_options_ScrollingText_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_ScrollingText_active; ?></td>
					<td class="odd"><input type="submit" name="displayScrollingText" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_WelcomeMessage; ?></td>
<?php	if ($displayWelcomeMessage == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_WelcomeMessage_desactive; ?>" title="<?php echo $webui_admin_options_WelcomeMessage_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_WelcomeMessage_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayWelcomeMessage" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_WelcomeMessage_active; ?>" itle="<?php echo $webui_admin_options_WelcomeMessage_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_WelcomeMessage_active; ?></td>
					<td class="odd"><input type="submit" name="displayWelcomeMessage" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_Logo; ?></td>
<?php	if ($displayLogo == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_Logo_desactive; ?>" title="<?php echo $webui_admin_options_Logo_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Logo_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayLogo" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_Logo_active; ?>" title="<?php echo $webui_admin_options_Logo_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Logo_active; ?></td>
					<td class="odd"><input type="submit" name="displayLogo" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_LogoEffect; ?></td>
<?php	if ($displayLogoEffect == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_LogoEffect_desactive; ?>" title="<?php echo $webui_admin_options_LogoEffect_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_LogoEffect_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayLogoEffect" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_LogoEffect_active; ?>" title="<?php echo $webui_admin_options_LogoEffect_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_LogoEffect_active; ?></td>
					<td class="odd"><input type="submit" name="displayLogoEffect" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_SlideShow; ?></td>
<?php	if ($displaySlideShow == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_SlideShow_desactive; ?>" title="<?php echo $webui_admin_options_SlideShow_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_SlideShow_desactive; ?></td>
					<td class="odd"><input type="submit" name="displaySlideShow" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_SlideShow_active; ?>" title="<?php echo $webui_admin_options_SlideShow_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_SlideShow_active; ?></td>
					<td class="odd"><input type="submit" name="displaySlideShow" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_MegaMenu; ?></td>
<?php	if ($displayMegaMenu == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_MegaMenu_desactive; ?>" title="<?php echo $webui_admin_options_MegaMenu_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_MegaMenu_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayMegaMenu" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_MegaMenu_active; ?>" title="<?php echo $webui_admin_options_MegaMenu_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_MegaMenu_active; ?></td>
					<td class="odd"><input type="submit" name="displayMegaMenu" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_Date; ?></td>
<?php	if ($displayDate == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_Date_desactive; ?>" title="<?php echo $webui_admin_options_Date_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Date_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayDate" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_Date_active; ?>" title="<?php echo $webui_admin_options_Date_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Date_active; ?></td>
					<td class="odd"><input type="submit" name="displayDate" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_Time; ?></td>
<?php	if ($displayTime == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_Time_desactive; ?>" title="<?php echo $webui_admin_options_Time_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Time_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayTime" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_Time_active; ?>" title="<?php echo $webui_admin_options_Time_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Time_active; ?></td>
					<td class="odd"><input type="submit" name="displayTime" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_RoundedCorner; ?></td>
<?php	if ($displayRoundedCorner == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_RoundedCorner_desactive; ?>" title="<?php echo $webui_admin_options_RoundedCorner_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_RoundedCorner_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayRoundedCorner" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_RoundedCorner_active; ?>" title="<?php echo $webui_admin_options_RoundedCorner_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_RoundedCorner_active; ?></td>
					<td class="odd"><input type="submit" name="displayRoundedCorner" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_BackgroundColorAnimation; ?></td>
<?php	if ($displayBackgroundColorAnimation == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_BackgroundColorAnimation_desactive; ?>" title="<?php echo $webui_admin_options_BackgroundColorAnimation_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_BackgroundColorAnimation_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayBackgroundColorAnimation" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_BackgroundColorAnimation_active; ?>" title="<?php echo $webui_admin_options_BackgroundColorAnimation_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_BackgroundColorAnimation_active; ?></td>
					<td class="odd"><input type="submit" name="displayBackgroundColorAnimation" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_PageLoadTime; ?></td>
<?php	if ($displayPageLoadTime == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_PageLoadTime_desactive; ?>" title="<?php echo $webui_admin_options_PageLoadTime_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_PageLoadTime_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayPageLoadTime" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_PageLoadTime_active; ?>" title="<?php echo $webui_admin_options_PageLoadTime_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_PageLoadTime_active; ?></td>
					<td class="odd"><input type="submit" name="displayPageLoadTime" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_W3c; ?></td>
<?php	if ($displayW3c == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_W3c_desactive; ?>" title="<?php echo $webui_admin_options_W3c_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_W3c_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayW3c" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_W3c_active; ?>" title="<?php echo $webui_admin_options_W3c_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_W3c_active; ?></td>
					<td class="odd"><input type="submit" name="displayW3c" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
				<tr>
					<td class="odd"><?php echo $webui_admin_options_Rss; ?></td>
<?php	if ($displayRss == 0){ ?>
					<td class="odd">
						<img src="images/icons/desactivate.png" alt="<?php echo $webui_admin_options_Rss_desactive; ?>" title="<?php echo $webui_admin_options_Rss_desactive; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Rss_desactive; ?></td>
					<td class="odd"><input type="submit" name="displayRss" value="<?php echo $webui_admin_settings_activate_bouton; ?>" /></td>
<?php	}else{ ?>
					<td class="odd">
						<img src="images/icons/activate.png" alt="<?php echo $webui_admin_options_Rss_active; ?>" title="<?php echo $webui_admin_options_Rss_active; ?>">
					</td>
					<td class="odd"><?php echo $webui_admin_options_Rss_active; ?></td>
					<td class="odd"><input type="submit" name="displayRss" value="<?php echo $webui_admin_settings_desactivate_bouton; ?>" /></td>
<?php	} ?>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php } ?>
