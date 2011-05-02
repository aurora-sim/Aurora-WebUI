<? if ($_SESSION[ADMINID]) { ?>

<?php
  $DbLink = new DB;
    
  // For Background Color Animation
  
  if ($_POST[displayLogoEffect] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Display = '1' WHERE Options = 'displayLogoEffect' ");
  }
  
  if ($_POST[displayLogoEffect] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Display = '0' WHERE Options = 'displayLogoEffect' ");
  }
  
  
  
  
  
  if ($_POST[displayBackgroundColorAnimation] == "$webui_admin_settings_activate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Display = '1' WHERE Options = 'BackgroundColorAnimation' ");
  }
  
  if ($_POST[displayBackgroundColorAnimation] == "$webui_admin_settings_desactivate_bouton") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Display = '0' WHERE Options = 'BackgroundColorAnimation' ");
  }

  if ($_POST[HoverStep1] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep1"])."' WHERE Steps = 'HoverStep1'");
  }
  
  if ($_POST[EndStep1] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep1"])."' WHERE Steps = 'EndStep1'");
  }
  
  if ($_POST[HoverStep2] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep2"])."' WHERE Steps = 'HoverStep2'");
  }
  
  if ($_POST[EndStep2] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep2"])."' WHERE Steps = 'EndStep2'");
  }
  
  if ($_POST[HoverStep3] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep3"])."' WHERE Steps = 'HoverStep3'");
  }
  
  if ($_POST[EndStep3] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep3"])."' WHERE Steps = 'EndStep3'");
  }

  if ($_POST[HoverStep4] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep4"])."' WHERE Steps = 'HoverStep4'");
  }
  
  if ($_POST[EndStep4] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep4"])."' WHERE Steps = 'EndStep4'");
  }
  
  if ($_POST[HoverStep5] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep5"])."' WHERE Steps = 'HoverStep5'");
  }
  
  if ($_POST[EndStep5] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep5"])."' WHERE Steps = 'EndStep5'");
  }
  
  if ($_POST[HoverStep6] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep6"])."' WHERE Steps = 'HoverStep6'");
  }
  
  if ($_POST[EndStep6] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep6"])."' WHERE Steps = 'EndStep6'");
  }

  if ($_POST[HoverStep7] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep7"])."' WHERE Steps = 'HoverStep7'");
  }
  
  if ($_POST[EndStep7] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep7"])."' WHERE Steps = 'EndStep7'");
  }
  
  if ($_POST[HoverStep8] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep8"])."' WHERE Steps = 'HoverStep8'");
  }
  
  if ($_POST[EndStep8] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep8"])."' WHERE Steps = 'EndStep8'");
  }
  
  if ($_POST[HoverStep9] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep9"])."' WHERE Steps = 'HoverStep9'");
  }
  
  if ($_POST[EndStep9] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep9"])."' WHERE Steps = 'EndStep9'");
  }

  if ($_POST[HoverStep10] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorHoverStep10"])."' WHERE Steps = 'HoverStep10'");
  }
  
  if ($_POST[EndStep10] == "$webui_admin_options_modify") {
    $DbLink->query("UPDATE " . C_ADMINBGCOLORANIM_TBL . " SET Colors = '".cleanQuery($_POST["ColorEndStep10"])."' WHERE Steps = 'EndStep10'");
  }
  
  
  
  
  
  // For Color
  $DbLink->query("SELECT id, Options , Steps, Colors, Display FROM ".C_ADMINBGCOLORANIM_TBL." ");
  list($id, $Options, $Steps, $Colors, $displayBackgroundColorAnimation) = $DbLink->next_record();

?>

<div id="content">
  <div id="ContentHeaderLeft"><h5><?= SYSNAME ?></h5></div>
  <div id="ContentHeaderCenter"></div>
  <div id="ContentHeaderRight"><h5><? echo $webui_admin_options; ?></h5></div>
  <div id="adminsettings">
  <div id="info"><p><? echo $webui_admin_options_info; ?> $displayBackgroundColorAnimation </p></div>
  
  <table>
  
    <form id="form1" name="form1" method="post" action="index.php?page=adminmodules">





      <tr>
        <td class="odd">
          <? echo $webui_admin_options_BackgroundColorAnimation; ?>
        </td>
        
        <td class="odd">
          <? if ($displayLogoEffect == 0) { ?>
          <img src="images/icons/desactivate.png" 
               alt="<? echo $webui_admin_options_LogoEffect_desactive; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_desactive; ?>">

        <td class="odd">
          
          <? echo $webui_admin_options_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayLogoEffect" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_LogoEffect_active; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_active; ?>">

        <td class="odd">
          
          <? echo $webui_admin_options_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayLogoEffect" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
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
               alt="<? echo $webui_admin_options_LogoEffect_desactive; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_desactive; ?>">

        <td class="odd">
          
          <? echo $webui_admin_options_desactive; ?>
        </td>

        <td class="odd">
          <input type="submit" name="displayBackgroundColorAnimation" value="<? echo $webui_admin_settings_activate_bouton; ?>" />
        </td>

          <? } else { ?>
          <img src="images/icons/activate.png" 
               alt="<? echo $webui_admin_options_LogoEffect_active; ?>" 
               title="<? echo $webui_admin_options_LogoEffect_active; ?>">

        <td class="odd">
          
          <? echo $webui_admin_options_active; ?>
        </td>
        
        <td class="odd">
          <input type="submit" name="displayBackgroundColorAnimation" value="<? echo $webui_admin_settings_desactivate_bouton; ?>" />
        </td>          
          <? } ?>
        </td>
      </tr>




    <? if ($displayBackgroundColorAnimation) { ?>
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep1; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep1" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep1" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep1; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep1" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep1" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      
      
      
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep2; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep2" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep2" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep2; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep2" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep2" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      
      
      
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep3; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep3" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep3" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep3; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep3" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep3" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      



      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep4; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep4" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep4" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep4; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep4" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep4" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>






      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep5; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep5" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep5" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep5; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep5" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep5" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>      







      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep6; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep6" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep6" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep6; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep6" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep6" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      






      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep7; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep7" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep7" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep7; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep7" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep7" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      




      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep8; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep8" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep8" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep8; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep8" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep8" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      







      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep9; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep9" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep9" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep9; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep9" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep9" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      
      
      





      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_HoverStep10; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorHoverStep10" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="HoverStep10" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
        
      <tr>
        <td class="odd">
          <? echo $webui_admin_BackgroundColorAnimation_EndStep10; ?>
        </td>
        <td class="odd">
...
            <td class="odd">
              <input type="text" name="ColorEndStep10" value="<?= $Colors ?>" style="width:25%"  maxlength="7" />
            </td>
        
            <td class="odd">
              <input type="submit" name="EndStep10" value="<? echo $webui_admin_options_modify; ?>" />
            </td>
        </td>
      </tr>
      
      
      
      
                            
    <? } ?>
    </form>
    </table>
  </div>
</div>
<? } ?>
