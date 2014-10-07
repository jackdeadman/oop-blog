<?php
/**
 * Abstracts getting data from the core/init.php file.
 */
class Config
{
	public static function get($path = null) {
		$config = $GLOBALS['config'];
		if ($path) {
			$path = explode('/', $path);

			foreach ($path as $nextPathName) {
				if (isset($config[$nextPathName])) {
					// Goes a layer deeper into config array
					$config = $config[$nextPathName];
				}else{
					// kill loop if one part of string is incorrect
					return false;
				}
			}
			return $config;
		}
		return false;
	}
}
?>