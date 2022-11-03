<?php

if ($_GET["input"] == 1) {
    $type = $_GET["type"];
    if (strlen($type) <= 3) {
        echo "not enought";
    } elseif (strlen($type) >= 10) {
        echo "too many";
    } elseif (!preg_match("/^([a-zA-Z-]*)$/", $type)) {
        $typeErr = "No special character";
        echo $typeErr;
    } else {
        echo("ok");
    }
} else {
    $brand = $_GET["brand"];
    if (strlen($brand) <= 2) {
        echo "not enought";
    } elseif (strlen($brand) >= 20) {
        echo "too many";
    } elseif (!preg_match("/^([a-zA-Z-&]*)$/", $brand)) {
        $brandErr = "No special character";
        echo $brandErr;
    } else {
        echo("ok");
    }
}
