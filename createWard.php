<?php

require_once 'Connection.php';
require_once 'WardTableGateway.php';

$connection = Connection::getInstance();

$gateway = new WardTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}

$name = $_POST['name'];
$numBeds = $_POST['numBeds'];
$nurse = $_POST['nurse'];

$errorMessage = array();
if ($name === "") {
    $errorMessage['name'] = "Name cannot be empty";
}

if ($numBeds === "") {
    $errorMessage['numBeds'] = "NumBeds cannot be empty";
}

if ($nurse === "") {
    $errorMessage['nurse'] = "Nurse cannot be empty";
}

if (empty($errorMessage)) {
    $gateway->insertWard($name, $numBeds, $nurse);
    header('Location: home.php');
} else {
    require 'createWardForm.php';
}