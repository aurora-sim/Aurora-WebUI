Skidz Partz Aurora WebInterface Redux v0.29

Originally created by Rookiie84

# Install Guide

Please remember to backup your database regularly.

1. Unzip & Upload these files to your webserver.
2. Edit "./settings/config.php"
3. Make a backup of your database ;)
4. Import the .sql files inside "./www/sql_update/" into your MySql database (I placed mine in the aurora database)

Config.php (Change the basic settings, to match your own) 

```php
##################### System #########################
define("SYSNAME","This_usually_is_what_the_site_is_called");
define("SYSURL","http://your_webui_server_ip_or_dns/");
define("SYSMAIL","you@yourdomain.com");
define("WEBUI_SERVICE_URL","http://your_webui_server_ip_or_dns:8007/WEBUI");
define("WEBUI_TEXTURE_SERVICE","http://your_webui_server_ip_or_dns:8002");
define("WEBUI_MAP_SERVICE","http://your_webui_server_ip_or_dns:8012/MapService");
define("WEBUI_MAPAPI_SERVICE","http://your_webui_server_ip_or_dns:8012/MapAPI");
define("WEBUI_PASSWORD","Password");

// Default StartPoint for Map
$mapstartX = 1000;
$mapstartY = 1000;
```

DatabaseInfo.php (Change the basic settings, to match your own)

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

### Install WebUI via console
1. Start Aurora.Server.exe (if you want to run in Grid mode) or Aurora.exe (if you want to run in StandAlone mode)
2. Put into the console 'compile module gui' and browse to the AuroraWebUI directory in your Aurora-WebAPI download and open the build.am file.
3. Follow the instructions on-screen and it will compile and install your module and you are all done with setup.

### Install WebUI manually
1. copy the AuroraWebUI directory into your ~/Aurora-Sim/addon-modules/ directory
2. Run runprebuild.bat

## Configuration

### For grid mode (running Aurora.Server.exe)
Copy AuroraService/WebAPI.ini to your ~/Aurora-Sim/bin/AuroraServerConfiguration/Modules directory

### For standalone mode (just running Aurora.exe)
Copy AuroraService/WebAPI.ini to your ~/Aurora-Sim/bin/Configuration/Modules directory

# Admin Panel
The Admin Panel is located at:
http://yourdomain.com/admin

To add your user as an Admin Panel User:
Start Aurora (Aurora.Server in grid mode) and after it has started, type

webui add user

and fill in the information that is asked for.

The user will now be able to use the Admin Panel as given above

Enjoy Aurora WebUI

To remove a user from the Admin Panel:
Start Aurora (Aurora.Server in grid mode) and after it has started, type

webui remove user

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
save avatar archive <First> <Last> <Filename> <FolderNameToSaveInto> (--snapshot <UUID>) (--public)
```

example:

```
save avatar archive first last hippo.aa folder --snapshot 12345678-1234-1234-1234-123456789012 --public
```

NOTE: Only public ones will be listed on the website


# Trouble Shooting
* Don't forget to set up your php.ini mail

## Errors with viewing or logging users into WebUI (not admin users)
* Make sure that an Aurora.Addon.WebUI.dll is in the bin/ folder of the place that are you running Aurora (or Aurora.Server) from.

## Page editor will not load in Administrator Section.
* While testing on osgrid.org we resolved this issue by creating a .htaccess file in the root of your website with the following code

```
        RewriteEngine On  
        RewriteCond %{HTTP_HOST} ^www.yourdomain.com$  
        RewriteRule (.*)$ http://yourdomain.com/$1 [R=301,L]
```


## Says unknown error, or something when wrong right after I turned on opensim.. 

<skidz> oh.. one thing to note.. 
<skidz> opensim seems to have a bug.. when making calls to the handler.. the first one always fails after you start opensim
<skidz> It actually runs.. but.. the data is never returned to the php.. 
<skidz> but.. after that first.. seems to work fine.. 
<skidz> I have not tried to debug this yet
<skidz> I should add that in the install.. lol

## I get the following message trying to load opensimwi in my web browser:

```php
query("SELECT password FROM ".C_ADMIN_TBL." WHERE password='$_SESSION[ADMINUID]'");
list($admpass) = $DbLink->next_record();
if($admpass){
	$ADMINCHECK = $admpass;
}else{
	$ADMINCHECK = "454";
}
if($_POST[adminlogin]=="admincheck"){
	$pass = $_POST[password];
	$passcheck = md5(md5($pass) . ":" );
	$DbLink->query("SELECT username,password FROM ".C_ADMIN_TBL." WHERE username='$_POST[username]'");
	list($adminname,$adminpass) = $DbLink->next_record();
	if($adminpass == $passcheck){
		$_SESSION[ADMINUID] = $adminpass;
	}
}
if($_POST[check]==1){
	echo "";
}
```

###	Resolution
Your PHP is not configured to use short tags or asp style, to fix the problem edit your php.ini and locate the following lines:

```ini
short_open_tag = Off

; Allow ASP-style <% %> tags.
asp_tags = Off
```

Change to

```ini
short_open_tag = On

; Allow ASP-style <% %> tags.
asp_tags = On
```

After you save your php.ini restart apache and you should be ok now.


## I get the following message trying to load opensimwi in my web browser:

***Notice: Use of undefined constant ......***

###	Resolution
Your PHP is not configured to handle errors properly, to fix the problem edit your php.ini and locate the following lines:

```ini
error_reporting = E_ALL 
```

Change to

```ini
error_reporting = E_ALL & ~E_NOTICE
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

// Database Connection
$CONF_db_server      = "localhost";
$CONF_db_user        = "*********";
$CONF_db_pass        = "*********";
$CONF_db_database    = "*********";

// QuickMap URL's
$SYSURL = "http://SERVER_ADDRESS_IP_OR_DNS/webui/quickmap/";
$IMGURL = "http://SERVER_ADDRESS_IP_OR_DNS:8002/";

// QuickMap Coordinates
$CONF_center_coord_x = "1000";
$CONF_center_coord_y = "1000";

// QuickMap Template
$CONF_template   = "default";
$CONF_image_size = 230;

// QuickMap Options
$displayRoundedCorner = true;
$displayLogoEffect    = true;

# Support
Please report all errors and bugs to [#aurora-dev channel on irc.freenode.net](http://webchat.freenode.net/?channels=#aurora-dev)
