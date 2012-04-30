<?php
if(!file_exists('../settings/config.php') || !file_exists('../settings/databaseinfo.php')){
	die('Configuration not present.');
}
require_once('../settings/config.php');
header('Location: ' . SYSURL . 'index.php?page=adminhome');
exit;
?>
