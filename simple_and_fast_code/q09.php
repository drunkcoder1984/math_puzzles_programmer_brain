<?php
$man = 20;
$woman = 10;
$array = [];
for ($m = 0; $m <= $man; ++$m) {
    $array[$m] = array_fill(0, $woman + 1, 0);
}
$array[0][0] = 1;

for ($m = 0; $m <= $man; ++$m) {
    for ($w = 0; $w <= $woman; ++$w) {
        if ($m == $w || $man - $m == $woman - $w) {
            continue;
        }

        if ($m > 0) {
            $array[$m][$w] += $array[$m - 1][$w];
        }

        if ($w > 0) {
            $array[$m][$w] += $array[$m][$w - 1];
        }
    }
}

echo $array[$man - 1][$woman] . "\n";
