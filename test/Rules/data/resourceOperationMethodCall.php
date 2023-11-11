<?php

declare(strict_types=1);

class Test
{
    public function __construct()
    {
        $fileInfo = new SplFileInfo('test');
        $fileInfo->openFile('r');
    }
}
