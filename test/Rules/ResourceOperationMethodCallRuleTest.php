<?php

namespace SfpTest\PHPStan\DontOperationInsideConstructor\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Sfp\PHPStan\DontOperationInsideConstructor\Rules\ResourceOperationMethodCallRule;

/**
 * @extends RuleTestCase<ResourceOperationMethodCallRule>
 */
class ResourceOperationMethodCallRuleTest extends RuleTestCase
{
	public function getRule(): Rule
	{
	    return new ResourceOperationMethodCallRule();
	}

	public function testProcess(): void
	{
		$this->analyse([__DIR__ . '/data/resourceOperationMethodCall.php'], [
			[
				"Don't resource operation inside constructor. Method SplFileInfo::openfile() is called.",
				8
			]
		]);
	}
}
