<?php
echo exchangePatterns(1000, [10, 50, 100, 500], 15) . "\n";

/**
 * @param int $money
 * @param int[] $coins
 * @param int $availableNum
 * @return int
 */
function exchangePatterns(int $money, array $coins, int $availableNum): int
{
    $coin = array_shift($coins);
    $patternNum = 0;

    while (0 < $availableNum && 0 < $money) {
        if ([] !== $coins) {
            $patternNum += exchangePatterns($money, $coins, $availableNum);
        }
        --$availableNum;
        $money -= $coin;
    }

    return (0 == $money ? ++$patternNum : $patternNum);
}
