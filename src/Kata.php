<?php

declare(strict_types=1);

namespace Kata;

class Kata
{
    public function __construct(private readonly array $routes)
    {
    }

    public function run(array $goal): bool
    {
        if (1 === $this->routes[$goal[0]][$goal[1]]) {
            return false;
        }

        foreach ($this->routes as $x => $row) {
            foreach ($row as $y => $position) {
                if (1 === $this->routes[$x][$y]) {
                    continue;
                }

                if (false === $this->pathfinder([$x, $y], $goal)) {
                    return false;
                }
            }
        }

        return true;
    }

    private function pathfinder(array $origin, array $goal): bool
    {
        $visitedPositions = $this->routes;

        $positionsToVisit = [$origin];
        while (count($positionsToVisit) > 0) {
            $currentPosition = array_shift($positionsToVisit);

            $visitedPositions[$currentPosition[0]][$currentPosition[1]] = 1;

            if ($goal[0] === $currentPosition[0] && $goal[1] === $currentPosition[1]) {
                return true;
            }

            $coordinates = [[0, 1], [0, -1], [1, 0], [-1, 0]];

            foreach ($coordinates as $position) {
                $x = $currentPosition[0] + $position[0];
                $y = $currentPosition[1] + $position[1];

                if (isset($visitedPositions[$x][$y])
                    && $visitedPositions[$x][$y] === 0
                ) {
                    if ($goal[0] === $x && $goal[1] === $y) {
                        return true;
                    }
                    $positionsToVisit[] = [$x, $y];
                }
            }
        }
        return false;
    }
}
