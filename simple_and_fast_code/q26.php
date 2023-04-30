<?php
define('_DUMMY_', 1);
define('_CAR_', 2);
define('_WALL_', 9);
$x = 10;
$y = 10;
$parking = [];
for ($i = 0; $i < $y + 2; ++$i) {
    // x,y軸の両端は壁
    $parking[$i] = array_fill(0, $x + 2, in_array($i, [0, $y + 1]) ?_WALL_ : _DUMMY_);
    $parking[$i][0] = _WALL_;
    $parking[$i][$x + 1] = _WALL_;
}

// ゴールの状態をハッシュ化
$goal = $parking;
$goal[1][1] = _CAR_;
$hash = ary2Hash([$goal, $x, $y]);

// スタートの設定
$parking[$y][$x] = _CAR_;
echo check([[$parking, $x, $y - 1], [$parking, $x - 1, $y]], $hash) . "\n";

/**
 * @param array<int, array<0: array<int, array<int, int>>, 1: int, 2: int>> $preavs
 * @param string $goalHash
 * @param int $depth
 * @param array<string, int> $log
 * @return int
 */
function check(array $pravs, string $goalHash, int $depth = 0, array &$log = []): int
{
    $target = [];
    foreach ($pravs as [$parking, $x, $y]) {
        // 各方向に移動
        foreach ([[-1, 0], [1, 0], [0, -1], [0, 1]] as [$mx, $my]) {
            $nx = $x + $mx;
            $ny = $y + $my;

            // 壁の確認
            if ($parking[$ny][$nx] == _WALL_) {
                continue;
            }

            $next = [$parking, $nx, $ny];
            [$next[0][$y][$x], $next[0][$ny][$nx]] = [$parking[$ny][$nx], $parking[$y][$x]];

            // 探索済み確認
            $hash = ary2Hash($next);
            if (isset($log[$hash])) {
                continue;
            }

            $target[] = $next;
            $log[$hash] = $depth + 1;
        }
    }

    if (!isset($log[$goalHash]) && [] !== $target) {
        check($target, $goalHash, $depth + 1, $log);
    }

    // ゴールの値がない場合は-1を返す
    return $log[$goalHash] ?? -1;
}

/**
 * @param array<mixed, mixed> $ary
 * @return string
 */
function ary2Hash(array $ary): string
{
    return hash('md5', json_encode($ary));
}
