<?php
  class Reports{

  	function __construct(){
		  Model::exists('relacion/dataProduct');
		  Model::exists('tabla/firma');
          Model::exists('tabla/firma_electronica');
  	}

  	public static function includeLoad(){
		include REPORT."autoload.php";
	}

  	public static function autoload(){
		require (REPORT."autoload.php");
	}

  	public static function exists($reportname){
		$fullpath = self::getFullpath($reportname);
		$found    = false;
		$existe   = 'no existe';
		if(file_exists($fullpath)){
			require ($fullpath);
		}
	}

	public static function getFullpath($reportname){
		return REPORT."tipos/".$reportname.".php";
	}

  }
?>