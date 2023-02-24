<?php

declare(strict_types=1);

namespace Test;

use Generator;
use Kata\Kata;
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../vendor/autoload.php';

class KataTest extends TestCase
{
    /**
     * @dataProvider getMatrixWithUnexpectedReferences
     */
    public function testUnreachablePath(array $routes, array $goal): void
    {
        $kata = new Kata($routes);

        $this->assertFalse($kata->run($goal));
    }

    /**
     * @dataProvider getMatrixWithReachableReferences
     */
    public function test(array $routes, array $goal): void
    {
        $kata = new Kata($routes);

        $this->assertTrue($kata->run($goal));
    }


    public function getMatrixWithUnexpectedReferences(): Generator
    {
        yield 'A matrix with all 1s' => [
            [
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
            ],
            [1, 4],
        ];
        yield 'A matrix with a 1 in the reference' => [
            [
                [1, 1, 0, 0, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
            ],
            [1, 4],
        ];
        yield 'A matrix with an unreachable path' => [
            [
                [0, 1, 0, 0, 0, 0],
                [0, 1, 0, 0, 1, 0],
                [0, 1, 1, 1, 0, 1],
                [0, 0, 0, 0, 0, 1],
                [0, 1, 0, 1, 0, 1],
            ],
            [1, 4],
        ];
        yield 'unreachable path with different many walls' => [
            [
                [0, 1, 0, 1, 1, 0],
                [0, 1, 0, 1, 0, 0],
                [0, 1, 1, 1, 0, 1],
                [0, 0, 1, 0, 0, 1],
                [1, 0, 0, 0, 1, 1],
            ],
            [1, 4]
        ];
        yield 'Unreachable path with two 0s in the middle' => [
            [
                [0, 0, 0, 0, 0, 0],
                [0, 1, 1, 1, 1, 0],
                [0, 1, 0, 0, 1, 0],
                [0, 1, 1, 1, 1, 0],
                [0, 0, 0, 0, 0, 0],
            ],
            [0, 4]
        ];
        yield 'reachable path with all 0s' => [
            [
                [0, 1, 0, 0, 1, 0],
                [0, 1, 1, 1, 0, 0],
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
            ],
            [2, 4]
        ];
        yield 'reachable path with all 0s 1' => [
            [
                [0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 1, 0],
            ],
            [0, 0]
        ];
        yield 'A matrix with a jail in the reference' => [
            [
                [0, 0, 0, 0, 0, 0],
                [0, 1, 1, 1, 1, 0],
                [0, 1, 0, 0, 1, 0],
                [0, 1, 1, 1, 1, 0],
                [0, 0, 0, 0, 0, 0],
            ],
            [0, 0],
        ];
    }

    public function getMatrixWithReachableReferences(): Generator
    {
        yield 'reachable path with all 0s until given reference' => [
            [
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
                [1, 1, 1, 1, 1, 1],
            ],
            [0, 4]
        ];
        yield 'reachable path with all 0s' => [
            [
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0],
            ],
            [1, 4]
        ];
        yield 'reachable path with many walls' => [
            [
                [0, 1, 0, 0, 0, 0],
                [0, 1, 0, 0, 0, 0],
                [0, 1, 1, 1, 0, 1],
                [0, 0, 0, 1, 0, 1],
                [1, 1, 0, 0, 0, 1],
            ],
            [0, 5]
        ];
        yield 'reachable path with extra large matrix' => [
            [
                [0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
                [0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                [0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0],
                [0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            ],
            [2, 16]
        ];
    }
}
