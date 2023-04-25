<?php
$num = 16;
$half = $num / 2;
$pair = array_fill(0, $half + 1, 0);
$pair[0] = 1;
for ($i = 1; $i <= $half; ++$i) {
    $pair[$i] = 0;
    for ($j = 0; $j < $i; ++$j) {
        $pair[$i] += $pair[$j] * $pair[$i - $j - 1];
    }
}

echo $pair[$half] . "\n";
