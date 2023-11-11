<?php

declare(strict_types=1);

namespace SfpTest\PHPStan\DontOperationInsideConstructor\Rules\data;

use SplFileInfo;

class ResourceOperationMethodCall
{
    public function __construct()
    {
        $fileInfo = new SplFileInfo('test');
        $fileInfo->openFile('r');
    }
}
