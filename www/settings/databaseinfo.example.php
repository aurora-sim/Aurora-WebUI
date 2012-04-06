<?php
/*
 * Copyright (c) 2007, 2008, 2011 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

##################### Database ########################
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
define('C_PDO_DSN', 'mysql:dbname=' . C_DB_NAME . ';host=' . C_DB_HOST);

Globals::i()->DBLink = new libAurora\DataManager\PDO(new PDO(C_PDO_DSN, C_DB_USER, C_DB_PASS));
?>
