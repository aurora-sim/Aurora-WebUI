<?php
include("../settings/config.php");
include("../languages/translator.php");
$sqlErrorText = '';
$sqlErrorCode = 0;
$sqlStmt      = '';
$sqlFileToExecute = 'sql/Aurora_WebUI.sql';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title><?= SYSNAME ?> Installer</title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />

</head>
<body class="webui">

<div id="topcontainer">    
  <div id="translator"><?php include("../languages/translator_page.php"); ?></div>
</div>

<div id="main">
  <div class="caption"><?= SYSNAME ?>: Installer</div>
    <div id="icon"></div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="dbdata">
      <table width="100%">
        <tr><td><? echo $webui_host_name; ?> :</td><td><input class="text" name="hostname" type="text" size="20" value="localhost" /></td></tr>
        <tr><td><? echo $webui_user_name; ?> :</td><td> <input class="text" name="username" type="text" size="20" value="" /></td></tr>
        <tr><td><? echo $webui_password; ?> :</td><td> <input class="text" name="password" type="password" size="20" value="" /></td></tr>
        <tr><td align="center" colspan="2"><br /><input class="text" type="submit" name="submitBtn" value="Install" /></td></tr>
      </table>  
    </form>
    <?php    
      if (isset($_POST['submitBtn'])){
        $host = isset($_POST['hostname']) ? $_POST['hostname'] : '';
        $user = isset($_POST['username']) ? $_POST['username'] : '';
        $pass = isset($_POST['password']) ? $_POST['password'] : '';
        
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
    ?>
    
    <div class="caption"><?= SYSNAME ?>: Result</div>
    <div id="icon2">&nbsp;</div>
    <div id="result">
    <table width="100%">
    <?php
      if ($sqlErrorCode == 0){
        echo "<tr><td>Installation was finished succesfully!</td></tr>";
      }
      
      else {
        echo "<tr><td>An error occured during installation!</td></tr>";
        echo "<tr><td>Error code: $sqlErrorCode</td></tr>";
        echo "<tr><td>Error text: $sqlErrorText</td></tr>";
        echo "<tr><td>Statement:<br/> $sqlStmt</td></tr>";
      }
    ?>
    
    </table>
  </div>
  <?php } ?>
  <div id="source"><?= SYSNAME ?> Installer v0.1</div>
</div>
</body>
