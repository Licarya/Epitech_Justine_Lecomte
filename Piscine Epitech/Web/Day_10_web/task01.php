<?php

$name = $_GET["name"];

    $tab = array( "Name" => $name);
    $result = JSON_encode($tab);
    echo $result;
