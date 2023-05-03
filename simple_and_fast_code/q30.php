<?php
$num = 20;
echo setTap($num) . PHP_EOL;

/**
 * @param int $n
 * @param array<int, int> $memo
 * @return int
 */
function setTap(int $n, array &$memo = [1 => 1]): int
{
    if (isset($memo[$n])) {
        return $memo[$n];
    }

    $cnt = 0;
    // 2口
    $l = $n / 2;
    for ($i = 1; $i <= $l; ++$i) {
        $cnt += calc($n, $i, 0, $memo);
    }

    // 3口
    $l1 = $n / 3;
    for ($i = 1; $i <= $l1; ++$i) {
        $l2 = ($n - $i) / 2;
        for ($j = $i; $j <= $l2; ++$j) {
            $cnt += calc($n, $i, $j, $memo);
        }
    }

    $memo[$n] = $cnt;
    return $cnt;
}

/**
 * @param int $n
 * @param int $i
 * @param int $j
 * @param array<int, int> $memo
 * @return int
 */
function calc(int $n, int $i, int $j, array &$memo): int
{
    $check = $n - ($i + $j);
    $iv = setTap($i, $memo);
    $cv = setTap($check, $memo);
    $jv = 0 == $j ? 1 : setTap($j, $memo);

    if ($check == $i && $i == $j) {
        return $iv * ($iv + 1) * ($iv + 2) / 6;
    } elseif ($check == $i) {
        return $iv * ($iv + 1) * $jv / 2;
    } elseif ($i == $j) {
        return $cv * $iv * ($iv + 1) / 2;
    } elseif ($check == $j) {
        return $jv * ($jv + 1) * $iv / 2;
    }

    return $cv * $jv * $iv;
}
