<?php
/**
 * 素数関連
 */
class Prime
{
    /**
     * 1以外の素数を判定する
     * @param int $n
     * @return bool
     */
    static function isPrime(int $n): bool
    {
        for ($i = 2; $i < $n; ++$i) {
            if (0 == $n % $i) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param int $max
     * @param int $min
     * @return array<int, int>
     */
    static function listPrimes(int $max, $min = 2): array
    {
        $result = [];
        for ($i = $min; $i <= $max; ++$i) {
            if (self::isPrime($i)) {
                $result[] = $i;
            }
        }

        return $result;
    }
}

