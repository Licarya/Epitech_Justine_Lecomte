<?php


function render_body(string $nom)
{
    $name = $nom.".html";
    if (is_file($name) == true) {
        include "$name";
    } else {
        return "Unknown page";
    }
}
