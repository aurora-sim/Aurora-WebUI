<?php


namespace AuroraWebUI{

	use Globals;

	use Aurora\Addon;
	use Aurora\Addon\WebUI;


	function admin_setting($force=true){
		static $admin_setting = null;
		if(isset($admin_setting) === false || $force === true){
			$fields = array(
                'id',
                'lastnames',
                'adress',
                'region',
                'allowRegistrations',
                'verifyUsers',
                'ForceAge'
			);
			$admin_setting = array_combine($fields, array_pad(Globals::i()->DBLink->Query($fields, 'wi_adminsetting', null, null, 0, 1), count($fields), '0'));
		}
		return $admin_setting;
	}


	function admin_modules($force=true){
		static $admin_modules = null;
		if(isset($admin_modules) === false || $force === true){
			$fields = array(
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
			);
			$values = Globals::i()->DBLink->Query($fields, 'wi_adminmodules', null, null, 0, 1);
			foreach($values as $k=>$v){
				$values[$k] = ctype_digit($v) ? $v !== '0' : $v;
			}
			$admin_modules = WebUI\BoolWORM::f(array_combine($fields, $values));
		}
		return $admin_modules;
	}


	function startregion($force=true){
		static $startregion = null;
		if(isset($startregion) === false || $force === true){
			$startregion = current(Globals::i()->DBLink->Query(array( 'startregion' ), 'wi_adminsetting', null, null, 0, 1));
			$startregion = is_string($startregion) ? trim($startregion) : '';
			if($startregion === '' || Addon\is_uuid($startregion)){
				$startregion = '00000000-0000-0000-0000-000000000000';
			}
		}
		return $startregion;
	}
}
?>