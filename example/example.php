<?php
namespace SfpExample\PHPStan\DontOperationInsideConstructor;

class Example
{
	public function __construct()
	{
		$fileInfo = new \SplFileInfo('test');
		$fileInfo->openFile('r');
	}

	public static function factory() : self
	{
	    return new self();
	}
}
