<?

/*
 * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

if($_SESSION[page]=='')
{
include("sites/home.php");
}
if($_SESSION[page]=='home')
{
include("sites/home.php");
}
if($_SESSION[page]=='updatedb')
{
include("sites/updatedb.php");
}
if($_SESSION[page]=='createacc')
{
include("sites/createacc.php");
}
if($_SESSION[page]=='changepw')
{
include("sites/changepw.php");
}
if($_SESSION[page]=='edit')
{
include("sites/edit.php");
}
if($_SESSION[page]=='manage')
{
include("sites/manage.php");
}

if($_SESSION[page]=='settings')
{
include("sites/settings.php");
}

if($_SESSION[page]=='logout')
{
include("sites/logout.php");
}

if($_SESSION[page]=='regions')
{
include("sites/list_regions.php");
}

if($_SESSION[page]=='assetlog')
{
include("sites/log_asset.php");
}

if($_SESSION[page]=='userlog')
{
include("sites/log_user.php");
}

if($_SESSION[page]=='gridlog')
{
include("sites/log_grid.php");
}
if($_SESSION[page]=='loginscreen')
{
include("sites/loginscreenmanager.php");
}


//PAGEMANAGER 
if($_SESSION[page]=='pagemanager')
{
include("sites/pagemanager/pagemanager.php");
}
if($_SESSION[page]=='pageedit')
{
include("sites/pagemanager/pageeditor.php");
}

//NEWSEDITOR
elseif ($_SESSION[page]=="news_add"){
include("sites/news/news_add.php");
}

elseif ($_SESSION[page]=="news_edit"){
include("sites/news/news_edit.php");
}


?>