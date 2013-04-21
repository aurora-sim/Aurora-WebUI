<?php
include("../../settings/config.php");
include("../../settings/databaseinfo.php");
include("../../settings/json.php");
include("../../settings/mysql.php");
include("../../languages/translator.php");
include("../../templates/templates.php");

$DbLink = new DB;

if ($_GET[name]) {
    $userName = $_GET['name'];

    $found = array();
    $found[0] = json_encode(array('Method' => 'GetProfile', 'WebPassword' => md5(WEBUI_PASSWORD),
        'Name' => cleanQuery($_GET['name'])));

    $do_post_requested = do_post_request($found);
    $recieved = json_decode($do_post_requested);

    $profileTXT = $recieved->{'profile'}->{'AboutText'};
    $profileImage = $recieved->{'profile'}->{'Image'};
    $created = $recieved->{'account'}->{'Created'};
    $UUID = $recieved->{'account'}->{'PrincipalID'};
    $diff = $recieved->{'account'}->{'TimeSinceCreated'};
    $type = $recieved->{'account'}->{'AccountInfo'};
    $partner = $recieved->{'account'}->{'Partner'};
    $date = date("D d M Y - g:i A", $created);
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo SYSURL; ?><?php echo $template_css; ?>" type="text/css" />
    <link rel="icon" href="<?php echo SYSURL; ?><?php echo $favicon_image; ?>" />
    <title><?= SYSNAME ?>: <?php echo $webui_users_profile; ?> <?php echo $userName; ?></title>
    
<?php if($displayRoundedCorner)  { ?>
<script src="<?php echo SYSURL; ?>javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SYSURL; ?>javascripts/jquery/jquery.corner.js?v2.11"></script>
<script type="text/javascript">
	  $("#profil_picture").corner("15px");
		$('#container_popup, #content_popup').corner();
</script>
<?php } ?>

</head>

<body class="webui">
<div id="container_popup">
<div id="content_popup">
  <h2><?php echo SYSNAME; ?>: <?php echo $webui_users_profile; ?> <?php echo $userName; ?></h2>
  
  <div id="useragentprofil">
	<!--  <div id="info"><p><?php echo $webui_region_list_page_info; ?></p></div> -->

  <hr>
      <table>
          <tr>
              <td>
                  <?php echo $webui_resident_since; ?>: <?php echo $date; ?> <br /> <?php echo $webui_resident_age; ?>: (<?php echo $diff; ?>)
              </td>
          </tr>
          <tr>
              <td>
                  <?php echo $webui_account_info; ?>: <?php echo $type; ?>
              </td>
          </tr>         
          <tr>
              <td></td>
          </tr>
              <?php if ($partner != '') { ?>
          <tr>
              <td>
                  <?php echo $webui_partner; ?>: <?php echo $partner ?>
              </td>
          </tr>
          <tr>
              <td></td>
          </tr>
              <?php } ?>
          <tr>
              <td>
                  <h2><?php echo $webui_about_me; ?></h2>
              </td>
          </tr>       
          <tr>
              <td>
                <?php
                  if ($profileTXT != '') {echo $profileTXT;}
                  else {echo $webui_no_information_set;}
                ?>
              </td>
          </tr>
      </table>
      
      <div id="profil_picture">
          <?php
            if($profileImage == "")
            {
                $profileLink = "info.jpg";
            }
            else
                $profileLink = WEBUI_TEXTURE_SERVICE . '/index.php?method=GridTexture&uuid=' . $profileImage;
          ?>
          <img alt="<?php echo $profileImage; ?>" src="<?php echo $profileLink; ?>" title="<?php echo $userName; ?>" />
      </div>
  </div>
</div></div>
</body>
</html>
