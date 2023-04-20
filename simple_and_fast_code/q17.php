<?php
echo check(30) . "\n";

/**
 * @param int $max
 * @param array<int, int> $ary
 * @return int
 */
function check(int $max, array $ary = []): int
{
    $cnt = count($ary);
    if ($cnt >= $max) {
        return 1;
    }

    $num = 0;
    $checks = 0 == $cnt || 0 == $ary[$cnt - 1] ? [0, 1] : [0];
    foreach ($checks as $v) {
        $num += check($max, $ary + [$cnt => $v]);
    }

    return $num;
}
