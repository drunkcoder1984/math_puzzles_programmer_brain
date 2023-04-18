<?php

echo check(4, 10) . "\n";

/**
 * @param int $movable
 * @param int $step
 * @param array<int, int> $moves
 * @return int
 */
function check(int $movable, int $step, array $moves = []): int
{
    if ([] === $moves) {
        $moves = [0, $step];
    }

    if ($moves[0] == $moves[1]) {
        return 1;
    } elseif ($moves[0] > $moves[1]) {
        return 0;
    }

    $count = 0;
    for ($i = 1; $i <= $movable; ++$i) {
        $up = $moves[0] + $i;
        for ($j = 1; $j <= $movable; ++$j) {
            $count += check($movable, $step, [$up, $moves[1] - $j]);
        }
    }
    return $count;
}
