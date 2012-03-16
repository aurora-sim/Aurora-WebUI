<?php
/*
 * Copyright (c) 2012 Contributors
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/
class WebUISites extends Aurora\Addon\WORM{
	public function offsetSet($offset, $value){
		if(isset($this[$offset]) === true){
			throw new InvalidArgumentException('Offset already set, cannot overwrite');
		}else if(is_string($offset) === false){
			throw new InvalidArgumentException('Offset must be a string.');
		}else if(ctype_graph($offset) === false){
			throw new InvalidArgumentException('Offset must be visible characters only');
		}else if(is_string($value) === false){
			throw new InvalidArgumentException('Value must be a string.');
		}else if(preg_match('/^([A-z0-9_]+)\/([A-z0-9_]+\.php)$/', $value, $matches) != 1){
			throw new InvalidArgumentException('Value must be a PHP file');
		}else if(file_exists('./sites/' . $matches[1] . '/' . $matches[2]) === false){
			throw new InvalidArgumentException('Page does not exist');
		}
		$this->data[$offset] = $value;
	}

	public static function i(){
		static $instance;
		if(isset($instance) === false){
			$instance = new static();
		}
		return $instance;
	}
}

$wi_sitemanagement = Globals::i()->wi_sitemanagement = WebUISites::i();
?>