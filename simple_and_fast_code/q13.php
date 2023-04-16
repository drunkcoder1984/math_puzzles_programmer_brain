<?php
$str = 'READ+WRITE+TALK=SKILL';
$char = [];
$notZero = [];

$isInitial = true;
foreach (str_split($str) as $v) {
    if (in_array($v, ['+', '-', '*', '/', '='])) {
        $isInitial = true;
        continue;
    }

    if (!isset($chars[$v]) || $isInitial) {
        $chars[$v] = $isInitial;
        $isInitial = false;
    }
}

$str = str_replace('=', '==', $str);
echo check($str, $chars, range(0, 9)) . "\n";

/**
 * @param string $str
 * @param array<string, bool> $charToZeroFlag
 * @param array<int, int> $nums
 * @return int
 */
function check(string $str, array $charToZeroFlag, array $nums): int
{
    if ([] === $charToZeroFlag) {
        eval('$result = ' . $str . ';');
        return $result ? 1 : 0;
    }

    $count = 0;
    $char = array_key_first($charToZeroFlag);
    $notZero = $charToZeroFlag[$char];
    unset($charToZeroFlag[$char]);
    foreach ($nums as $k => $v) {
        if ($notZero && 0 == $v) {
            continue;
        }
        $nextNums = array_diff($nums, [$v]);
        $count += check(str_replace($char, $v, $str), $charToZeroFlag, $nextNums);
    }

    return $count;
}
