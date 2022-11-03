<?php


function whoami()
{
    $name = $_POST["name"];
    $age = $_POST["age"];

    if (isset($name) && isset($age) && $age >0) {
        print "Hi, my name is $name and I'm $age years old.\n";
    } elseif (!isset($name) && isset($age) && $age >0) {
        print "Hi, I have no name and I'm $age years old.\n";
    } elseif (isset($name) && !isset($age) || $age < 0) {
        print "Hi, my name is $name.\n";
    } elseif (!isset($name) && !isset($age)) {
        print "Hi, I have no name.\n";
    } else {
        print "Hi, I have no name.";
    }
}
