<?php
$num = 11;
while (true) {
    $decimal = sprintf('%d', $num);
    $octal = sprintf('%o', $num);
    $binary = sprintf('%b', $num);

    if (checkReverseString($decimal)
        && checkReverseString($octal)
        && checkReverseString($binary)) {
        break;
    }

    $num += 2;
}

echo "10進数: " . $decimal . "\n";
echo "8進数: " . $octal . "\n";
echo "2進数: " . $binary . "\n";

function checkReverseString(string $str): bool
{
    $revStr = strrev($str);
    return $revStr === $str;
}
