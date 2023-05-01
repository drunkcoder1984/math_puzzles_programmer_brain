<?php
// 進行方向 key + 1が左方向になるように配置
define('_DIR_', [[0, 1], [-1, 0], [0, -1], [1, 0]]);

$w = 6;
$h = 4;

$bottom = array_fill(0, $w, 0);
$left = array_fill(0, $h, 0);

echo check(0, 0, 3, $left, $bottom, [$w, $h]) . PHP_EOL;

/**
 * @param int $x
 * @param int $y
 * @param int $dir
 * @param array<int, int> $left
 * @param array<int, int> $bottom
 * @param array<0: int, 1: int> $goal
 * @return int
 */
function check(int $x, int $y, int $dir, array $left, array $bottom, array $goal): int
{
    $nx = $x + _DIR_[$dir][0];
    $ny = $y + _DIR_[$dir][1];
    if ([$nx, $ny] == $goal) {
        return 1;
    }

    // 進行不能判定用変数
    if (in_array($dir, [0, 2])) {
        // 上下へ進行
        [$point, $nPoint, $path, $max] = [$y, $ny, 1 << $x, $goal[1]];
        $line = &$left;
    } else {
        // 左右へ進行
        [$point, $nPoint, $path, $max] = [$x, $nx, 1 << $y, $goal[0]];
        $line = &$bottom;
    }

    $pos = min($point, $nPoint);
    if (0 > $pos || $nPoint > $max  // 行き止まり
        || 0 < ($line[$pos] & $path)) { // 一度通った
        return 0;
    }

    $line[$pos] |= $path;
    $cnt = 0;
    foreach ([$dir, ($dir + 1) % count(_DIR_)] as $nDir) {
        $cnt += check($nx, $ny, $nDir, $left, $bottom, $goal);
    }

    return $cnt;
}
