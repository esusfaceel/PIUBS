<?php

class Import
{
	public static function importFile($class)
	{
	 	$path = dirname(dirname(__FILE__)).'/'.$class;
		if (file_exists($path))
			include_once($path);
			
	}
	
	static public function getPathServerFile($file)
	{
		$path = dirname(dirname(__FILE__)).'/'.$file;
	
		if (file_exists($path))
			return $path;
	
		return null;
	}
	
	static public function template($class)
	{
		$path = 'template/'.$class.'.php';
		self::importFile($path);
	}
	
	static public function entidade($class)
	{
		$path = 'model/entidade/'.$class.'.php';
		self::importFile($path);
	}
	
	public static function view($page)
	{
		$path = '' . $page . '.php';
		self::importFile($path);
	}
	
	public static function viewHtml($page)
	{
	    $path = '' . $page . '.html';
	    self::importFile($path);
	}
	
	static public function controller($class)
	{
		$path = 'controller/'.$class.'.php';
		self::importFile($path);
	}
	
	static public function includes($class)
	{
		$path = 'includes/'.$class.'.php';
		self::importFile($path);
	}
	
	static public function dao($class)
	{
		$path = 'model/dao/'.$class.'.php';
		self::importFile($path);
	}
	
	static public function library($class)
	{
		$path = 'library/'.$class.'.php';
		self::importFile($path);
	}

	static public function config($class)
	{
		$path = 'config/'.$class.'.php';
		self::importFile($path);
	}
}
?>