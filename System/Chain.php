<?php

require "./App/Config/Settings.php";

defined("ROOT") ?: define("ROOT", (dirname(__DIR__)));
defined("DS") ?: define("DS", "/");
defined("APP") ?: define("APP", ROOT.DS.'App');
defined("LIBRARY") ?: define("LIBRARY", APP. 'Library');
defined("MAINURL") ?: define("MAINURL", str_replace($_SERVER["DOCUMENT_ROOT"], "", ROOT));

function auto_loader($class){
	$parts = explode("\\", $class);

	array_walk($parts, function($v){
		return ucfirst($v);
	});

	$path = ROOT . DS . join( $parts, DS ). '.php';
	if(file_exists($path))
		require( $path );
}

if ( ! function_exists('is_cli'))
{

	/**
	 * Is CLI?
	 *
	 * Test to see if a request was made from the command line.
	 *
	 * @return 	bool
	 */
	function is_cli()
	{
		return (PHP_SAPI === 'cli' OR defined('STDIN'));
	}
}


if ( ! function_exists('remove_invisible_characters'))
{
	/**
	 * Remove Invisible Characters
	 *
	 * This prevents sandwiching null characters
	 * between ascii characters, like Java\0script.
	 *
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/i';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/i';	// url encoded 16-31
			$non_displayables[] = '/%7f/i';	// url encoded 127
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}

spl_autoload_register('auto_loader');

$req = new System\Request($path);
$session = new System\Session($session);
$req->setSession($session);
$core = new System\Core($req);
$core->bootstrap($route, $autoload, $database);