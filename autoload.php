<?php
namespace PHPMaker2019\demo2019;

// Relative path
if (!isset($RELATIVE_PATH)) {
	$RELATIVE_PATH = "";
	$ROOT_RELATIVE_PATH = "."; // Relative path of app root
}
include_once $RELATIVE_PATH . "ewcfg15.php";

// Include ADOdb
if (USE_ADODB) {
	include_once $RELATIVE_PATH . "adodb5/adodb.inc.php";
} else {
	include_once $RELATIVE_PATH . "classes/MySqlConnection.php";
}

// Composer autoloader
if (file_exists($RELATIVE_PATH . "vendor/autoload.php"))
	require $RELATIVE_PATH . "vendor/autoload.php";
else
	die("Composer generated autoload.php does not exist. Make sure you have run \"composer update\" at the destionation folder on your development computer and uploaded the \"vendor\" subfolder.");

// Autoload classes
spl_autoload_register(function($class) {
	global $RELATIVE_PATH;
	$file = "";
	$classpath = "classes/";
	$prefix = PROJECT_NAMESPACE;
	$len = strlen($prefix);
	if (strncmp($class, $prefix, $len) === 0) { // Project namespace
		$file = substr($class, $len) . ".php";
	} else { // Not project namespace, e.g. "UploadHandler", "PasswordHash"
		$file = $class . ".php"; // Assume file name same as class name
	}
	$file = $classpath . $file;
	if ($file <> "" && file_exists($RELATIVE_PATH . $file))
		include_once $RELATIVE_PATH . $file;
});
include_once $RELATIVE_PATH . "phpfn15.php";
include_once $RELATIVE_PATH . "userfn15.php";
?>
