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
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$birthday= $_POST['birthday'];

$gateway->updatePatient($id, $name, $address, $mobile, $email, $birthday);

header('Location: home.php');

