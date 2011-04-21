<!--  Aurora-WebUI Auto Installer v0.1 -->
<?php
// récupération des variables
include('inc.config.php');
// Pour fichier sql
include("../languages/translator.php");
$sqlErrorText = '';
$sqlErrorCode = 0;
$sqlStmt      = '';
$sqlFileToExecute = 'sql/Aurora_WebUI.sql';

// traitement d'une erreur éventuelle (via config-modif.php)
// ajouter autant de traitements que de variables requises
switch($_GET['msg']) {
  case 1: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Nom du site vide.</div></td>
                     </tr>"; break;

  case 2: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Lien du site vide.</div></td>
                     </tr>"; break;

  case 3: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Adresse Email vide ou invalide.</div></td>
                     </tr>"; break;
 
  case 4: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Service Url vide.</div></td>
                     </tr>"; break;

  case 5: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Texture Service vide.</div></td>
                     </tr>"; break;

  case 6: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Handler Pass vide.</div></td>
                     </tr>"; break;

  case 7: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Type de base vide.</div></td>
                     </tr>"; break;

  case 8: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Nom de l'hôte vide.</div></td>
                     </tr>"; break;

  case 9: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Nom de la base vide.</div></td>
                     </tr>"; break;

  case 10: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Utilisateur de la base vide.</div></td>
                     </tr>"; break;

  case 11: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Pass de la base vide.</div></td>
                     </tr>"; break;
                     
  case 12: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Mot de Pass différents.</div></td>
                     </tr>"; break;

  case 13: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Aucun nom d'utilisateur.</div></td>
                     </tr>"; break;

  case 14: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='red'>Problème d'écriture du fichier inc.config.php</div></td>
                     </tr>"; break;

  case 15: $errmsg = "<tr><td class='right'><label >Info : </label></td>
                       <td class='left'><div class='green'>Fichier inc.config.php modifié avec succès!</div></td>
                     </tr>
                     <tr>
                       <td class='right'><label >Connection au site : </label></td>
                       <td class='left'><a href='#'>Visiter Aurora-WebUI</td>
                     </tr>"; break;
} ?>
	
	
<?php
// Pour fichier sql
include("../languages/translator.php");
$sqlErrorText = '';
$sqlErrorCode = 0;
$sqlStmt      = '';
$sqlFileToExecute = 'sql/Aurora_WebUI.sql';
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Aurora-WebUI Auto Installer v0.1</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="install.css" type="text/css" rel="stylesheet">
</head>

<body class="webui">

<div id="topcontainer">    
  <div id="translator"><?php include("../languages/translator_page.php"); ?></div>
</div>


<div id="content">
  
  <h1 class='title'>Aurora-WebUI Auto Installer</h1>

  <form method="post" action="config-modif.php">
  <!-- ancien mot de passe (crypté) par défaut -->
  <input type="hidden" name="f_oldpwd" value="<?= $adminpwd?>">

  <table class='installer'>

  <tr><td class='infos' colspan='2'>Aurora-Webui :Création du fichier config.php</td></tr>
	
  <tr>
		<td class='right'><label for="sysname">Nom du site : </label></td>
		<td class='left'><input id="sysname" name="SYSNAME" value="<?= 'Aurora-WebUI'?>"></td>
	</tr>
	
	<tr>
		<td class='right'><label for="sysurl">Lien du site : </label></td>
		<td class='left'><input id="sysurl" name="SYSURL" value="<?= 'http://your.webui.com/'?>"></td>
	</tr>
	
	<tr>
		<td class='right'></td>
		<td class='left_exemple'>http://your.webui.com/ (avec / � la fin!)</td>
	</tr>
   
	<tr>
		<td class='right'><label for="sysmail">Adresse Email : </label></td>
		<td class='left'><input id="sysmail" name="SYSMAIL" value="<?= 'infos@aurora-sim.org'?>"></td>
	</tr>
  
	<tr>
		<td class='right'><label for="service">Service Url : </label></td>
		<td class='left'><input id="service" name="WIREDUX_SERVICE_URL" value="<?= 'http://your.webui.com:8007/WIREDUX'?>"></td>
	</tr>

	<tr>
		<td class='right'></td>
		<td class='left_exemple'>(http://your.webui.com:8007/WIREDUX)</td>
	</tr>	
	
	<tr>
		<td class='right'><label for="texture">Texture Service : </label></td>
		<td class='left'><input id="texture" name="WIREDUX_TEXTURE_SERVICE" value="<?= 'http://your.webui.com:8002'?>"></td>
	</tr>

	<tr>
		<td class='right'></td>
		<td class='left_exemple'>(Exemple : http://your.webui.com:8002)</td>
	</tr>

	<tr>
		<td class='right'><label for="handler">Handler Passworld : </label></td>
		<td class='left'><input id="handler" name="WIREDUX_PASSWORD" type="password" value="<?= 'Password'?>"></td>
	</tr>

	<tr>
		<td class='right'></td>
		<td class='left_exemple'>Important : Comme bin/AuroraServerConfiguration/Main.ini</td>
	</tr>

	<tr><td class='infos' colspan='2'>Aurora-Webui : Installation de la base de données</td></tr>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="dbdata">
	<tr>
		<td class='right'><label for="dbtype">Type de base de données : </label></td>
		<td class='left'><input id="dbtype" name="C_DB_TYPE" value="mysql"></td>
	</tr>
	
	<tr>
		<td class='right'><label for="dbhost">Hôte de la base de données: </label></td>
		<td class='left'><input id="dbhost" name="C_DB_HOST" value="localhost"></td>
	</tr>
	
	<tr>
		<td class='right'><label for="dbname">Nom de la base de données: </label></td>
		<td class='left'><input id="dbname" name="C_DB_NAME" value="orora"></td>
	</tr>
	
	<tr>
		<td class='right'><label for="dbuser">Utilisateur de la base de données : </label></td>
		<td class='left'><input id="dbuser" name="C_DB_USER" value="<?= test?>"></td>
	</tr>
	
	<tr>
		<td class='right'><label for="dbpass">Mot de passe de la base de données: </label></td>
		<td class='left'><input id="dbpass" name="C_DB_PASS" type="password" value="test"></td>
	</tr>
	
	<? if(isset($errmsg)) echo "$errmsg\n"; ?>

	<tr>
		<td class='center' colspan='2'><input id="submit" type="submit" name="submitBtn" value="Installer"></td>
	</tr>

  </table>
  </form>

<div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="dbdata">
      <table class='installer'>
        <tr>
          <td class='right'><? echo $webui_db_name; ?> :</td>
          <td class='left'><input class="text" name="C_DB_HOST" type="text" size="20" value="<?= C_DB_HOST ?>" /></td>
        </tr>
        
        <tr>
          <td class='right'><? echo $webui_db_username; ?>  :</td>
            <td class='left'><input class="text" name="C_DB_USER" type="text" size="20" value="<?= C_DB_USER?>" />
          </td>
        </tr>
        
        <tr>
          <td class='right'><? echo $webui_db_pass; ?> :</td>
            <td class='left'><input class="text" name="C_DB_PASS" type="password" size="20" value="<?= C_DB_PASS?>" />
          </td>
        </tr>
        
        <tr>
          <td class='center' colspan='2'>
            <input id="submit" type="submit" name="submitBtn" value="Installer" />
          </td>
        </tr>
      </table>  
    </form>
    

  
  
  
  
  <div><a class='copyright' href="">Aurora-WebUI Auto Installer v0.1</a></div>
</div>
</body>
</html>
