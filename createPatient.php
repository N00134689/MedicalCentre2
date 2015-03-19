<?php
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$name        = filter_input(INPUT_POST, 'name',        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$address     = filter_input(INPUT_POST, 'address',     FILTER_SANITIZE_ADDRESS);
$mobile      = filter_input(INPUT_POST, 'mobile',      FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email       = filter_input(INPUT_POST, 'email',       FILTER_SANITIZE_EMAIL);
$birthday    = filter_input(INPUT_POST, 'birthday',    FILTER_SANITIZE_EMAIL);
$wardId      = filter_input(INPUT_POST, 'ward_id',     FILTER_SANITIZE_NUMBER_INT);
if ($wardId == -1) {
    $wardId = NULL;
}

$id = $gateway->insertPatient($name, $address, $email, $mobile, $birthday, $wardId);

header('Location: viewPatients.php');
