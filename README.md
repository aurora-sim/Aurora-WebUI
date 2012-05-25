# Install Guide

Please remember to backup your database regularly.

1. Unzip & Upload these files to your webserver.
2. Copy **./settings/config.example.php** to **./settings/config.php**
2. Copy **./settings/DatabaseInfo.example.php** to **./settings/DatabaseInfo.php**
3. Make a backup of your database ;)

## Config.php (basic must-configure settings)

```php
##################### System #########################
define("SYSNAME","This_usually_is_what_the_site_is_called");
define("SYSURL","http://your_aurora_server_ip_or_dns_address");
define("SYSMAIL","***");
define("WIREDUX_SERVICE_URL","http://your_aurora_server_ip_or_dns:8007/WEBUI");
define("WIREDUX_TEXTURE_SERVICE","http://your_aurora_server_ip_or_dns:8002");
define("WIREDUX_PASSWORD","***");

// Default StartPoint for Map
$mapstartX=1000;
$mapstartY=1000;
```

## DatabaseInfo.php (basic must-configure settings)

```php
##################### Database ########################
define("C_DB_TYPE","mysql");
// Your Hostname here:
define("C_DB_HOST","localhost");
// Your Databasename here:
define("C_DB_NAME","aurora");
// Your Username from Database here:
define("C_DB_USER","root");
// Your Database Password here:
define("C_DB_PASS","***");
```


### MySQL Version
If you are using MySQL 5.5 or greater, you will need to specify the version number

```php
Globals::i()->DBLink = new libAurora\DataManager\MySQLDataLoader(C_PDO_DSN, 'Wiredux', false, true, '5.5');
```


## php.ini

Enable short tags and ASP-style tags for PHP scripts.
```ini
short_open_tag = On

; Allow ASP-style <% %> tags.
asp_tags = On
```

Disable error notices to supress messages regarding the use of undefined constants.
```ini
error_reporting = E_ALL & ~E_NOTICE
```


## Aurora-Sim Addon

This release uses the v2.x release candidates of [Aurora-WebAPI](https://github.com/aurora-sim/Aurora-WebAPI)

### Install WebUI via console
1. Start Aurora.Server.exe (if you want to run in Grid mode) or Aurora.exe (if you want to run in StandAlone mode)
2. Put into the console 'compile module gui' and browse to the WebUI directory in your Aurora-WebAPI download and open the build.am file.
3. Follow the instructions on-screen and it will compile and install your module and you are all done with setup.

### Install WebUI manually
1. copy the WebUI directory into your ~/Aurora-Sim/addon-modules/ directory
2. Run runprebuild.bat

## Configuration

### For grid mode (running Aurora.Server.exe)
Copy WebUI/WebUI.ini to your ~/Aurora-Sim/bin/ directory/AuroraServerConfiguration/Modules directory

### For standalone mode (just running Aurora.exe)
Copy WebUI/WebUI.ini to your ~/Aurora-Sim/bin/ directory/Configuration/Modules directory

### Upgrading from older version of WebUI
* The *WireduxHandler* property is renamed **WebUIHandler**
* The *WireduxHandler* value is renamed **WebUIHandler**
* The *WireduxHandlerPort* property is renamed **WebUIHandlerPort**
* The *WireduxHandlerPassword* property is renamed **WebUIHandlerPassword**
* The *WireduxTextureServerPort* property is renamed **WebUIHandlerTextureServerPort**

# Admin Panel
The Admin Panel is located at:
http://yourdomain.com/admin

To promote your user as an Admin Panel User:
Start Aurora (Aurora.Server in grid mode) and after it has started, type

webui promote user

and fill in the information that is asked for.

The user will now be able to use the Admin Panel as given above

Enjoy Aurora WebUI

To demote a user from the Admin Panel:
Start Aurora (Aurora.Server in grid mode) and after it has started, type

webui demote user

and fill in the information that is asked for.

The user will now not be able to use the Admin Panel


# Choose avatar
To choose a avatar on registration you have to make some avatar archives

NOTE: I have only tested this with database archives and not file archives. 
To save a archive in the database you must give it a name ending with ".database"

Note: When displaying textures from the texture server they will be resized to 128x128 and at the bottom will be writen the grid nickname

1. Dress a avatar up like you want it to look
2. Take a picture of it and upload this to the grid
3. in the console of the grid server issue this command

```
save avatar archive <First> <Last> <Filename> <FolderNameToSaveInto> [<SnapshotUUID>] [<Public>]
```

example:

```
save avatar archive Skidz Tweak EvilOverlord.database / 00000-0000-0000-0000-00000 1
```

NOTE: Only pulic ones will be listed on the website


# Trouble Shooting
* Don't forget to set up your php.ini mail

## Errors with viewing or logging users into WebUI (not admin users)
* Make sure that an Aurora.Addon.WebUI.dll is in the bin/ folder of the place that are you running Aurora (or Aurora.Server) from. You can get this from https://github.com/aurora-sim/Aurora-WebUI/downloads if you didn't compile Aurora and Aurora-WebUI.

## Page editor will not load in Administrator Section.
* While testing on osgrid.org we resolved this issue by creating a .htaccess file in the root of your website with the following code

```
        RewriteEngine On  
        RewriteCond %{HTTP_HOST} ^www.yourdomain.com$  
        RewriteRule (.*)$ http://yourdomain.com/$1 [R=301,L]
```

# Matto Destiny & djphil Quickmap

Originally created by (c) Metropolis Metaversum [ http://hypergrid.org ]

## User Guide
Light Green Tiles = Root Region (Occupied)
Dark Green Tiles = Mainland (Occupied)
Blue Tiles = Free Space

## QUICKMAP Install Guide

Quickmap configuration is found in Aurora-WebUI/quickmap/includes/config.php. 
You may want to call Aurora-WebUI somthing different just remember this must reflect in the configuration below.

```php
// General items
// For Statics Images Folder
define("SYSURL","http://your_aurora_server_ip_or_dns_address/Aurora-WebUI/quickmap/"); 

//Your Grid-Domain
$CONF_sim_domain =     "http://your_aurora_server_ip_or_dns_address/";
//Installation path
$CONF_install_path =   "Aurora-WebUI/quickmap/";

// style-sheet items
//Link to StyleSheet
$CONF_style_sheet =    "templates/default/style.css";
$CONF_style_sheet_webui =    "templates/default/style_webui.css";

// Your Grid-Logo
// Link to your Grid-Logo
$CONF_logo =           "http://your_aurora_server_ip_or_dns_address/Aurora-WebUI/quickmap/templates/default/images/aurora-webui-logo.png"; 

// mysql database items
$CONF_db_server =      "mysql";   // Your Database-Server 
$CONF_db_user =        "root";        // Database-User
$CONF_db_database =    "aurora";  // Name of Database
$CONF_db_pass =        "***";      // Password of User

// The Coordinates of the Grid-Center
$CONF_center_coord_x   = "1000";      // the Center-X-Coordinate same as Aurora-WebUI $mapstart
$CONF_center_coord_y   = "1000";      // the Center-Y-Koordinate same as Aurora-WebUI $mapstart
```

# Support
Please report all errors and bugs to [#aurora-dev channel on irc.freenode.net](http://webchat.freenode.net/?channels=#aurora-dev)
