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

$id = $_POST['id'];
$name = $_POST['name'];
$numBeds = $_POST['numBeds'];
$nurse = $_POST['nurse'];

$gateway->updatePatient($id, $name, $numBeds, $nurse);

header('Location: home.php');

