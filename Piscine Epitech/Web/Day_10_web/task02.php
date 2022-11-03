<?php

//print_r($_POST);

if (isset($_POST["chain"][0]["name"])) {
    $valueName = $_POST["chain"][0]["value"];
    // print $valueName;
}
if (isset($_POST["chain"][1]["name"])) {
    $valueMail = $_POST["chain"][1]["value"];
    // print $valueMail;
}

if (!filter_var($valueMail, FILTER_VALIDATE_EMAIL)) {
    echo http_response_code(400);
} else {
    $tab = array( "name" => $valueName, "mail" => $valueMail);
    $result = JSON_encode($tab);
    echo $result;
}
