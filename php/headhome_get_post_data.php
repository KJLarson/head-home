<?php

$resource_name = "";
$street_address = "";
$city = "";
$state_abbreviation = "";
$zip = "";
$phone_number = "";
$fax_number = "";
$website_url = "";
$database_action = "";

if(isset($_POST['resource_name']) && !empty($_POST['resource_name']))
{
    //printp("Resource Name: \"" . $_POST['resource_name'] . "\"");

    $resource_name = $_POST['resource_name'];
}

if(isset($_POST['street_address']) && !empty($_POST['street_address']))
{
    //printp("Street Address: \"" . $_POST['street_address'] . "\"");

    $street_address = $_POST['street_address'];
}

if(isset($_POST['city']) && !empty($_POST['city']))
{
    //printp("City: \"" . $_POST['city'] . "\"");

    $city = $_POST['city'];
}

if(isset($_POST['state_abbreviation']) && !empty($_POST['state_abbreviation']))
{
    //printp("State (Postal Abbreviation): \"" . $_POST['state_abbreviation'] . "\"");

    $state_abbreviation = $_POST['state_abbreviation'];
}

if(isset($_POST['zip']) && !empty($_POST['zip']))
{
    //printp("Zip Code: \"" . $_POST['zip'] . "\"");

    $zip = $_POST['zip'];
}

if(isset($_POST['phone_number']) && !empty($_POST['phone_number']))
{
    //printp("Phone Number: \"" . $_POST['phone_number'] . "\"");

    $phone_number = $_POST['phone_number'];
}

if(isset($_POST['fax_number']) && !empty($_POST['fax_number']))
{
    //printp("Fax Number: \"" . $_POST['fax_number'] . "\"");

    $fax_number = $_POST['fax_number'];
}

if(isset($_POST['website_url']) && !empty($_POST['website_url']))
{
    //printp("Website URL: \"" . $_POST['website_url'] . "\"");

    $website_url = $_POST['website_url'];
}


if(isset($_POST['database_action']) && !empty($_POST['database_action']))
{
    //printp("Database Action: \"" . $_POST['database_action'] . "\"");

    $database_action = $_POST['database_action'];
}


?>
