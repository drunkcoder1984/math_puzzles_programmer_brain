<?php
$clubs = [
    [11000, 40],
    [8000, 30],
    [400, 24],
    [800, 20],
    [900, 14],
    [1800, 16],
    [1000, 15],
    [7000, 40],
    [100, 10],
    [300, 12],
];

echo check($clubs, 150) . PHP_EOL;

/**
 * @param array<int, array<0: int, 1: int>> $clubs
 * @param int $maxNum
 * @param int $num
 * @param int $area
 * @return int
 */
function check(array $clubs, int $maxNum, int $num = 0, int $area = 0): int
{
    $maxArea = $area;
    foreach ($clubs as $k => $v) {
        $nNum = $num + $v[1];
        if ($nNum > $maxNum) {
            continue;
        }

        $nClubs = $clubs;
        unset($nClubs[$k]);
        $maxArea = max(check($nClubs, $maxNum, $nNum, $area + $v[0]), $maxArea);
    }

    return $maxArea;
}
