<?php
for ($date = "19641010"; $date <= "20200724"; $date = date('Ymd', strtotime($date . "+1day"))) {
    if (0 === $date % 2 || bindec(strrev(decbin($date))) != $date) {
        continue;
    }
    echo $date . "\n";
}
