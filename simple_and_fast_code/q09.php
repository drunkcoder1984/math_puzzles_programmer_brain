<?php
echo findSequencePattern([0, 0], [20, 10]) . "\n";

/**
 * @param array<int, int> $logs
 * @param array<int, int> $limits
 * @return int
 */
function findSequencePattern(array $logs, array $limits): int
{
    if (0 >= array_sum($limits)) {
        return 1;
    }

    if (array_sum($logs) && $logs[0] == $logs[1] || $limits[0] == $limits[1]) {
        return 0;
    }

    $count = 0;
    foreach ([0, 1] as $v) {
        $nextLimits = $limits;
        --$nextLimits[$v];
        if (0 > $nextLimits[$v]) {
            continue;
        }

        $nextLogs = $logs;
        ++$nextLogs[$v];
        $count += findSequencePattern($nextLogs, $nextLimits);
    }
    return $count;
}
