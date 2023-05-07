<?php

$cnt = 0;
foreach (getKarutaList() as $list) {
    $cnt += check($list);
}
echo $cnt . PHP_EOL;

/**
 * @param array<int, string> $list
 * @param int $len
 * @return int
 */
function check(array $list, int $len = 1): int
{
    $str = mb_substr($list[0], 0, $len);
    // [調査対象, 調査対象から外れたもの]
    $nextList = [[], []];
    foreach ($list as $v) {
        $k = mb_substr($v, 0, $len) == $str ? 0 : 1;
        $nextList[$k][] = $v;
    }

    $cnt = 0;
    foreach ($nextList as $k => $v) {
        switch (count($v)) {
            // 対象がユニークになった場合
            case 1:
                $cnt += $len;
                break;

            // 対象がない場合
            case 0:
                break;

            // 対象が複数の場合
            default:
                $cnt += check($v, $k == 0 ? $len + 1 : $len);
                break;
        }
    }

    return $cnt;
}

/**
 * @return array<0: array<int, string>, 1: array<int, string>>
 */
function getKarutaList(): array
{
    // [上の句, 下の句]
    $list = [[], []];
    $rows = explode("\n", str_replace("\r", '', file_get_contents('./q33.csv')));
    unset($rows[0]);    // headerの削除
    foreach ($rows as $row) {
        $row = trim($row);
        if ('' == $row) {
            continue;
        }
        $csv = explode(",", $row);
        $list[0][] = trim($csv[3]);
        $list[1][] = trim($csv[4]);
    }

    return $list;
}
