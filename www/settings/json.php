<?php

include("settings/config.php");

function do_post_request($found)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => implode(',', $found)
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen(WIREDUX_SERVICE_URL, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with " . WIREDUX_SERVICE_URL . ", $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from " . WIREDUX_SERVICE_URL . ", $php_errormsg");
  }
  return $response;
}
?>
