<?php
$num = 11;

$checkFn = fn(string $str) => strrev($str) === $str;

while (true) {
    $decimal = sprintf('%d', $num);
    $octal = sprintf('%o', $num);
    $binary = sprintf('%b', $num);

    if ($checkFn($decimal)
        && $checkFn($octal)
        && $checkFn($binary)) {
        break;
    }

    $num += 2;
}

echo "10進数: " . $decimal . "\n";
echo "8進数: " . $octal . "\n";
echo "2進数: " . $binary . "\n";
