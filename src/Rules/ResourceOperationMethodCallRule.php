<?php

declare(strict_types=1);

namespace Sfp\PHPStan\DontOperationInsideConstructor\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use Sfp\ResourceOperations\ResourceOperations;

/**
 * @implements Rule<Node\Expr\MethodCall>
 */
final class ResourceOperationMethodCallRule implements Rule
{
	public function getNodeType(): string
	{
		return Node\Expr\MethodCall::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		if (! $node->name instanceof Node\Identifier) {
			// @codeCoverageIgnoreStart
			return []; // @codeCoverageIgnoreEnd
		}

		if ($scope->getFunctionName() !== '__construct') {
			return [];
		}

		$calledOnType = $scope->getType($node->var);

		$methodNames = [];
		foreach ($calledOnType->getObjectClassNames() as $objectClassName) {
			$methodNames [] = $objectClassName . '::' .strtolower($node->name->name);
		}

		$errors = [];
		foreach ($methodNames as $methodName) {
			if (in_array($methodName, ResourceOperations::getMethods(), true)) {
				$errors[] = RuleErrorBuilder::message(
					sprintf("Don't resource operation inside constructor. Method %s() is called.", $methodName)
				)->identifier('sfp-dont-operation.resourceOperationMethodCall')->build();
			}
		}

		return $errors;
	}
}
