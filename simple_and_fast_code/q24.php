<?php
$hits = [
    [1], [2], [3], [4], [5], [6], [7], [8], [9],
    [1, 2], [2, 3], [3, 6], [6, 9], [9, 8], [8, 7], [7, 4], [4, 1],
];

echo check($hits) . "\n";

/**
 * @param array<int, array<int, int>> $hits
 * @param array<int, int> $used
 * @param array<string, int> $memo
 * @return int
 */
function check(array $hits, array $used = [], array &$memo = []): int
{
    if (9 <= count($used)) {
        return 1;
    }

    sort($used);
    $hash = hash('md5', json_encode($used));
    if (isset($memo[$hash])) {
        return $memo[$hash];
    }

    $cnt = 0;
    foreach ($hits as $k => $v) {
        if (count($v) > count(array_diff($v, $used))) {
            continue;
        }

        $nextHits = $hits;
        unset($nextHits[$k]);
        $cnt += check($nextHits, array_merge($v, $used), $memo);
    }

    $memo[$hash] = $cnt;
    return $memo[$hash];
}

