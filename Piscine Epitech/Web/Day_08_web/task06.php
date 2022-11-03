<?php


#parcourir la ligne, et count a chaque nbr diff rencontré
# $start = nbre de fois le character, suivit du character

function sequence(int $n)
{
    $start = "1";
    $repet =0;
    echo $start."\n";

    while ($repet < $n) {
        $counter = 0;
        $caract= "";
        $string= "";

        for ($i = 0; $i < strlen($start); $i++) {
            if ($caract== "") {
                $caract = $start[$i];
                $counter = 1;
            } elseif ($caract != $start[$i]) {
                $string = $string.$counter.$caract;
                $caract = $start[$i];
                $counter = 1;
            } else {
                $counter = $counter +1 ;
            }
        }

        $string = $string.$counter.$caract;
        $start = $string;
        $repet++;
        echo $start."\n";
    }
}
