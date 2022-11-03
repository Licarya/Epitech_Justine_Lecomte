<?php

 function dog_bark($woof_nb)
 {
     $i = 0;
     while ($i < $woof_nb) {
         $i++;
         echo "woof";
         if ($i < $woof_nb) {
             echo " ";
         }
     }
     echo "\n";
 }
