<?php
$i = 0;
$cnt = 0;
do {
    ++$i;
    $prev = $now ?? [1];
    $now = [];
    for ($j = 0; $j < $i; ++$j) {
        $now[$j] = ($prev[$j] ?? 0) ^ ($prev[$j - 1] ?? 0);
        if (!$now[$j]) {
            ++$cnt;
        }
    }
} while(2014 >= $cnt);
echo $i . "\n";
