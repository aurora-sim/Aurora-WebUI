<?php
/*
 * Copyright (c) 2007, 2008, 2011 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

#region Database

define("C_DB_TYPE","mysql");
// Your Hostname here:
define("C_DB_HOST","localhost");
// Your Databasename here:
define("C_DB_NAME","aurora");
// Your Username from Database here:
define("C_DB_USER","aurora");
// Your Database Password here:
define("C_DB_PASS","changeme");
// PDO DSN
define('C_PDO_DSN', 'mysql:dbname=' . C_DB_NAME . ';host=' . C_DB_HOST . ';user=' . C_DB_USER . ';password=' . C_DB_PASS);

#endregion

#region Migrators

foreach(glob(WEBUI_INSTALL_PATH . 'settings' . DIRECTORY_SEPARATOR . 'migrators' . DIRECTORY_SEPARATOR . '*Migrator_*.php') as $migrator){
	require_once($migrator);
}

Globals::i()->DBLink = new libAurora\DataManager\MySQLDataLoader(C_PDO_DSN, 'Wiredux', false, true);

#endregion

?>
