<?php
namespace SfpExample\PHPStan\DontOperationInsideConstructor;

use function fopen;

class Example
{
	public function __construct()
	{
		$fileInfo = new \SplFileInfo('test');
		$fileInfo->openFile('r');

		fopen('test', 'r');
	}

	public static function factory() : self
	{
	    return new self();
	}
}
