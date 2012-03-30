<?php

function cleanQuery($string)
{
  $link = mysql_connect(C_DB_HOST, C_DB_USER, C_DB_PASS)
    OR die(mysql_error());
  if(get_magic_quotes_gpc())  // prevents duplicate backslashes
  {
    $string = stripslashes($string);
  }
  if (phpversion() >= '4.3.0')
  {
    $string = mysql_real_escape_string($string);
  }
  else
  {
    $string = mysql_escape_string($string);
  }
  return $string;
}


?>
