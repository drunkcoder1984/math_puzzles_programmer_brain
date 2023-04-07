<?php
$result = 0;
for ($i = 2; $i <= 10000; $i += 2) {
    if (collatzConjecture($i)) {
        ++$result;
    }
}

echo $result . "\n";

/**
 * @param int $initValue
 * @return bool
 */
function collatzConjecture(int $initValue): bool
{
    $value = $initValue * 3 + 1;
    while ($value != $initValue && $value != 1) {
        $value = $value & 1 ? $value * 3 + 1 : $value >> 1;
    }

    return $value == $initValue;
}
