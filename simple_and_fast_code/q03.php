<?php
$cards = array_fill(0, 100, 0);
for ($i = 2; $i <= 100; ++$i) {
    $num = $i - 1;
    while (isset($cards[$num])) {
        ++$cards[$num];
        $num += $i;
    }
}

foreach ($cards as $k => $v) {
    if (1 == $v % 2) {
        continue;
    }

    echo ($k + 1) . "\n";
}
