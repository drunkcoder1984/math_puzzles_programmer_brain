<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");

define("_BOARD_LEN_", 9);
define("_PLAY_POSES_", ArrayUtil::product(range(1, _BOARD_LEN_), range(1, _BOARD_LEN_)));

echo check() . PHP_EOL;

/**
 * @return int
 */
function check(): int
{
    $board = array_fill(0, (_BOARD_LEN_ + 2) ** 2, true);
    foreach (_PLAY_POSES_ as $pos) {
        $board[calcPosKey($pos)] = false;
    }

    $cnt = 0;
    // 飛車座標
    foreach (_PLAY_POSES_ as $hPos) {
        // 角座標
        foreach (_PLAY_POSES_ as $kPos) {
            $cnt += countMove($board, $kPos, $hPos);
        }
    }

    return $cnt;
}

/**
 * @param array<int, int> $board
 * @param array<0: int, 1: int> $kPos
 * @param array<0: int, 1: int> $hPos
 * @return int
 */
function countMove(array $board, array $kPos, array $hPos): int
{
    // 同じところには置けない
    if ($hPos == $kPos) {
        return 0;
    }

    // 飛車角の設定
    $board[calcPosKey($hPos)] = $board[calcPosKey($kPos)] = true;
    $check = [];
    foreach ([
        [$hPos, [[1, 0], [-1, 0], [0, 1], [0, -1]]],
        [$kPos, [[1, 1], [-1, 1], [1, -1], [-1, -1]]],
    ] as [$pos, $moves]) {
        foreach ($moves as $move) {
            // 動ける位置の設定
            move($board, $pos, $move, $check);
        }
    }

    // 動ける位置数を取得
    return count($check);
}

/**
 * @param array<0: int, 1: int> $pos
 * @return int
 */
function calcPosKey(array $pos): int
{
    return $pos[0] * (_BOARD_LEN_ + 2) + $pos[1];
}

/**
 * @param array<int, int> $board
 * @param array<0: int, 1: int> $pos
 * @param array<0: int, 1: int> $move
 * @param array<int, int> $check
 * @return int
 */
function move(array $board, array $pos, array $move, array &$check)
{
    $pos = [$pos[0] + $move[0], $pos[1] + $move[1]];
    $k = calcPosKey($pos);
    if ($board[$k]) {
        return;
    }

    $check[$k] = 1;
    move($board, $pos, $move, $check);
}
