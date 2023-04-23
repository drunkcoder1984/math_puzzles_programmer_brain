<?php
require_once(dirname(__FILE__) . "/../lib/array_util.php");
$magicSquare = [
    1, 14, 14, 4,
    11, 7, 6, 9,
    8, 10, 10, 5,
    13, 2, 3, 15
];

$checks = [];
$cnt = count($magicSquare);
for ($i = 1; $i <= $cnt; ++$i) {
    $comb = ArrayUtil::combination($magicSquare, $i);
    foreach ($comb as $ary) {
        $sum = array_sum($ary);
        $checks[$sum] = $checks[$sum] ?? 0;
        ++$checks[$sum];
    }
}
arsort($checks);
$keys = array_keys($checks);
echo array_shift($keys) . "\n";
