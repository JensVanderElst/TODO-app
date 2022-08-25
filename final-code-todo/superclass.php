<?php
	session_start();

	// https://www.generacodice.com/en/articolo/240579/how-do-i-use-php-namespaces-with-autoload
	spl_autoload_register(function($class) {
		require_once(__DIR__ . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . $class . ".class.php");
	});