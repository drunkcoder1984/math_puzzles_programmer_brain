<?php
require_once(dirname(__FILE__) . "/../lib/prime.php");
$i = 4;
do {
    ++$i;
    $primes = Prime::listPrimes($i);
    $composites = array_diff(range(2, $i), $primes);
    $sets = [];
    foreach ($composites as $composite) {
        $tmp = Prime::listPrimes($composite);
        foreach ($tmp as $a) {
            if (0 != $composite % $a) {
                continue;
            }

            for ($b = 1; $b < $i; ++$b) {
                $c = $a * $b;
                if (!in_array($c, $composites) || $c == $composite) {
                    continue;
                }
                $sets[$composite][$c] = $c;
            }
        }
    }

} while(!check($sets, 6));

echo $i . "\n";

/**
 * @param array<int, array<int, int>> $sets
 * @param int $max
 * @param int $num
 * @param int $cnt
 * @param array<int, int> $used
 * @return bool
 */
function check(array $sets, int $max, int $num = 0, $cnt = 0, array $used = []): bool
{
    if ($cnt >= $max + 1) {
        return count($sets) == count($used);
    }

    $cheks = 0 == $cnt ? array_keys($sets) : $sets[$num];
    foreach ($cheks as $v) {
        if (in_array($v, $used)) {
            continue;
        }

        $nextUserd = $num == 0 ? [$v] : array_unique(array_merge($used, $cheks));
        if (!check($sets, $max, $v, $cnt + 1, $nextUserd)) {
            continue;
        }
        return true;
    }

    return false;
}
