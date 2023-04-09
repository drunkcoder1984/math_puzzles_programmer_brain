<?php
for ($date = "19641010"; $date <= "20200724"; $date = date('Ymd', strtotime($date . "+1day"))) {
    if (bindec(strrev(decbin($date))) == $date) {
        echo $date . "\n";
    }
}
