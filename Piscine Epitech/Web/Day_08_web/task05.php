<?php

function calc_average(array $tab)
{
    $tot = count($tab);
    $result = 0;

    for ($i = 0; $i < $tot; $i++) {
        if ($i < $tot) {
            $result = $result + $tab[$i];
        }
    }
    $result = $result / $tot;
    return round($result, 1);
}
