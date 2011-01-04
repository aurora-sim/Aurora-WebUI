<?php

include("settings/config.php");
include("settings/mysql.php");

$DbLink = new DB;

$method = $_SERVER["PATH_INFO"];

if ($method == "/SaveMessage/")
{
	$msg = $HTTP_RAW_POST_DATA;
	$start = strpos($msg, "?>");

	if ($start != -1)
	{
		$start+=2;
		$msg = substr($msg, $start);
		$parts = split("[<>]", $msg);
		$to_agent = $parts[12];
       
              $DbLink->query("insert into ".C_OFFLINE_IM_TBL." (uuid, message) values ('" .
                      mysql_escape_string($to_agent) . "', '" .
                      mysql_escape_string($msg) . "')");
       
              echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><boolean>true</boolean>";
          }
          else
          {
              echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><boolean>false</boolean>";
          }
          exit;
      }

      if ($method == "/RetrieveMessages/")
      {
          $parms = $HTTP_RAW_POST_DATA;
          $parts = split("[<>]", $parms);
          $agent_id = $parts[6];
       
          $DbLink->query("select message from ".C_OFFLINE_IM_TBL." where uuid='" .
                  mysql_escape_string($agent_id) . "'");

          echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><ArrayOfGridInstantMessage xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\">";
       
          while(list($message) = $DbLink->next_record())
          {
              echo $message;
          }
       
          echo "</ArrayOfGridInstantMessage>";
       
          $DbLink->query("delete from ".C_OFFLINE_IM_TBL." where uuid='" .
                  mysql_escape_string($agent_id) . "'");
          exit;
      }

?>