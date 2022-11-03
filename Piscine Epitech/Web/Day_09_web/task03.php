<?php


function dynamic_body()
{
    $page = $_GET["page"];
    $name = $page.".html";
    if (is_file($name)== true) {
        include "$name";
    } else {
        return "Unknown page";
    }
}
