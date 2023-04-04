<?php
$operator = ['*', ''];
$useOps = [];

for ($i = 1000; $i < 10000; ++$i) {
    $num = sprintf('%d', $i);
    $revnum = strrev($num);
    foreach ($operator as $useOps[0]) {
        foreach ($operator as $useOps[1]) {
            foreach ($operator as $useOps[2]) {

                if (!checkUseOperators($useOps)) {
                    continue;
                }

                $value = '';
                $formula = '';
                for ($j = 0; $j < 4; ++$j) {
                    $value .= $num[$j];

                    if (isset($useOps[$j])) {
                        if ('' === $useOps[$j]) {
                            continue;
                        }

                        $formula .= (int)$value . $useOps[$j];
                    } else {
                        $formula .= (int)$value;
                    }

                    $value = '';
                }

                eval('$result = ' . $formula . ';');
                if (!is_int($result)
                    || 1000 > $result
                    || $result != $revnum) {
                    continue;
                }

                echo "----------------------\n";
                echo $num . "\n";
                echo $formula . "\n";
            }
        }
    }
}

/**
 * 四則演算が最低1つ以上使われるか
 */
function checkUseOperators(array $useOps): bool
{
    $checkOps = array_unique($useOps);
    if (1 < count($checkOps)) {
        return true;
    }

    return '' != $checkOps[0];
}
