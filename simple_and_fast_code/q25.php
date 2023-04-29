<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");

echo check(6) . PHP_EOL;

/**
 * @param int $n
 * @return int
 */
function check(int $num): int
{
    $max = 0;
    $range = range(1, $num -1);
    $permutation = ArrayUtil::permutation($range, count($range));
    foreach ($permutation as $l) {
        foreach ($permutation as $r) {
            // 経路の設定
            $path = [];
            $left = 0;
            $right = $r[0];
            for ($i = 0; $i < $num - 1; ++$i) {
                $path[] = [$left, $right];
                $left = $l[$i];
                $path[] = [$left, $right];
                $right = $r[$i + 1] ?? 0;
            }
            $path[] = [$left, $right];
        }

        // 経路が黄砂しているか判定
        $cnt = 0;
        $loop = $num * 2;
        for ($i = 0; $i < $loop; ++$i) {
            for ($j = $i + 1; $j < $loop - 1; ++$j) {
                $cnt += ($path[$i][0] - $path[$j][0]) * ($path[$i][1] - $path[$j][1]) < 0 ? 1 : 0;
            }
        }

        $max = max($max, $cnt);
    }

    return $max;
}
