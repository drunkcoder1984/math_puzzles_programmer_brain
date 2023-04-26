<?php
echo check(10, 24) . "\n";

function check(int $coin, int $num): int
{
    if (0 >= $num || 0 >= $coin) {
        return 0 < $coin ? 1 : 0;
    }

    $count = 0;
    foreach ([1, -1] as $v) {
        $count += check($coin + $v, $num - 1);
    }

    return $count;
}
