<?php
if ($_SESSION['ADMINID']){

#region Update

	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$update = array();

#region For Top Panel Slider

		if(isset($_POST['displayTopPanelSlider'])){
			$update['displayTopPanelSlider'] = ($_POST['displayTopPanelSlider'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Template Selector

		if(isset($_POST['displayTemplateSelector'])){
			$update['displayTemplateSelector'] = ($_POST['displayTemplateSelector'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Style Switcher

		if(isset($_POST['displayStyleSwitcher'])){
			$update['displayStyleSwitcher'] = ($_POST['displayStyleSwitcher'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Style Sizer

		if(isset($_POST['displayStyleSizer'])){
			$update['displayStyleSizer'] = ($_POST['displayStyleSizer'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Font Sizer

		if(isset($_POST['displayFontSizer'])){
			$update['displayFontSizer'] = ($_POST['displayFontSizer'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Language Selector

		if(isset($_POST['displayLanguageSelector'])){
			$update['displayLanguageSelector'] = ($_POST['displayLanguageSelector'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Scrolling Text

		if(isset($_POST['displayScrollingText'])){
			$update['displayScrollingText'] = ($_POST['displayScrollingText'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Welcome Message

		if(isset($_POST['displayWelcomeMessage'])){
			$update['displayWelcomeMessage'] = ($_POST['displayWelcomeMessage'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Logo Effect

		if(isset($_POST['displayLogoEffect'])){
			$update['displayLogoEffect'] = ($_POST['displayLogoEffect'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Slide Show

		if(isset($_POST['displaySlideShow'])){
			$update['displaySlideShow'] = ($_POST['displaySlideShow'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Mega Menu

		if(isset($_POST['displayMegaMenu'])){
			$update['displayMegaMenu'] = ($_POST['displayMegaMenu'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Date

		if(isset($_POST['displayDate'])){
			$update['displayDate'] = ($_POST['displayDate'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Time

		if(isset($_POST['displayTime'])){
			$update['displayTime'] = ($_POST['displayTime'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Rounded Corner

		if(isset($_POST['displayRoundedCorner'])){
			$update['displayRoundedCorner'] = ($_POST['displayRoundedCorner'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Background Color Animation

		if(isset($_POST['displayBackgroundColorAnimation'])){
			$update['displayBackgroundColorAnimation'] = ($_POST['displayBackgroundColorAnimation'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Page Load Time

		if(isset($_POST['displayPageLoadTime'])){
			$update['displayPageLoadTime'] = ($_POST['displayPageLoadTime'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For W3c

		if(isset($_POST['displayW3c'])){
			$update['displayW3c'] = ($_POST['displayW3c'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

#region For Rss

		if(isset($_POST['displayRss'])){
			$update['displayRss'] = ($_POST['displayRss'] == $webui_admin_settings_activate_bouton) ? 1 : 0;
		}

#endregion

		if(count($pdate) > 0){
			Globals::i()->DBLink->Update(C_ADMINMODULES_TBL, $update);
		}

	}

#endregion

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
	) = Globals::i()->DBLink->Query(array(
		'id',
		'displayTopPanelSlider',
		'displayTemplateSelector',
		'displayStyleSwitcher',
		'displayStyleSizer',
		'displayFontSizer',
		'displayLanguageSelector',
		'displayScrollingText',
		'displayWelcomeMessage',
		'displayLogo',
		'displayLogoEffect',
		'displaySlideShow',
		'displayMegaMenu',
		'displayDate',
		'displayTime',
		'displayRoundedCorner',
		'displayBackgroundColorAnimation',
		'displayPageLoadTime',
		'displayW3c',
		'displayRss'
	), C_ADMINMODULES_TBL);
?>
<div id="content">
	<div id="ContentHeaderLeft"><h5><?php echo SYSNAME; ?></h5></div>
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
