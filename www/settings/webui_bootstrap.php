<?php
$apps = new DirectoryIterator(WEBUI_INSTALL_PATH . 'app');
foreach($apps as $dir){
	if($dir->isDot() === false && $dir->isReadable() === true && file_exists($dir->getPathname() . DIRECTORY_SEPARATOR . '_webui-bootstrap.php')){
		require_once($dir->getPathname() . DIRECTORY_SEPARATOR . '_webui-bootstrap.php');
	}
}
?>