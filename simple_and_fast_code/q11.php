<?php
$prevNum = $num = 1;
$patternNum = 0;
do {
    if (144 < $num && 0 == $num % array_sum(str_split($num))) {
        echo $num . "\n";
        ++$patternNum;
    }

    $nextNum = $num + $prevNum;
    $prevNum = $num;
    $num = $nextNum;
} while(is_int($num) && 5 > $patternNum);
