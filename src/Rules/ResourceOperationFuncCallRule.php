<?php

declare(strict_types=1);

namespace Sfp\PHPStan\DontOperationInsideConstructor\Rules;

use PhpParser\Node;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;
use Sfp\ResourceOperations\ResourceOperations;

use function in_array;
use function sprintf;

/**
 * @implements Rule<Node\Expr\FuncCall>
 */
final class ResourceOperationFuncCallRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    /**
     * @param Node\Expr\FuncCall $node
     * @return array|RuleError[]|string[]
     * @throws ShouldNotHappenException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($scope->getFunctionName() !== '__construct') {
            return [];
        }

        if (! $node->name instanceof Name) {
            return [];
        }

        $errors = [];
        if (in_array($node->name->toString(), ResourceOperations::getFunctions(), true)) {
            $errors[] = RuleErrorBuilder::message(
                sprintf("Don't resource operation inside constructor. function %s() is called.", $node->name->toString())
            )->identifier('sfp-dont-operation.resourceOperationFuncCall')->build();
        }

        return $errors;
    }
}
