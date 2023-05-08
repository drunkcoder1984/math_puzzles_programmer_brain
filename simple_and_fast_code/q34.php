<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");

define("_BOARD_LEN_", 9);
define("_BORDER_", -1);
define("_NONE_", 0);
define("_HISYA_", 1);
define("_KAKU_", 2);
define("_MOVE_", 9);
define("_PLAY_POSES_", ArrayUtil::product(range(1, _BOARD_LEN_), range(1, _BOARD_LEN_)));

echo check() . PHP_EOL;

/**
 * @return int
 */
function check(): int
{
    $board = array_fill(0, (_BOARD_LEN_ + 2) ** 2, _BORDER_);
    foreach (_PLAY_POSES_ as $pos) {
        $board[calcPosKey($pos)] = _NONE_;
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
    $board[calcPosKey($hPos)] = _HISYA_;
    $board[calcPosKey($kPos)] = _KAKU_;
    foreach ([
        [$hPos, [[1, 0], [-1, 0], [0, 1], [0, -1]]],
        [$kPos, [[1, 1], [-1, 1], [1, -1], [-1, -1]]],
    ] as [$pos, $moves]) {
        foreach ($moves as $move) {
            // 動ける位置の設定
            move($board, $pos, $move);
        }
    }

    // 動ける位置数を取得
    return array_count_values($board)[_MOVE_];
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
 * @return int
 */
function move(array &$board, array $pos, array $move)
{
    $pos = [$pos[0] + $move[0], $pos[1] + $move[1]];
    $k = calcPosKey($pos);
    if (!in_array($board[$k], [_NONE_, _MOVE_])) {
        return;
    }

    $board[$k] = _MOVE_;
    move($board, $pos, $move);
}
