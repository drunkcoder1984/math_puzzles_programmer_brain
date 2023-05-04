<?php
echo route(6, 6, 0) . PHP_EOL;

/**
 * @param int $width
 * @param int $height
 * @param int $backY
 * @return int
 */
function route(int $width, int $height, int $backY): int
{
    if (1 == $width) {
        return $backY == $height ? $backY : $backY + 2;
    } elseif (1 == $height) {
        return 0 == $backY ? 2 : 1;
    }

    $total = 0;
    if (0 == $backY) {
        for ($i = 0; $i < $height; ++$i) {
            $total += 2 * route($width - 1, $height, $i + 1);
        }
    } else {
        for ($i = $backY; $i <= $height; ++$i) {
            $total += route($width - 1, $height, $i);
        }
        $total += route($width, $height - 1, $backY - 1);
    }

    return $total;
}
