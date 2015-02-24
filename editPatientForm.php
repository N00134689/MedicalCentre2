<?php
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatientById($id);
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/patient.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <h1>Edit Patient Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="editPatientForm" name="editPatientForm" action="editPatient.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <table border="0">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="<?php
                                if (isset($_POST) && isset($_POST['name'])) {
                                    echo $_POST['name'];
                                }
                                else echo $row['name'];
                            ?>" />
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
                            <input type="text" name="address" value="<?php
                                if (isset($_POST) && isset($_POST['address'])) {
                                    echo $_POST['address'];
                                }
                                else echo $row['address'];
                            ?>" />
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
                            <input type="text" name="mobile" value="<?php
                                if (isset($_POST) && isset($_POST['mobile'])) {
                                    echo $_POST['mobile'];
                                }
                                else echo $row['Mobile'];
                            ?>" />
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
                            <input type="text" name="email" value="<?php
                                if (isset($_POST) && isset($_POST['email'])) {
                                    echo $_POST['email'];
                                }
                                else echo $row['email'];
                            ?>" />
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
                            <input type="text" name="birthday" value="<?php
                                if (isset($_POST) && isset($_POST['birthday'])) {
                                    echo $_POST['birthday'];
                                }
                                else echo $row['birthday'];
                            ?>" />
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
                        <td></td>
                        <td>
                            <input type="submit" value="Update Patient" name="updatePatient" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <?php require 'footer.php'; ?>
    </body>
</html>
