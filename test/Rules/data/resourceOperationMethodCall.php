<?php

class Test
{
	public function __construct()
	{
		$fileInfo = new SplFileInfo('test');
		$fileInfo->openFile('r');
	}
}
