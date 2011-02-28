<?
include("../../settings/config.php");
include("../../settings/json.php");
include("../../settings/mysql.php");
include("../../languages/translator.php");
include("../../templates/templates.php");

if ($_GET[name]) {
    $userName = $_GET['name'];

    $found = array();
    $found[0] = json_encode(array('Method' => 'GetProfile', 'WebPassword' => md5(WIREDUX_PASSWORD)
                , 'Name' => $_GET['name']));

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
} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="<?= SYSURL ?><? echo $template_css ?>" type="text/css" />
    <link rel="icon" href="<?= SYSURL ?><?=$favicon_image?>" />
    <title><?= SYSNAME ?>: <? echo $webui_users_profile; ?> <? echo $userName ?></title>
</head>

<body class="webui">

<div id="content">
  <h2><?= SYSNAME ?>: <? echo $webui_users_profile; ?> <? echo $userName ?></h2>
  
  <div id="useragentprofil">
	<!--  <div id="info"><p><? echo $webui_region_list_page_info ?></p></div> -->

  <hr>
      <table>
          <tr>
              <td>
                  <? echo $webui_resident_since ?>: <?= $date ?> (<?= $diff ?>)
              </td>
          </tr>
          <tr>
              <td>
                  <? echo $webui_account_info ?>: <?= $type ?>
              </td>
          </tr>         
          <tr>
              <td></td>
          </tr>
              <? if ($partner != '') { ?>
          <tr>
              <td>
                  <? echo $webui_partner; ?>: <? echo $partner ?>
              </td>
          </tr>
          <tr>
              <td></td>
          </tr>
              <? } ?>
          <tr>
              <td>
                  <h2><? echo $webui_about_me; ?></h2>
              </td>
          </tr>       
          <tr>
              <td>
                <?
                  if ($profileTXT != '') { echo $profileTXT; }
                  else { echo $webui_no_information_set; }
                ?>
              </td>
          </tr>
      </table>
      
      <div id="profil_picture">
          <?
            if($profileImage == "")
            {
                $profileLink = "info.jpg";
            }
            else
                $profileLink = WIREDUX_TEXTURE_SERVICE . '/index.php?method=GridTexture&uuid=' . $profileImage;
          ?>
          <img src="<? echo $profileLink ?>" alt="<? echo $userName ?>" title="<? echo $userName ?>" />
      </div>
  </div>
</div>
</body>
</html>
