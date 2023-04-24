<?php
$i = 0;
$cnt = 0;
do {
    ++$i;
    $prev = $now ?? [true];
    $now = [];
    for ($j = 0; $j < $i; ++$j) {
        $now[$j] = (($prev[$j] ?? false) xor ($prev[$j - 1] ?? false));
        if (!$now[$j]) {
            ++$cnt;
        }
    }
} while(2014 >= $cnt);
echo $i . "\n";
