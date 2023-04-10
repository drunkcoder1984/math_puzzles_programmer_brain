<?php
define("MAX_MOVE_NUM", 12);
define("FLAG_UP", 1);
define("FLAG_RIGHT", 2);
define("FLAG_DOWN", 4);
define("FLAG_LEFT", 8);
define("FLAG_ALL", FLAG_UP | FLAG_RIGHT | FLAG_DOWN | FLAG_LEFT);

$maxMoveNum = 12;
$coordinates = [0 => [0 => 0]];
$moveCoordinates = [[0, 0]];
$patternNum = 0;
$moveNum = 0;
$x = 0;
$y = 0;

while (true) {
    if (0 == $moveNum && FLAG_ALL == $coordinates[$x][$y]) {
        break;
    }

    switch (true) {
        case !($coordinates[$x][$y] & FLAG_DOWN) && !isset($coordinates[$x][$y + 1]):
            $coordinates[$x][$y] |= FLAG_DOWN;
            $coordinates[$x][$y + 1] = FLAG_UP;
            ++$y;
            break;

        case !($coordinates[$x][$y] & FLAG_RIGHT) && !isset($coordinates[$x + 1][$y]):
            $coordinates[$x][$y] |= FLAG_RIGHT;
            $coordinates[$x + 1][$y] = FLAG_LEFT;
            ++$x;
            break;

        case !($coordinates[$x][$y] & FLAG_LEFT) && !isset($coordinates[$x - 1][$y]):
            $coordinates[$x][$y] |= FLAG_LEFT;
            $coordinates[$x - 1][$y] = FLAG_RIGHT;
            --$x;
            break;

        case !($coordinates[$x][$y] & FLAG_UP) && !isset($coordinates[$x][$y - 1]):
            $coordinates[$x][$y] |= FLAG_UP;
            $coordinates[$x][$y - 1] = FLAG_DOWN;
            --$y;
            break;

        default:
            // ここは途中で進めなくなった場合
            unset($moveCoordinates[$moveNum]);
            unset($coordinates[$x][$y]);
            --$moveNum;
            [$x, $y] = $moveCoordinates[$moveNum];
            continue 2;
    }
    ++$moveNum;

    if ($moveNum < MAX_MOVE_NUM) {
        $moveCoordinates[$moveNum] = [$x, $y];

    } else {
        ++$patternNum;
        unset($moveCoordinates[$moveNum]);
        unset($coordinates[$x][$y]);
        --$moveNum;
        [$x, $y] = $moveCoordinates[$moveNum];
    }
}
echo $patternNum . "\n";
