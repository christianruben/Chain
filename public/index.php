<?php
define('ROOT', __DIR__.DIRECTORY_SEPARATOR.'../');
defined("DS") ?: define("DS", "/");
defined("APP") ?: define("APP", ROOT.DS.'App');
defined("LIBRARY") ?: define("LIBRARY", APP. 'Library');
defined("MAINURL") ?: define("MAINURL", str_replace($_SERVER["DOCUMENT_ROOT"], "", ROOT)); // 
require ROOT."System/Chain.php";