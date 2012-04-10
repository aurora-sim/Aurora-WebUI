<?php
include("../../settings/config.php");
include("../../settings/databaseinfo.php");
include("../../languages/translator.php");
include("../../templates/templates.php");
use Aurora\Addon\WebUI\Configs;

if (isset($_GET['name'])){
	try{
		$profile = Configs::d()->GetProfile($_GET['name']);
	}catch(Aurora\Addon\UnexpectedValueException $e){
		require_once('../../sites/404.php');
		return;
	}

	$userName = $profile->Name();
    $profileTXT = $profile->AboutText();
    $profileImage = $profile->Image();
    $created = $profile->Created();
    $UUID = $profile->PrincipalID();
    $type = $profile->CustomType();
    $partner = $profile->PartnerUUID() !== '00000000-0000-0000-0000-000000000000' ? Configs::d()->GetProfile('', $profile->PartnerUUID())->Name() : '';
    $date = date("D d M Y - g:i A", $created);
	$profileLink = ($profileImage == '00000000-0000-0000-0000-000000000000') ? 'info.jpg' : Configs::d()->GridTexture($profileImage);

    $difftime = $_SERVER['REQUEST_TIME'] - $profile->Created();
	$diff = array();
	if($difftime >= 31449600){
		$diff['year'] = ($difftime - ($difftime % 31449600)) / 31449600;
		$difftime %= 31449600;
	}
	if($difftime >= 604800){
		$diff['week'] = ($difftime - ($difftime % 604800)) / 604800;
		$difftime %= 604800;
	}
	if($difftime >= 86400){
		$diff['day'] = (int)ceil(($difftime - ($difftime % 86400)) / 86400);
	}
	$difftime = array();
	foreach($diff as $k=>$v){
		$difftime[] = $v . ' ' . $k . ($v > 1 ? 's' : '');
	}
	$diff = implode(', ', $difftime);
} 


$webuicid                        = Configs::d()->WebUIClientImplementationData();
$adminmodules                    = $webuicid['adminmodules'];
$id                              = $adminmodules['id'];
$displayTopPanelSlider           = $adminmodules['displayTopPanelSlider'];
$displayTemplateSelector         = $adminmodules['displayTemplateSelector'];
$displayStyleSwitcher            = $adminmodules['displayStyleSwitcher'];
$displayStyleSizer               = $adminmodules['displayStyleSizer'];
$displayFontSizer                = $adminmodules['displayFontSizer'];
$displayLanguageSelector         = $adminmodules['displayLanguageSelector'];
$displayScrollingText            = $adminmodules['displayScrollingText'];
$displayWelcomeMessage           = $adminmodules['displayWelcomeMessage'];
$displayLogo                     = $adminmodules['displayLogo'];
$displayLogoEffect               = $adminmodules['displayLogoEffect'];
$displaySlideShow                = $adminmodules['displaySlideShow'];
$displayMegaMenu                 = $adminmodules['displayMegaMenu'];
$displayDate                     = $adminmodules['displayDate'];
$displayTime                     = $adminmodules['displayTime'];
$displayRoundedCorner            = $adminmodules['displayRoundedCorner'];
$displayBackgroundColorAnimation = $adminmodules['displayBackgroundColorAnimation'];
$displayPageLoadTime             = $adminmodules['displayPageLoadTime'];
$displayW3c                      = $adminmodules['displayW3c'];
$displayRss                      = $adminmodules['displayRss'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../../<?php echo $template_css ?>" type="text/css" />
    <link rel="icon" href="../../<?php echo $favicon_image; ?>" />
    <title><?php echo SYSNAME, ': ', $webui_users_profile, ' ', $userName ?></title>
    
<?php if($displayRoundedCorner)  { ?>
<script src="../../javascripts/jquery/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../javascripts/jquery/jquery.corner.js?v2.11"></script>
<script type="text/javascript">
$("#profil_picture").corner("15px");
$('#container_popup, #content_popup').corner();
</script>
<?php } ?>
</head>
<body class="webui">
<div id="container_popup">
	<div id="content_popup">
		<h2><?php echo SYSNAME, ': ', $webui_users_profile, ' ', $userName ?></h2>
		<div id="useragentprofil">
			<hr/>
			<table>
				<tr>
					<td><?php echo $webui_resident_since ?>: <?php echo $date ?> <br /> <?php echo $webui_resident_age ?>: (<?php echo $diff ?>)</td>
				</tr>
				<tr>
					<td><?php echo $webui_account_info ?>: <?php echo $type ?></td>
				</tr>
<?php if ($partner != '') { ?>
				<tr>
					<td>
					<?php echo $webui_partner; ?>: <?php echo $partner ?>
					</td>
				</tr>
<?php } ?>
				<tr>
					<td><h2><?php echo $webui_about_me; ?></h2></td>
				</tr>
				<tr>
					<td><?php echo trim($profileTXT) !== '' ? trim($profileTXT) : $webui_no_information_set; ?></td>
				</tr>
			</table>
			<div id="profil_picture">
				<img alt="<?php echo $profileImage ?>" src="<?php echo $profileLink ?>" title="<?php echo $userName ?>" />
			</div>
		</div>
	</div>
</div>
</body>
</html>
