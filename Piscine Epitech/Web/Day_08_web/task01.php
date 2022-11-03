<?php

function discover_type(int $age, string $name, float $gpa, bool $isStudent)
{
    if ($isStudent == true) {
        print "Hello my name is $name, I'm $age years old. I'm a student at Epitech with a GPA of $gpa.\n";
    } else {
        print "Hello my name is $name, I'm $age years old. I'm not a student.\n";
    }
}
