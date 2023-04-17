<?php
$countries = [
    'Brazil', 'Croatia', 'Mexico', 'Cameroon', 'Spain', 'Netherlands',
    'Chile', 'Australia', 'Colombia', 'Greece', "Cote d'lvoire", 'Japan',
    'Uruguay', 'Costa Rica', 'England', 'Italy', 'Switzerland', 'Ecuador',
    'France', 'Honduras', 'Argentina', 'Bosnia and Herzegovina', 'Iran', 'Nigeria',
    'Germany', 'Portugal', 'Ghana', 'USA', 'Belgium', 'Algeria',
    'Russia', 'Korea Republic',
];
$datas = ['lcMap' => [], 'countryMap' => []];

foreach ($countries as $country) {
    $tmp = strtolower($country);
    $fc = substr($tmp , 0, 1);
    $lc = substr($tmp, -1);
    $datas['lcMap'][$country] = $lc;
    $datas['countryMap'][$fc][$country] = $country;
}

echo playShiritori($datas) . "\n";

/**
 * @param array<lcMap: array<string, string>, countryMap: array<string, array<string, string>>> $datas
 * @param array<int, string> $used
 * @param int $maxNum
 *
 */
function playShiritori(array $datas, array $used = [], int $maxNum = 0): int
{
    $count = count($used);
    $country = $used[$count -1] ?? '';
    if ('' === $country) {
        $targets = array_keys($datas['lcMap']);
    } else {
        $targets = $datas['countryMap'][$datas['lcMap'][$country]] ?? [];
    }

    foreach ($targets as $country) {
        if (in_array($country, $used)) {
            continue;
        }

        $maxNum = playShiritori($datas, $used + [$count => $country], $maxNum);
    }

    return max($maxNum, $count);
}
