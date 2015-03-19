<?php

require_once 'Connection.php';
require_once 'MedicineTableGateway.php';

$connection = Connection::getInstance();

$gateway = new MedicineTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}

$dateAdministered = $_POST['dateAdministered'];
$medicationName = $_POST['medicationName'];
$dosageGiven = $_POST['dosageGiven'];

$errorMessage = array();
if ($dateAdministered === "") {
    $errorMessage['dateAdministered'] = "Date Administered cannot be empty";
}

if ($medicationName === "") {
    $errorMessage['medicationName'] = "Medication Name cannot be empty";
}

if ($dosageGiven === "") {
    $errorMessage['dosageGiven'] = "Dosage Given cannot be empty";
}

if (empty($errorMessage)) {
    $gateway->insertWard($dateAdministered, $medicationName, $dosageGiven);
    header('Location: home.php');
} else {
    require 'createMedicineForm.php';
}