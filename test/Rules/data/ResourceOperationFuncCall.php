<?php

declare(strict_types=1);

namespace SfpTest\PHPStan\DontOperationInsideConstructor\Rules\data;

use function fopen;

class ResourceOperationFuncCall
{
    public function __construct()
    {
        $fp = fopen('test', 'r');

        (function () {
        })();
    }
}
