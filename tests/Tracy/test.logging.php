<?php

require_once '../../Nette/loader.php';

/*use Nette\Debug;*/

Debug::$time = 1201042800.1875;
Debug::$emailProbability = 1;
Debug::$mailer = 'testMailer';

$_SERVER = array_intersect_key($_SERVER, array('PHP_SELF' => 1, 'SCRIPT_NAME' => 1, 'SERVER_ADDR' => 1, 'SERVER_SOFTWARE' => 1, 'HTTP_HOST' => 1, 'DOCUMENT_ROOT' => 1));
$_SERVER['HTTP_HOST'] = 'nettephp.com';


function testMailer($message)
{
	echo "\nSending mail with message '$message'\n";

	echo "\nFiles:\n";
	global $errorLog;
	foreach (glob(dirname($errorLog) . '/*') as $file) {
		echo "$file:\n";
		echo "----------------\n";
		echo file_get_contents($file);
		echo "\n----------------\n\n";
	}
}



$errorLog = dirname(__FILE__) . '/log/php_error.log';

foreach (glob(dirname($errorLog) . '/*') as $file) unlink($file); // delete all files

Debug::enable(Debug::PRODUCTION, $errorLog, 'admin@example.com');



function first($arg1, $arg2)
{
	second(TRUE, FALSE);
}



function second($arg1, $arg2)
{
	third(array(1, 2, 3));
}


function third($arg1)
{
	//missing();
	trigger_error('Error generated by trigger_error', E_USER_ERROR);
}


first(10, 'any string');