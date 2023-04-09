<?php
define("MAX_MOVE_NUM", 12);
define("FLAG_UP", 1);
define("FLAG_RIGHT", 2);
define("FLAG_DOWN", 4);
define("FLAG_LEFT", 8);
define("FLAG_ALL", FLAG_UP | FLAG_RIGHT | FLAG_DOWN | FLAG_LEFT);

$maxMoveNum = 12;
$coordinates = [0 => [1 => FLAG_UP]];
$moveCoordinates = [[0, 1]];
$patternNum = 0;
$moveNum = 0;
$x = 0;
$y = 1;

while (true) {
    if (0 == $moveNum) {
        if (FLAG_ALL == $coordinates[$x][$y]) {
            break;
        }
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
            // ++$patternNum;
            unset($moveCoordinates[$moveNum]);
            unset($coordinates[$x][$y]);
            if ([] === $coordinates[$x]) {
                unset($coordinates[$x]);
            }
            --$moveNum;
            [$x, $y] = $moveCoordinates[$moveNum];
            if (0 > $moveNum) {
                echo "bbbbbbbbbbb";
                exit();
            }
            continue 2;
    }
    ++$moveNum;

    if ($moveNum < MAX_MOVE_NUM) {
        $moveCoordinates[$moveNum] = [$x, $y];
    } else {
        // var_dump($moveNum, $patternNum, $moveCoordinates, $coordinates);
        ++$patternNum;
        unset($moveCoordinates[$moveNum]);
        unset($coordinates[$x][$y]);
        if ([] === $coordinates[$x]) {
            unset($coordinates[$x]);
        }
        --$moveNum;
        if (0 > $moveNum) {
            echo "aaaaaaaaaa";
            exit();
        }
        [$x, $y] = $moveCoordinates[$moveNum];
        continue;
    }
}
echo $patternNum . "\n";
