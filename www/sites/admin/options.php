<? if ($_SESSION[ADMINID]) { ?>

<?php
  $DbLink = new DB;

  // For Top Panel Slider
  if ($_POST[displayTopPanelSlider] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTopPanelSlider = '1' ");
  }
  
  if ($_POST[displayTopPanelSlider] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTopPanelSlider = '0' ");
  }

  // For Template Selector
  if ($_POST[displayTemplateSelector] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTemplateSelector = '1' ");
  }
  
  if ($_POST[displayTemplateSelector] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTemplateSelector = '0' ");
  }

  // For Style Switcher
  if ($_POST[displayStyleSwitcher] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSwitcher = '1' ");
  }
  
  if ($_POST[displayStyleSwitcher] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSwitcher = '0' ");
  }

  // For Style Sizer
  if ($_POST[displayStyleSizer] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSizer = '1' ");
  }
  
  if ($_POST[displayStyleSizer] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayStyleSizer = '0' ");
  }

  // For Font Sizer
  if ($_POST[displayFontSizer] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayFontSizer = '1' ");
  }
  
  if ($_POST[displayFontSizer] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayFontSizer = '0' ");
  }

  // For Language Selector
  if ($_POST[displayLanguageSelector] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLanguageSelector = '1' ");
  }
  
  if ($_POST[displayLanguageSelector] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLanguageSelector = '0' ");
  }

  // For Scrolling Text
  if ($_POST[displayScrollingText] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayScrollingText = '1' ");
  }
  
  if ($_POST[displayScrollingText] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayScrollingText = '0' ");
  }
  
  // For Welcome Message
  if ($_POST[displayWelcomeMessage] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayWelcomeMessage = '1' ");
  }
  
  if ($_POST[displayWelcomeMessage] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayWelcomeMessage = '0' ");
  }

  // For Logo Effect
  if ($_POST[displayLogoEffect] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLogoEffect = '1' ");
  }
  
  if ($_POST[displayLogoEffect] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayLogoEffect = '0' ");
  }
  
  // For Slide Show
  if ($_POST[displaySlideShow] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displaySlideShow = '1' ");
  }
  
  if ($_POST[displaySlideShow] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displaySlideShow = '0' ");
  }
  
  // For Mega Menu
  if ($_POST[displayMegaMenu] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayMegaMenu = '1' ");
  }
  
  if ($_POST[displayMegaMenu] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayMegaMenu = '0' ");
  }
  
  // For Date
  if ($_POST[displayDate] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayDate = '1' ");
  }
  
  if ($_POST[displayDate] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayDate = '0' ");
  }
  
  // For Time
  if ($_POST[displayTime] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTime = '1' ");
  }
  
  if ($_POST[displayTime] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayTime = '0' ");
  }
  
  // For Rounded Corner
  if ($_POST[displayRoundedCorner] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRoundedCorner = '1' ");
  }
  
  if ($_POST[displayRoundedCorner] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRoundedCorner = '0' ");
  }
  
  // For Background Color Animation
  if ($_POST[displayBackgroundColorAnimation] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayBackgroundColorAnimation = '1' ");
  }
  
  if ($_POST[displayBackgroundColorAnimation] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayBackgroundColorAnimation = '0' ");
  }

  // For Page Load Time
  if ($_POST[displayPageLoadTime] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayPageLoadTime = '1' ");
  }
  
  if ($_POST[displayPageLoadTime] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayPageLoadTime = '0' ");
  }

  // For W3c
  if ($_POST[displayW3c] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayW3c = '1' ");
  }
  
  if ($_POST[displayW3c] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayW3c = '0' ");
  }
  
  // For Rss
  if ($_POST[displayRss] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRss = '1' ");
  }
  
  if ($_POST[displayRss] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINMODULES_TBL . " SET displayRss = '0' ");
  }

  $DbLink->query("SELECT id,
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
                         displayRss FROM ".C_ADMINMODULES_TBL." ");
                     
  list($id,
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
       $displayRss) = $DbLink->next_record();
?>

<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_admin_options; ?></h5></div>
  <div id="adminsettings">
  <div id="info"><p><? echo $webui_admin_options_info; ?></p></div>
  
  <table>
    <form id="form" name="form" method="post" action="index.php?page=adminoptions">


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_TopPanelSlider; ?>
        </td>
        
        <td class="odd">
          <? if ($displayTopPanelSlider == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_TopPanelSlider_desactive; ?>" 
               title="<? echo $webui_admin_options_TopPanelSlider_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_TopPanelSlider_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayTopPanelSlider" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_TopPanelSlider_active; ?>" 
               title="<? echo $webui_admin_options_TopPanelSlider_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_TopPanelSlider_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayTopPanelSlider" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_TemplateSelector; ?>
        </td>
        
        <td class="odd">
          <? if ($displayTemplateSelector == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_TemplateSelector_desactive; ?>" 
               title="<? echo $webui_admin_options_TemplateSelector_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_TemplateSelector_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayTemplateSelector" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_TemplateSelector_active; ?>" 
               title="<? echo $webui_admin_options_TemplateSelector_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_TemplateSelector_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayTemplateSelector" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_StyleSwitcher; ?>
        </td>
        
        <td class="odd">
          <? if ($displayStyleSwitcher == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_StyleSwitcher_desactive; ?>" 
               title="<? echo $webui_admin_options_StyleSwitcher_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_StyleSwitcher_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayStyleSwitcher" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_StyleSwitcher_active; ?>" 
               title="<? echo $webui_admin_options_StyleSwitcher_active; ?>">            

        <td class="odd">
          <? echo $webui_admin_options_StyleSwitcher_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayStyleSwitcher" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_StyleSizer; ?>
        </td>
        
        <td class="odd">
          <? if ($displayStyleSizer == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_StyleSizer_desactive; ?>" 
               title="<? echo $webui_admin_options_StyleSizer_desactive; ?>">
                         
        <td class="odd">
          <? echo $webui_admin_options_StyleSizer_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayStyleSizer" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_StyleSizer_active; ?>" 
               title="<? echo $webui_admin_options_StyleSizer_active; ?>">           

        <td class="odd">
          <? echo $webui_admin_options_StyleSizer_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayStyleSizer" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_FontSizer; ?>
        </td>
        
        <td class="odd">
          <? if ($displayFontSizer == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_FontSizer_desactive; ?>" 
               title="<? echo $webui_admin_options_FontSizer_desactive; ?>">
        <td class="odd">
          <? echo $webui_admin_options_FontSizer_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayFontSizer" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
        
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_FontSizer_active; ?>" 
               title="<? echo $webui_admin_options_FontSizer_active; ?>"> 

        <td class="odd">
          <? echo $webui_admin_options_FontSizer_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayFontSizer" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_LanguageSelector; ?>
        </td>
        
        <td class="odd">
          <? if ($displayLanguageSelector == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_LanguageSelector_desactive; ?>" 
               title="<? echo $webui_admin_options_LanguageSelector_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_LanguageSelector_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayLanguageSelector" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_LanguageSelector_active; ?>" 
               title="<? echo $webui_admin_options_LanguageSelector_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_LanguageSelector_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayLanguageSelector" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_ScrollingText; ?>
        </td>
        
        <td class="odd">
          <? if ($displayScrollingText == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_ScrollingText_desactive; ?>" 
               title="<? echo $webui_admin_options_ScrollingText_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_ScrollingText_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayScrollingText" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_ScrollingText_active; ?>" 
               title="<? echo $webui_admin_options_ScrollingText_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_ScrollingText_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayScrollingText" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_WelcomeMessage; ?>
        </td>
        
        <td class="odd">
          <? if ($displayWelcomeMessage == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_WelcomeMessage_desactive; ?>" 
               title="<? echo $webui_admin_options_WelcomeMessage_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_WelcomeMessage_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayWelcomeMessage" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_WelcomeMessage_active; ?>" 
               title="<? echo $webui_admin_options_WelcomeMessage_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_WelcomeMessage_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayWelcomeMessage" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_Logo; ?>
        </td>
        
        <td class="odd">
          <? if ($displayLogo == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_Logo_desactive; ?>" 
               title="<? echo $webui_admin_options_Logo_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Logo_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayLogo" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_Logo_active; ?>" 
               title="<? echo $webui_admin_options_Logo_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Logo_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayLogo" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_LogoEffect; ?>
        </td>
        
        <td class="odd">
          <? if ($displayLogoEffect == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_LogoEffect_desactive; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_LogoEffect_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayLogoEffect" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_LogoEffect_active; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_LogoEffect_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayLogoEffect" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_SlideShow; ?>
        </td>
        
        <td class="odd">
          <? if ($displaySlideShow == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_SlideShow_desactive; ?>" 
               title="<? echo $webui_admin_options_SlideShow_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_SlideShow_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displaySlideShow" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_SlideShow_active; ?>" 
               title="<? echo $webui_admin_options_SlideShow_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_SlideShow_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displaySlideShow" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_MegaMenu; ?>
        </td>
        
        <td class="odd">
          <? if ($displayMegaMenu == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_MegaMenu_desactive; ?>" 
               title="<? echo $webui_admin_options_MegaMenu_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_MegaMenu_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayMegaMenu" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_MegaMenu_active; ?>" 
               title="<? echo $webui_admin_options_MegaMenu_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_MegaMenu_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayMegaMenu" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_Date; ?>
        </td>
        
        <td class="odd">
          <? if ($displayDate == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_Date_desactive; ?>" 
               title="<? echo $webui_admin_options_Date_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Date_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayDate" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_Date_active; ?>" 
               title="<? echo $webui_admin_options_Date_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Date_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayDate" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_Time; ?>
        </td>
        
        <td class="odd">
          <? if ($displayTime == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_Time_desactive; ?>" 
               title="<? echo $webui_admin_options_Time_desactive; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Time_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayTime" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_Time_active; ?>" 
               title="<? echo $webui_admin_options_Time_active; ?>">

        <td class="odd">
          <? echo $webui_admin_options_Time_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayTime" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>
      

      <tr>
        <td class="odd">
          <? echo $webui_admin_options_RoundedCorner; ?>
        </td>
        
        <td class="odd">
          <? if ($displayRoundedCorner == 0) { ?>

          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_RoundedCorner_desactive; ?>" 
               title="<? echo $webui_admin_options_RoundedCorner_desactive; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_RoundedCorner_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayRoundedCorner" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
           
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_RoundedCorner_active; ?>" 
               title="<? echo $webui_admin_options_RoundedCorner_active; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_RoundedCorner_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayRoundedCorner" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>


      <tr>
        <td class="odd">
          <? echo $webui_admin_options_BackgroundColorAnimation; ?>
        </td>
        
        <td class="odd">
          <? if ($displayBackgroundColorAnimation == 0) { ?>

          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_BackgroundColorAnimation_desactive; ?>" 
               title="<? echo $webui_admin_options_BackgroundColorAnimation_desactive; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_BackgroundColorAnimation_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayBackgroundColorAnimation" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
           
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_BackgroundColorAnimation_active; ?>" 
               title="<? echo $webui_admin_options_BackgroundColorAnimation_active; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_BackgroundColorAnimation_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayBackgroundColorAnimation" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>





      <tr>
        <td class="odd">
          <? echo $webui_admin_options_PageLoadTime; ?>
        </td>
        
        <td class="odd">
          <? if ($displayPageLoadTime == 0) { ?>

          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_PageLoadTime_desactive; ?>" 
               title="<? echo $webui_admin_options_PageLoadTime_desactive; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_PageLoadTime_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayPageLoadTime" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
           
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_PageLoadTime_active; ?>" 
               title="<? echo $webui_admin_options_PageLoadTime_active; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_PageLoadTime_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayPageLoadTime" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>





      <tr>
        <td class="odd">
          <? echo $webui_admin_options_W3c; ?>
        </td>
        
        <td class="odd">
          <? if ($displayW3c == 0) { ?>

          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_W3c_desactive; ?>" 
               title="<? echo $webui_admin_options_W3c_desactive; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_W3c_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayW3c" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
           
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_W3c_active; ?>" 
               title="<? echo $webui_admin_options_W3c_active; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_W3c_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayW3c" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>





      <tr>
        <td class="odd">
          <? echo $webui_admin_options_Rss; ?>
        </td>
        
        <td class="odd">
          <? if ($displayRss == 0) { ?>

          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_Rss_desactive; ?>" 
               title="<? echo $webui_admin_options_Rss_desactive; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_Rss_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayRss" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>
           
          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_Rss_active; ?>" 
               title="<? echo $webui_admin_options_Rss_active; ?>">
               
        <td class="odd">
          <? echo $webui_admin_options_Rss_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayRss" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>
          <? } ?>
        </td>
      </tr>
           
    </form>
    </table>
  </div>
</div>
<? } ?>
