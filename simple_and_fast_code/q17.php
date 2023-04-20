<?php
$b = 1;
$g = 0;
for ($i = 0; $i < 30; ++$i) {
    [$b, $g] = [$b + $g, $b];
}

echo ($b + $g) . "\n";
