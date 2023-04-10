<?php
define("MAX_MOVE_NUM", 12);
define("MOVE_AXES", [[0, 1], [0, -1], [1, 0], [-1, 0]]);

echo move([[0, 0]]) . "\n";

/**
 * @param array<int, array<string, int>> $logs
 * @return int
 */
function move(array $logs): int
{
    $len = count($logs);
    if ($len > MAX_MOVE_NUM) {
        return 1;
    }

    $count = 0;
    $coordinate = $logs[$len - 1];
    foreach (MOVE_AXES as $axes) {
        $nextCoordinate = [$coordinate[0] + $axes[0], $coordinate[1] + $axes[1]];
        if (in_array($nextCoordinate, $logs)) {
            continue;
        }
        $count += move($logs + [$len => $nextCoordinate]);
    }

    return $count;
}
