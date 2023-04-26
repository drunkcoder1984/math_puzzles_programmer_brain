<?php
echo check(10, 24) . "\n";

/**
 * @param int $coin
 * @param int $num
 * @param array $memo
 * @return int
 */
function check(int $coin, int $num, array &$memo = []): int
{
    if (isset($memo[$coin][$num])) {
        return $memo[$coin][$num];
    }

    if (0 >= $num || 0 >= $coin) {
        $memo[$coin][$num] = 0 < $coin ? 1 : 0;
        return $memo[$coin][$num];
    }

    $count = 0;
    foreach ([1, -1] as $v) {
        $count += check($coin + $v, $num - 1, $memo);
    }

    $memo[$coin][$num] = $count;
    return $memo[$coin][$num];
}
