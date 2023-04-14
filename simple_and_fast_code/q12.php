<?php
$result = [];
$num = 2;
while (2 > count($result)) {
    $sqrt = sprintf('%.10f', bcsqrt($num, 20));
    $splitSqrts = explode('.', $sqrt);

    if (!isset($result[0]) && check($splitSqrts[0] . $splitSqrts[1])) {
        $result[0] = $num;
    }

    if (!isset($result[1]) && check($splitSqrts[1])) {
        $result[1] = $num;
    }
    ++$num;
}

echo $result[0] . "\n";
echo $result[1] . "\n";

function check(string $str): bool
{
    return count(array_unique(str_split(substr($str, 0, 10)))) >= 10;
}
