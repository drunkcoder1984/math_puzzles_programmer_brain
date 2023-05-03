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

    /**
     * @param array<mixed, mixed> $ary
     * @param int $num
     * @param array<int, array<int, mixed>>
     * @return array<int, array<int, mixed>>
     */
    public static function permutation(array $ary, int $num, array $permutation = []): array
    {
        if (0 >= $num) {
            return [$permutation];
        }

        $result = [];
        $cnt = count($permutation);
        foreach ($ary as $k => $v) {
            $nextAry = $ary;
            unset($nextAry[$k]);
            $result = array_merge($result, self::permutation($nextAry, $num - 1, $permutation + [$cnt => $v]));
        }
        return $result;
    }

    /**
     * @param array<mixed, mixed> $ary1
     * @param array<mixed, mixed> $ary2
     * @return array<int, array<int, mixed>>
     */
    public static function product(array $ary1, array $ary2): array
    {
        $result = [];
        foreach ($ary1 as $v1) {
            foreach ($ary2 as $v2) {
                $result[] = [$v1, $v2];
            }
        }
        return $result;
    }

    /**
     * @param array<mixed, mixed> $ary
     * @return array<int, mixed>
     */
    public static function flatten(array $ary): array
    {
        $result = [];
        foreach ($ary as $v) {
            if (is_array($v)) {
                $result = array_merge($result, self::flatten($v));
            } else {
                $result[] = $v;
            }
        }
        return $result;
    }
}
