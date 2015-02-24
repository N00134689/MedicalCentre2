<?php

require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$connection = Connection::getInstance();

$gateway = new PatientTableGateway($connection);

$id = session_id();
if ($id == "") {
    session_start();
}

$name = $_POST['name'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];

$errorMessage = array();
if ($name === "") {
    $errorMessage['name'] = "Name cannot be empty";
}

if ($address === "") {
    $errorMessage['address'] = "Address cannot be empty";
}

if ($mobile === "") {
    $errorMessage['mobile'] = "Mobile cannot be empty";
}

if ($email === "") {
    $errorMessage['email'] = "Email cannot be empty";
}

if ($birthday === "") {
    $errorMessage['birthday'] = "Birthday cannot be empty";
}
if (empty($errorMessage)) {
    $gateway->insertPatient($name, $address, $mobile, $email, $birthday);
    header('Location: home.php');
} else {
    require 'createPatientForm.php';
}