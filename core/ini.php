<?php
// Required in all pages
// 

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'IP ADDRESS',
		'database' => 'DATABASE',
		'user' => 'USERNAME',
		'password' => 'PASSWORD'
	)	
);

session_start();

require_once 'functions/general.php';

spl_autoload_register(function ($class) {
	require('classes/' . $class . '.php');
});