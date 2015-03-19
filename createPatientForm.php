<?php
require_once 'connection.php';
require_once 'WardTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$conn = Connection::getInstance();
$wardGateway = new WardTableGateway($conn);

$wards = $wardGateway->getWards();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php require "styles.php" ?>
        <script type="text/javascript" src="js/patient.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>Create Patient Form</h2>
            <?php
            if (isset($errorMessage)) {
                echo '<p>Error: ' . $errorMessage . '</p>';
            }
            ?>
        <form id="createPatientForm" action="createPatient.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="" />
                            <span id="nameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['name'])) {
                                    echo $errorMessage['name'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>
                            <input type="text" name="address" value="" />
                            <span id="addressError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['address'])) {
                                    echo $errorMessage['address'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>
                            <input type="text" name="mobile" value="" />
                            <span id="mobileError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['mobile'])) {
                                    echo $errorMessage['mobile'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" value="" />
                            <span id="emailError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['email'])) {
                                    echo $errorMessage['email'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Birthday</td>
                        <td>
                            <input type="text" name="birthday" value="" />
                            <span id="birthdayError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['birthday'])) {
                                    echo $errorMessage['birthday'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                     <tr>
                            <td>Ward</td>
                            <td>
                                <select name="ward_id">
                                    <option value="-1">No ward</option>
                                    <?php
                                    $w = $wards->fetch(PDO::FETCH_ASSOC);
                                    while ($w) {
                                        echo '<option value="' . $w['id'] . '">' . $w['name'] . '</option>';
                                        $w = $wards->fetch(PDO::FETCH_ASSOC);
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Create Patient" name="createPatient" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php'; ?>
    </body>
</html>
