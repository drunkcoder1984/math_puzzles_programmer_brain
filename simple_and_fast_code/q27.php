<?php
// 向きの定数
define('_DIRECTION_UP_', 1);
define('_DIRECTION_DOWN_', 2);
define('_DIRECTION_LEFT_', 3);
define('_DIRECTION_RIGHT_', 4);

// 移動座標と向き
define('_MOVE_UP_', [0, 1, _DIRECTION_UP_]);
define('_MOVE_DOWN_', [0, -1, _DIRECTION_DOWN_]);
define('_MOVE_LEFT_', [-1, 0, _DIRECTION_LEFT_]);
define('_MOVE_RIGHT_', [1, 0, _DIRECTION_RIGHT_]);

$x = 6;
$y = 4;

$map = [];
for ($i = 0; $i <= $y; ++$i) {
    $map[$i] = array_fill(0, $x + 1, []);
}

echo check([0, 0], _DIRECTION_RIGHT_, $map, [$x, $y]) . PHP_EOL;

/**
 * @param array<0: int, 1: int> $point
 * @param int $direction
 * @param array<int, array<int, array<int, array<0: int, 1: int>>>> $map
 * @param array<0: int, 1: int> $goalPoint
 * @return int
 */
function check(array $point, int $direction, array $map, array $goalPoint): int
{
    if ($point == $goalPoint) {
        return 1;
    }

    // 向いてる方向に対応した移動方向と向き
    $moves = [
        _DIRECTION_UP_ => [_MOVE_UP_, _MOVE_LEFT_],
        _DIRECTION_DOWN_ => [_MOVE_DOWN_, _MOVE_RIGHT_],
        _DIRECTION_LEFT_ => [_MOVE_LEFT_, _MOVE_DOWN_],
        _DIRECTION_RIGHT_ => [_MOVE_RIGHT_, _MOVE_UP_],
    ];

    $cnt = 0;
    [$x, $y] = $point;
    foreach ($moves[$direction] as [$mx, $my, $nDirection]) {
        $nx = $x + $mx;
        $ny = $y + $my;
        $nPoint = [$nx, $ny];

        // 移動できるか判定
        if (!isset($map[$ny][$nx]) || in_array($point, $map[$ny][$nx]) || in_array($nPoint, $map[$y][$x])) {
            continue;
        }

        // 移動済みを記録
        $nMap = $map;
        $nMap[$ny][$nx][] = $point;
        $nMap[$y][$x][] = $nPoint;
        $cnt += check($nPoint, $nDirection, $nMap, $goalPoint);
    }

    return $cnt;
}
