<?php
$clubs = [
    [11000, 40], [8000, 30], [400, 24], [800, 20], [900, 14],
    [1800, 16], [1000, 15], [7000, 40], [100, 10], [300, 12],
];

echo check($clubs, 150) . PHP_EOL;

/**
 * @param array<int, array<0: int, 1: int>> $clubs
 * @param int $max
 * @return int
 */
function check(array $clubs, int $max): int
{
    $memo = [];
    foreach ($clubs as [$area, $num]) {
        foreach ($memo as $k => $v) {
            $nNum = $num + $k;
            if ($nNum > $max) {
                continue;
            }
            $nArea = $area + $v;
            $memo[$nNum] = isset($memo[$nNum]) ? max($memo[$nNum], $nArea) : $nArea;
        }
        $memo[$num] = isset($memo[$num]) ? max($memo[$num], $area) : $area;
    }

    return max($memo);
}
