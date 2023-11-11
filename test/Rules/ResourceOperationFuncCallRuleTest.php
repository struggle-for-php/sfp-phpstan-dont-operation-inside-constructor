<?php

declare(strict_types=1);

namespace SfpTest\PHPStan\DontOperationInsideConstructor\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Sfp\PHPStan\DontOperationInsideConstructor\Rules\ResourceOperationFuncCallRule;

/**
 * @extends RuleTestCase<ResourceOperationFuncCallRule>
 * @covers \Sfp\PHPStan\DontOperationInsideConstructor\Rules\ResourceOperationFuncCallRule
 */
class ResourceOperationFuncCallRuleTest extends RuleTestCase
{
    public function getRule(): Rule
    {
        return new ResourceOperationFuncCallRule();
    }

    public function testProcess(): void
    {
        $this->analyse([__DIR__ . '/data/ResourceOperationFuncCall.php'], [
            [
                "Don't resource operation inside constructor. function fopen() is called.",
                13,
            ],
        ]);
    }
}
