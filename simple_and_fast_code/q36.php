<?php
foreach (check(50) as $k => $v) {
    echo $k . ": " . $v . PHP_EOL;
}

/**
 * @param int $num
 * @return array<int, int>
 */
function check(int $num): array
{
    $map = array_filter(range(1, $num), fn($v) => ($v & 1) && $v % 5 != 0 && 13 != $v);
    $result = [];
    for ($i = 1; [] !== $map; ++$i) {
        $n = sprintf("%b", $i) * 7;
        foreach ($map as $k => $v) {
            if (0 != $n % $v) {
                continue;
            }

            unset($map[$k]);
            if ($n != strrev($n) || false === strstr($n, 0)) {
                continue;
            }
            $result[$v] = $n;
        }
    }

    ksort($result);
    return $result;
}
