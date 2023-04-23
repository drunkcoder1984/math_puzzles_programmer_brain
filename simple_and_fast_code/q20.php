<?php
$magicSquare = [
    1, 14, 14, 4,
    11, 7, 6, 9,
    8, 10, 10, 5,
    13, 2, 3, 15
];

$sumAll = array_sum($magicSquare);
$sums = array_fill(0, $sumAll + 1, 0);
$sums[0] = 1;
foreach ($magicSquare as $v) {
    for ($i = $sumAll - $v; 0 <= $i; --$i) {
        $sums[$i + $v] += $sums[$i];
    }
}

arsort($sums);
$keys = array_keys($sums);
echo array_shift($keys) . "\n";
