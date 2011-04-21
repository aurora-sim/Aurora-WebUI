<!--  Aurora-WebUI Auto Installer v0.1 -->
<?php
// récupération des variables
include('config.php');
include("../languages/translator.php");
// include("../settings/config.php");

// Pour fichier sql
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
                       <td class='left'><a href='#'>Visiter Aurora-WebUI<a/></td>
                     </tr>"; break;
} ?>
	
	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title>Aurora-WebUI Auto Installer v0.1</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="install.css" type="text/css" rel="stylesheet">
  <link href="style/stylexxx.css" rel="stylesheet" type="text/css" />
</head>

<body class="webui">

<div id="topcontainer">    
  <div id="translator"><?php include("../languages/translator_page.php"); ?></div>
</div>


<div id="content">
  
  <h1 class='title'>Aurora-WebUI Auto Installer</h1>

<div>

    <form action="index2.php?msg=15" method="post" name="dbdata">
      <table class='installer'>
        <tr>
          <td class='infos' colspan='2'>Aurora-Webui : Installation de la base de données</td>
        </tr>
        
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



    <?php    
      if (isset($_POST['submitBtn'])){
        $host = isset($_POST['C_DB_HOST']) ? $_POST['C_DB_HOST'] : '';
        $user = isset($_POST['C_DB_USER']) ? $_POST['C_DB_USER'] : '';
        $pass = isset($_POST['C_DB_PASS']) ? $_POST['C_DB_PASS'] : '';
        
        $con = mysql_connect($host,$user,$pass);
        if ($con !== false){
           // Load and explode the sql file
           $f = fopen($sqlFileToExecute,"r+");
           $sqlFile = fread($f,filesize($sqlFileToExecute));
           $sqlArray = explode(';',$sqlFile);
           
           // Process the sql file by statements
           foreach ($sqlArray as $stmt) {
              if (strlen($stmt)>3){
           	     $result = mysql_query($stmt);
           	     if (!$result){
           	        $sqlErrorCode = mysql_errno();
           	        $sqlErrorText = mysql_error();
           	        $sqlStmt      = $stmt;
           	        break;
           	     }
           	  }
           }
        }

      if ($sqlErrorCode == 0){
      
        // header("Location: finish.php?msg=15");
        echo "<tr><td class='right'><label >Info : </label>";
        echo "<td class='left'><div class='green'>L'installation c'est déroulée avec succès!</div></td></tr>";
        echo "<tr><td class='right'><label >Connection au site : </label>";
        echo "<td class='left'><a href='#'>Cliquer ici<a/></td></tr>";
      }
      
      else {
        echo "<tr><td>An error occured during installation!</td></tr>";
        echo "<tr><td>Error code: $sqlErrorCode</td></tr>";
        echo "<tr><td>Error text: $sqlErrorText</td></tr>";
        echo "<tr><td class='left'>Statement:<br/> $sqlStmt</td></tr>";
      }
    ?>

  <?php } ?>
        
        
        <tr>
          <td class='right'>
            <input id="submit" type="submit" name="back" value="Précédent" OnClick="history.go( -1 );return true;">
          </td>
            <td class='left'><input id="submit" type="submit" name="submitBtn" value="Installer">
          </td>
        </tr>
      </table>  
    </form>

  
  <div><a class='copyright' href="">Aurora-WebUI Auto Installer v0.1</a></div>
</div>
</body>
</html>
