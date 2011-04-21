<?
// fonction de vérification d'email
function checkmail($email) {
	if(!preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4})$`',$email)) Return false;
	Return true;
}
  $msg = 0;

  // Nom du site  vide
  if(empty($_POST['SYSNAME'])) $msg = 1;
  
  // Lien du site  vide
  if(empty($_POST['SYSURL'])) $msg = 2;

  // Adresse Email vide ou invalide
  if(empty($_POST['SYSMAIL']) || !checkmail($_POST['SYSMAIL'])) $msg = 3;

  // Service Url vide
  if(empty($_POST['WIREDUX_SERVICE_URL'])) $msg = 4;

  // Texture Service vide
  if(empty($_POST['WIREDUX_TEXTURE_SERVICE'])) $msg = 5;
  
  // Handler Pass vide
  if(empty($_POST['WIREDUX_PASSWORD'])) $msg = 6;

  // Type de base vide
  if(empty($_POST['C_DB_TYPE'])) $msg = 7;
  
  // Nom de l'hôte vide
  if(empty($_POST['C_DB_HOST'])) $msg = 8;
  
  // Nom de la base vide
  if(empty($_POST['C_DB_NAME'])) $msg = 9;

  // Utilisateur de la base vide
  if(empty($_POST['C_DB_USER'])) $msg = 10;

  // Pass de la base vide
  if(empty($_POST['C_DB_PASS'])) $msg = 11;
  
  // mots de passe admin différents
  if($_POST['f_pass1'] != $_POST['f_pass2']) $msg = 12;

  // $msg > 0 donc on revient à l'édition
  if($msg) {header("Location: index.php?msg=$msg");exit;}

  // if($msg = 8) {header("Location: config.php?msg=99");	exit;}
  
  // mot de passe non modifié en l'état
  if(empty($_POST['f_pass1'])) $new_pwd = $_POST['f_oldpwd'];
  // ou nouveau mot de passe crypté
  else $new_pwd = crypt($_POST['f_pass1'],$_POST['username']);
  // ouverture en écriture du fichier inc.config.php
  if(!$fichier = @fopen('config.php', 'w')) {
	// si erreur on revient vers l'édition
	header("Location: index.php?msg=14");
	exit;
}

// En-tête du fichier
fwrite($fichier, "<?php\n");
fwrite($fichier, "/*\n");
fwrite($fichier, " * Copyright (c) 2007, 2008 Contributors, http://opensimulator.org/\n");
fwrite($fichier, " * See CONTRIBUTORS for a full list of copyright holders.\n");
fwrite($fichier, " *\n");
fwrite($fichier, " * See LICENSE for the full licensing terms of this file.\n");
fwrite($fichier, " *\n");
fwrite($fichier, "*/\n");
fwrite($fichier, "\n");

fwrite($fichier, "##################### System #########################\n");
// écriture des variables du formulaire
foreach($_POST as $key=>$val) {
	if(strstr($key,"SYS")) fwrite($fichier, "define(\"$key\", \"$val\");\n");
	elseif(strstr($key,"WIREDUX")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}
fwrite($fichier, "\n");

fwrite($fichier, "################### Loginscreen ################\n");
fwrite($fichier, "// Should the pictures on the loginscreen be random or by time?\n");
fwrite($fichier, "\$picturesByTime = false;\n");
fwrite($fichier, "// Show the bar at the bottom that has the latest grid news?\n");
fwrite($fichier, "\$showNewsBar = true;\n");
fwrite($fichier, "// Show the panel that has a list of all regions in the grid?\n");
fwrite($fichier, "\$showRegionsPanel = true;\n");
fwrite($fichier, "// Show the panel that shows the grid status?\n");
fwrite($fichier, "\$showGridStatus = true;\n");
fwrite($fichier, "// Show the panel that shows grid alerts?\n");
fwrite($fichier, "\$showAlertPanel = true;\n");
fwrite($fichier, "// Show the panel that shows special reports?\n");
fwrite($fichier, "\$showSpecialReport = true;\n");
fwrite($fichier, "\n");

fwrite($fichier, "############ Delete Unconfirmed accounts ################\n");
fwrite($fichier, "// e.g. 24 for 24 hours  leave empty for no timed delete\n");
fwrite($fichier, "\$unconfirmed_deltime = \"24\";\n");
fwrite($fichier, "\n");

fwrite($fichier, "################### Help support area #####################\n");
fwrite($fichier, "\$support_emails_to = \"digitalconcepts@free.fr\";\n");
fwrite($fichier, "\$support_emails_subject = \"DigiGrids Support:\";\n");
fwrite($fichier, "\n");

fwrite($fichier, "################### GridMap Settings  #####################\n");
fwrite($fichier, "//Allowing Zoom on your Map\n");
fwrite($fichier, "\$ALLOW_ZOOM = TRUE;\n");
fwrite($fichier, "\n");

fwrite($fichier, "//Default StartPoint for Map\n");
fwrite($fichier, "\$mapstartX=1000;\n");
fwrite($fichier, "\$mapstartY=1000;\n");
fwrite($fichier, "\n");

fwrite($fichier, "//Direction where Info Image has to stay ex.: dr = down right ; dl =down left ; tr = top right ; tl = top left ; c = center\n");
fwrite($fichier, "\$display_marker = \"tl\";\n");
fwrite($fichier, "\n");

fwrite($fichier, "####################### Skin ##########################\n");
fwrite($fichier, "// Current templates are 'default' , 'white' and 'astra'\n");
fwrite($fichier, "\$template = 'default';\n");
fwrite($fichier, "\n");

fwrite($fichier, "####################### Languages ##########################\n");
fwrite($fichier, "\n");
fwrite($fichier, "\$languages = array(\"fr\" => \"French\" ,
                  \"en\" => \"English\" ,
                  \"de\" => \"German\" ,
                  \"es\" => \"Spanish\" ,
                  \"it\" => \"Italian\" ,
                  \"nl\" => \"Dutch\" ,
                  \"pt\" => \"Portuguese\" ,
                  \"fi\" => \"Finnish\" ,
                  \"gr\" => \"Greek\");\n");
fwrite($fichier, "\n");

fwrite($fichier, "##################### Database ########################\n");
foreach($_POST as $key=>$val) {
	// traitement des constantes (en majuscule) WEBUI
	if(strstr($key,"C_DB_TYPE")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}

fwrite($fichier, "//Your Hostname here:\n");

foreach($_POST as $key=>$val) {
	// traitement des constantes (en majuscule) WEBUI
	if(strstr($key,"C_DB_HOST")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}

fwrite($fichier, "//Your Databasename here:\n");

foreach($_POST as $key=>$val) {
	// traitement des constantes (en majuscule) WEBUI
	if(strstr($key,"C_DB_NAME")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}

fwrite($fichier, "//Your Username from Database here:\n");

foreach($_POST as $key=>$val) {
	// traitement des constantes (en majuscule) WEBUI
	if(strstr($key,"C_DB_USER")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}

fwrite($fichier, "//Your Database Password here:\n");

foreach($_POST as $key=>$val) {
	// traitement des constantes (en majuscule) WEBUI
	if(strstr($key,"C_DB_PASS")) fwrite($fichier, "define(\"$key\", \"$val\");\n");}
fwrite($fichier, "\n");

fwrite($fichier, "################ Database Tables #########################\n");
fwrite($fichier, "define(\"C_ADMIN_TBL\",\"wi_admin\");\n");
fwrite($fichier, "define(\"C_WIUSR_TBL\",\"wi_users\");\n");
fwrite($fichier, "define(\"C_WI_APPEARANCE_TBL\",\"wi_appearance\");\n");
fwrite($fichier, "define(\"C_USRBAN_TBL\",\"wi_banned\");\n");
fwrite($fichier, "define(\"C_CODES_TBL\",\"wi_codetable\");\n");
fwrite($fichier, "define(\"C_ADM_TBL\",\"wi_adminsetting\");\n");
fwrite($fichier, "define(\"C_COUNTRY_TBL\",\"wi_country\");\n");
fwrite($fichier, "define(\"C_NAMES_TBL\",\"wi_lastnames\");\n");
fwrite($fichier, "define(\"C_INFOWINDOW_TBL\",\"wi_startscreen_infowindow\");\n");
fwrite($fichier, "define(\"C_NEWS_TBL\",\"wi_startscreen_news\");\n");
fwrite($fichier, "define(\"C_PAGE_TBL\",\"wi_pagemanager\");\n");
fwrite($fichier, "define(\"C_SITES_TBL\",\"wi_sitemanagement\");\n");
fwrite($fichier, "// REGION MANAGER\n");
fwrite($fichier, "define(\"C_MAP_REGIONS_TBL\",\"wi_regions\");\n");
fwrite($fichier, "// STATISTICS\n");
fwrite($fichier, "define(\"C_STATS_REGIONS_TBL\",\"wi_statistics\");\n");
fwrite($fichier, "define(\"C_GALLERY_TBL\",\"wi_gallery\");\n");
fwrite($fichier, "\n");
fwrite($fichier, "\n");

fwrite($fichier, "//Aurora tables\n");
fwrite($fichier, "define(\"C_USERS_TBL\",\"useraccounts\");\n");
fwrite($fichier, "define(\"C_AUTH_TBL\",\"auth\");\n");
fwrite($fichier, "define(\"C_REGIONS_TBL\",\"gridregions\");\n");
fwrite($fichier, "define(\"C_APPEARANCE_TBL\",\"avatar\");\n");
fwrite($fichier, "define(\"C_USERINFO_TBL\",\"userinfo\");\n");
fwrite($fichier, "define(\"C_PROFILE_TBL\",\"profilegeneral\");\n");
fwrite($fichier, "\n");

fwrite($fichier, "//other\n");
fwrite($fichier, "define(\"C_USERS_RL_TBL\",\"useraccounts_rl\");\n");

// tag PHP
fwrite($fichier, "?>\n");
// fermeture du fichier
fclose($fichier);
// retour à l'édition
header("Location: index1.php?msg=15");
?>
