<?php
define("MAX_MOVE_NUM", 12);
define("FLAG_UP", 1);
define("FLAG_RIGHT", 2);
define("FLAG_DOWN", 4);
define("FLAG_LEFT", 8);
define("FLAG_ALL", FLAG_UP | FLAG_RIGHT | FLAG_DOWN | FLAG_LEFT);

$flagToAxes = [
    FLAG_UP => [0, -1, FLAG_DOWN],
    FLAG_RIGHT => [1, 0, FLAG_LEFT],
    FLAG_DOWN => [0, 1, FLAG_UP],
    FLAG_LEFT => [-1, 0, FLAG_RIGHT],
];

$patternNum = 0;
$x = 0;
$y = 0;
$coordinates = [$x => [$y => 0]];
$moveCoordinates = [[$x, $y]];
$len = count($moveCoordinates);

while (true) {
    $isMove = false;
    foreach ($flagToAxes as $flag => [$mx, $my, $prevFlag]) {
        if ($coordinates[$x][$y] & $flag || isset($coordinates[$x + $mx][$y + $my])) {
            continue;
        }

        $coordinates[$x][$y] |= $flag;
        $x += $mx;
        $y += $my;
        $coordinates[$x][$y] = $prevFlag;
        $moveCoordinates[$len] = [$x, $y];
        ++$len;
        $isMove = true;

        break;
    }

    if ($len <= MAX_MOVE_NUM && $isMove) {
        continue;
    }

    --$len;
    unset($moveCoordinates[$len]);
    unset($coordinates[$x][$y]);
    [$x, $y] = $moveCoordinates[$len - 1];

    if ($isMove) {
        ++$patternNum;
    }

    if (1 == $len && FLAG_ALL == $coordinates[$x][$y]) {
        break;
    }
}
echo $patternNum . "\n";
