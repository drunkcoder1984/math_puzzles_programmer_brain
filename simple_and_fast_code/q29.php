<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");
define('_PHI_', 1.6180339887);

$calcs = calc(10);
$min = PHP_FLOAT_MAX;
foreach ($calcs as $v) {
    if (abs($v - _PHI_) > abs($min - _PHI_)) {
        continue;
    }

    $min = $v;
}

printf('%.10f' . PHP_EOL, $min);

/**
 * @param int $n
 * @param array<int, mixed> $memo
 * @return array
 */
function calc(int $n, array &$memo = [1 => [1]]): array
{
    if (isset($memo[$n])) {
        return $memo[$n];
    }

    // 直列
    $result = array_map(fn($i) => $i + 1, calc($n - 1, $memo));

    // 並列
    for ($i = 2; $i <= $n; ++$i) {
        // 並列で区切る個数設定
        $cut = [];
        $comb = ArrayUtil::combination(range(1, $n - 1), $i - 1);
        foreach ($comb as $ary) {
            $pos = 0;
            $r = [];
            foreach ($ary as $v) {
                $r[] = $v - $pos;
                $pos = $v;
            }
            $r[] = $n - $pos;
            sort($r);
            $cut[json_encode($r)] = 1;  // 同じ配列をまとめる
        }

        // 区切った位置で再帰的に抵抗を設定
        $keys = array_map(
            fn($k) => array_map(fn($v) => calc($v), json_decode($k, true)),
            array_keys($cut)
        );

        // 抵抗を計算
        $products = array_map(fn($k) => product($k), $keys);
        foreach ($products as $k) {
            foreach ($k as $vv) {
                $result[] = parallel($vv);
            }
        }
    }

    $memo[$n] = $result;
    return $memo[$n];
}

/**
 * 配列の直積を計算
 * @param array<int, mixed> $ary
 * @return array
 */
function product(array $ary): array
{
    $result = array_shift($ary);
    foreach ($ary as $v) {
        $result = ArrayUtil::product($result, $v);
    }

    return array_map(fn($ary): array => ArrayUtil::flatten($ary), $result);
}

/**
 * 並列の場合の抵抗値を計算
 * @param array<int, float|int> $ary
 * @return float
 */
function parallel(array $ary): float
{
    $calc = array_sum(array_map(fn($v) => 1.0 / $v, $ary));
    return $calc == 0 ? 0.0 : 1.0 / $calc;
}
