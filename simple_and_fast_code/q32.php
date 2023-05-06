<?php

// 問題1
(new Question(7, 4))->execute();
// 問題2
(new Question(6, 5))->execute();

class Question
{
    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(private int $width, private int $height)
    {
    }

    /**
     * @param int $width
     * @param int $height
     */
    public function execute()
    {
        echo 'width: ' . $this->width . PHP_EOL;
        echo 'height: ' . $this->height . PHP_EOL;
        $this->setTatami($this->init());
    }

    /**
     * @return array<int, array<int, int>>
     */
    private function init(): array
    {
        $tatami = [];
        $h = $this->height + 1;
        $w = $this->width + 1;

        /* 初期値をセット(外周を「-1」、内部に「0」をセット) */
        for ($i = 0; $i <= $h; ++$i) {
            $tatami[$i] = array_fill(0, $w, in_array($i, [0, $h]) ? -1 : 0);
            $tatami[$i][0] = $tatami[$i][$w] = -1;
        }

        return $tatami;
    }

    /**
     * @param array<int, array<int, int>> $tatami
     * @param int $w
     * @param int $h
     * @param int $id
     */
    private function setTatami(array $tatami, int $w = 1, int $h = 1, int $id = 1)
    {
        if ($h == $this->height + 1) {
            /* 最終行の場合は畳を表示 */
            $this->display($tatami);
            return;
        } elseif ($w == $this->width + 1) {
            /* 右恥の場合は次の行に移動 */
            $this->setTatami($tatami, 1, $h + 1, $id);
            return;
        } elseif (0 < $tatami[$h][$w]) {
            /* セット済みの場合は右に移動 */
            $this->setTatami($tatami, $w + 1, $h, $id);
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
            $this->setTatami($tatami, $w + 1, $h, $id);
            $tatami[$h][$w] = $tatami[$ch][$cw] = 0;
        }
    }

    /**
     * @param array<int, array<int, int>> $tatami
     */
    private function display(array $tatami)
    {
        $display = '';
        for ($h = 1; $h <= $this->height; ++$h) {
            for ($w = 1; $w <= $this->width; ++$w) {
                $v = $tatami[$h][$w];
                /* 横に並んでいるときは「-」を表示 */
                if ($v == $tatami[$h][$w + 1] || $v == $tatami[$h][$w - 1]) {
                    $display .= '-';
                }

                /* 縦に並んでいるときは「|」を表示 */
                if ($v == $tatami[$h + 1][$w] || $v == $tatami[$h - 1][$w]) {
                    $display .= '|';
                }
            }
            $display .= PHP_EOL;
        }

        echo $display . PHP_EOL;
    }
}
