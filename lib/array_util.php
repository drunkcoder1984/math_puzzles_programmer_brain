<?php
/**
 * 配列操作
 */
class ArrayUtil
{
    /**
     * @param array<mixed, mixed> $ary
     * @param int $num
     * @param array<int, mixed> $comb
     * @return array<int, array<int, mixed>>
     */
    public static function combination(array $ary, int $num, array $comb = []): array
    {
        if (0 >= $num) {
            return [$comb];
        }

        $result = [];
        $loop = count($ary) - $num + 1;
        $cnt = count($comb);
        for ($i = 0; $i < $loop; ++$i) {
            $v = array_shift($ary);
            $result = array_merge($result, self::combination($ary, $num - 1, $comb + [$cnt => $v]));
        }

        return $result;
    }
}
