<?php

include("config.php");

function do_post_request($found) {
    $params = array('http' => array(
            'method' => 'POST',
            'content' => implode(',', $found)
            ));
    if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
    }
    $ctx = stream_context_create($params);
    $timeout = 3;
    $old = ini_set('default_socket_timeout', $timeout);
    $fp = @fopen(WIREDUX_SERVICE_URL, 'rb', false, $ctx);
    ini_set('default_socket_timeout', $old);
    if ($fp) {
        stream_set_timeout($fp, $timeout);
        stream_set_blocking($fp, 3);
    } else{
        //throw new Exception("Problem with " . WIREDUX_SERVICE_URL . ", $php_errormsg");
        return false;
	}
    $response = @stream_get_contents($fp);
    if ($response === false) {
        //throw new Exception("Problem reading data from " . WIREDUX_SERVICE_URL . ", $php_errormsg");
    }
    return $response;
}

?>
