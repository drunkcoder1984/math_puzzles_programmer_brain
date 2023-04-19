<?php
$max = 500;
$count = 0;
for ($c = 1; $c <= $max / 4; ++$c) {
    $squareArea = $c * $c;
    for ($a = 1; $a < $c - 1; ++$a) {
        $rectangleArea = $a * $a;
        for ($b = $a + 1; $b < $c; ++$b) {
            if ($rectangleArea + $b * $b == $squareArea && gmp_gcd($a, $b) == 1) {
                ++$count;
            }
        }
    }
}
echo $count . "\n";
