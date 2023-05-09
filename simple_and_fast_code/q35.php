<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");

define("_LEN_", 6);
define("_MOVES_", ArrayUtil::product([[1, 0], [0, 1]], [[-1, 0], [0, -1]]));

echo check([0, 0], [_LEN_, _LEN_]) . PHP_EOL;

/**
 * @param array<0: int, 1: int> $mPos
 * @param array<0: int, 1: int> $wPos
 * @param int $meet
 * @return int
 */
function check(array $mPos, array $wPos, int $meet = 0): int
{
    if (_LEN_ < max($mPos) || 0 > min($wPos)) {
        return 0;
    } elseif ([_LEN_, _LEN_] === $mPos) {
        return 2 <= $meet ? 1 : 0;
    }

    foreach ($mPos as $k => $v) {
        if ($v == $wPos[$k]) {
            ++$meet;
        }
    }

    $cnt = 0;
    foreach (_MOVES_ as [$mMove, $wMove]) {
        $cnt += check(move($mPos, $mMove), move($wPos, $wMove), $meet);
    }

    return $cnt;
}

/**
 * @param array<0: int, 1: int> $pos
 * @param array<0: int, 1: int> $move
 * @return array<0: int, 1: int>
 */
function move(array $pos, array $move): array
{
    return [$pos[0] + $move[0], $pos[1] + $move[1]];
}
