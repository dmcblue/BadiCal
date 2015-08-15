<?php
	function BadiCal_autoload ($class){
		if(strpos($class, 'Badi') !== false){
			$path = realpath(dirname(__FILE__).'/'.$class.'.php');
			if(file_exists($path)){
				return include $path;
			}
		}
		return false;
	}
	
	spl_autoload_register('BadiCal_autoload');
?>