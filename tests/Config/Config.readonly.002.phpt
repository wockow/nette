<?php

/**
 * Test: Nette\Config\Config readonly and serialize.
 *
 * @author     David Grudl
 * @category   Nette
 * @package    Nette\Config
 * @subpackage UnitTests
 */

use Nette\Config\Config;



require __DIR__ . '/../initialize.php';



if (PHP_VERSION < '5.3') {
	T::skip('ArrayObject serialization is flawed in PHP 5.2.');
}



$config = Config::fromFile('config1.ini', 'development', NULL);
$config->freeze();

try {
	T::note("check read-only:");
	$dolly = unserialize(serialize($config));
	$dolly->database->adapter = 'works good';
} catch (Exception $e) {
	T::dump( $e );
}



__halt_compiler() ?>

------EXPECT------
check read-only:

Exception InvalidStateException: Cannot modify a frozen object '%ns%Config'.