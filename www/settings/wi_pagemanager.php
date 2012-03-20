<?php
/*
 * Copyright (c) 2012 Contributors
 * See CONTRIBUTORS for a full list of copyright holders.
 *
 * See LICENSE for the full licensing terms of this file.
 *
*/

class WebUIPages extends Aurora\Addon\WORM{

	private $dirty = false;

	public function offsetSet($offset, $value){
		if(($value instanceof WebUIPage) === false){
			throw new InvalidArgumentException('Only instances of WebUIPage should be appended to instances of WebUIPages');
		}else if($offset !== $value->id()){
			throw new InvalidArgumentException('Offset does not match page ID');
		}else if(isset($this[$offset]) === true){
			throw new InvalidArgumentException('page already set');
		}
		$this->data[$offset] = $value;
		$this->dirty = true;
		$this->sort();
	}

	public static function f(){
		return new static();
	}

	public function query($parent, array $display){
		$results = array();

		foreach($this as $k=>$v){
			if($k === $parent && in_array($v->display(), $display) === true){
				$results[] = $v;
			}
			$results = array_merge($results, $v->query($parent, $display));
		}
		
		return $results;
	}

	public function sort(){
		if($this->dirty){
			uasort($this->data, function($a, $b){
				return $a->rank() < $b->rank() ? -1 : 1;
			});
			$this->dirty = false;
		}
		foreach($this as $v){
			$v->sort();
		}
	}
}

class WebUIPage extends WebUIPages{
	protected function __construct($id, $rank, $url, $target, $display){
		if(is_string($rank) === true && is_numeric($rank) === true){
			$rank = (float)$rank;
		}else if(is_integer($rank) === true){
			$rank = (float)$rank;
		}
		if(is_string($display) === true && ctype_digit($display) === true){
			$display = (integer)$display;
		}

		if(is_string($id) === false){
			throw new InvalidArgumentException('ID must be specified as string.');
		}else if(preg_match('/^[A-z][A-z0-9_]+$/', $id) != 1){
			throw new InvalidArgumentException('ID not valid.');
		}else if(is_float($rank) === false){
			throw new InvalidArgumentException('Rank must be specified as float.');
		}else if(is_integer($display) === false){
			throw new InvalidArgumentException('Display must be specified as integer.');
		}else if(is_string($url) === false){
			throw new InvalidArgumentException('URL must be specified as string.');
		}else if(is_string($target) === false){
			throw new InvalidArgumentException('Target must be specified as string.');
		}

		$this->id      = $id;
		$this->rank    = $rank;
		$this->url     = $url;
		$this->target  = $target;
		$this->display = $display;
	}

	public static function f($id, $rank, $url, $target, $display){
		return new static($id, $rank, $url, $target, $display);
	}

	protected $id;
	public function id(){
		return $this->id;
	}

	protected $rank;
	public function rank(){
		return $this->rank;
	}

	protected $url;
	public function url(){
		return $this->url;
	}

	protected $target;
	public function target(){
		return $this->target;
	}

	protected $display;
	public function display(){
		return $this->display;
	}
}

$wi_pagemanager = Globals::i()->wi_pagemanager = WebUIPages::f();
?>