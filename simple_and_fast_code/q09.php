<?php
define('NUM_MAN', 20);
define('NUM_WOMAN', 10);
define('NUM_LIMITS', [NUM_WOMAN, NUM_MAN]);
define('NUM_TOTAL', NUM_MAN + NUM_WOMAN);

echo findSequencePattern([], [NUM_MAN, NUM_WOMAN]) . "\n";

function findSequencePattern(array $logs, array $limits): int
{
    $num = count($logs);
    if (NUM_TOTAL <= $num) {
        return 1;
    }

    if ($limits[0] == $limits[1]) {
        return 0;
    }

    $w = array_sum($logs);
    $m = $num - $w;
    if ($num && !($num & 1) && $m == $w) {
        return 0;
    }

    $count = 0;
    foreach ([[0, 1], [1, 0]] as [$m, $w]) {
        $nextLimits = [$limits[0] - $m, $limits[1] - $w];
        if (0 > $nextLimits[0] || 0 > $nextLimits[1]) {
            continue;
        }

        $count += findSequencePattern($logs + [$num => $m], $nextLimits);
    }
    return $count;
}
