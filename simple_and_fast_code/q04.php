<?php
echo cutbar(20, 3, 1) . "\n";
echo cutbar(100, 5, 1) . "\n";

/**
 * @param int $len 棒の長さ
 * @param int $num 人数
 * @param int $cutedLen カット済みの長さ
 * @return int 切り分け回数
 */
function cutbar(int $len, int $num, int $cutedLen): int
{
    if ($cutedLen >= $len) {
        return 0;
    } elseif ($cutedLen < $num) {
        $nextCutedLen = $cutedLen * 2;
    } else {
        $nextCutedLen = $cutedLen + $num;
    }

    return 1 + cutbar($len, $num, $nextCutedLen);
}
