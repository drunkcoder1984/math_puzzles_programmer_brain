<?php

// 問題1
execute(7, 4);
// 問題2
execute(6, 5);

/**
 * @param int $width
 * @param int $height
 */
function execute(int $width, int $height)
{
    $tatami = [];
    $sh = $height + 1;
    $sw = $width + 1;

    /* 初期値をセット(外周を「-1」、内部に「0」をセット) */
    for ($i = 0; $i <= $sh; ++$i) {
        $tatami[$i] = array_fill(0, $sw, in_array($i, [0, $sh]) ? -1 : 0);
        $tatami[$i][0] = $tatami[$i][$sw] = -1;
    }

    echo 'width: ' . $width . PHP_EOL;
    echo 'height: ' . $height . PHP_EOL;
    setTatami($tatami, $width, $height);
}

/**
 * @param array<int, array<int, int>> $tatami
 * @param int $width
 * @param int $height
 * @param int $w
 * @param int $h
 * @param int $id
 */
function setTatami(
    array $tatami, int $width, int $height,
    int $w = 1, int $h = 1, int $id = 1
) {
    if ($h == $height + 1) {
        /* 最終行の場合は畳を表示 */
        display($tatami);
        return;
    } elseif ($w == $width + 1) {
        /* 右恥の場合は次の行に移動 */
        setTatami($tatami, $width, $height, 1, $h + 1, $id);
        return;
    } elseif (0 < $tatami[$h][$w]) {
        /* セット済みの場合は右に移動 */
        setTatami($tatami, $width, $height, $w + 1, $h, $id);
        return;
    }

    /* 左上と上が同じ場合、左上と左が同じ場合はセット可能 */
    if ($tatami[$h - 1][$w - 1] != $tatami[$h - 1][$w]
        && $tatami[$h - 1][$w - 1] != $tatami[$h][$w - 1]) {
        return;
    }

    ++$id;
    foreach ([[$w + 1, $h], [$w, $h + 1]] as [$cw, $ch]) {
        if (0 != $tatami[$ch][$cw]) {
            continue;
        }
        $tatami[$h][$w] = $tatami[$ch][$cw] = $id;
        setTatami($tatami, $width, $height, $w + 1, $h, $id);
        $tatami[$h][$w] = $tatami[$ch][$cw] = 0;
    }
}

/**
 * @param array<int, array<int, int>> $tatami
 */
function display(array $tatami)
{
    $display = '';
    foreach ($tatami as $h => $line) {
        foreach ($line as $w => $v) {
            if (-1 == $v) {
                continue;
            }

            /* 横に並んでいるときは「-」を表示 */
            if ($v == $tatami[$h][$w + 1] || $v == $tatami[$h][$w - 1]) {
                $display .= '-';
            }

            /* 縦に並んでいるときは「|」を表示 */
            if ($v == $tatami[$h + 1][$w] || $v == $tatami[$h - 1][$w]) {
                $display .= '|';
            }
        }
        $display .= '' == $display ? '' : PHP_EOL;
    }

    echo $display;
}
