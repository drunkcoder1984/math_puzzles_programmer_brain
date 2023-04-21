<?php

$n = 1;
$roots = [1 => 1];
do {
    ++$n;
    $num = ($n << 1) - 1;
    $i = max($roots);
    while ($i ** 2 <= $num) {
        ++$i;
        $roots[$i ** 2] = $i;
    }

    $sets = [];
    for ($i = 1; $i < $n; ++$i) {
        for ($j = $i + 1; $j <= $n; ++$j) {
            if (!isset($roots[$i + $j])) {
                continue;
            }

            $sets[$i][$j] = $j;
            $sets[$j][$i] = $i;
        }
    }

} while(count($sets) != $n || !check($n, $sets));

echo $n . "\n";

/**
 * @param int $n
 * @param array<int, array<int, int>> $sets
 * @param array<int, int> $used
 * @return bool
 */
function check(int $n, array $sets, array $used = [1]): bool
{
    $cnt = count($used);
    $num =  $used[$cnt - 1];
    if ($n <= $cnt) {
        return in_array(1, $sets[$num]);
    }

    $flg = false;
    foreach ($sets[$num] as $v) {
        if (in_array($v, $used) || !check($n, $sets, $used + [$cnt => $v])) {
            continue;
        }

        $flg = true;
        break;
    }

    return $flg;
}
