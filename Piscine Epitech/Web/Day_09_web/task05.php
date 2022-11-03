<?php

function form_is_submitted()
{
    if (isset($_POST["submit"])) {
        return true;
    } else {
        return false;
    }
}


function whoami()
{
    $name = $_POST["name"];
    $age = $_POST["age"];
    $curri = $_POST["curriculum"];

    if ($name != "" && $age !="") {
        print "Hi, my name is $name and I'm $age years old.";
    } elseif (!$name && $age || $name=="" && $age) {
        print "Hi, I have no name and I'm $age years old.";
    } elseif ($name && !$age) {
        print "Hi, my name is $name.";
    } elseif (!$name && !$age || $name="" && $age="") {
        print "Hi.";
    }

    switch ($curri) {
                case "pge":
                        print " I'm a student of PGE (Programme Grande Ecole).";
                        break;

                case  "msc":
                        print " I'm a student of MSc pro.";
                        break;

                case "coding":
                        print " I'm a student of Coding Academy.";
                        break;

                case "wac":
                        print " I'm a student of Web@cademie.";
                        break;
                default:
                        break;
        }
}
