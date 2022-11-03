<?php

#créer function get_short qui prend en parametre un tableau de caractère
# comparer et retourner le plus court des paramètres
#si plusieurs de la même taille, on retourne le premier des paramètres

#comparer des chaines de caractères => strcmp(string1, string2)
#stocker le caractère dans une variable



function get_shortest(array $tab)
{
    $result= null;

    for ($t = 0 ; $t < count($tab); $t++) {
        if ($t == 0) {
            $result = $tab[$t];
        } elseif (strlen($result) > strlen($tab[$t])) {
            $result = $tab[$t];
        }
    }
    return $result;
}
