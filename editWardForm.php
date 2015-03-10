<?php
require_once 'Connection.php';
require_once 'WardTableGateway.php';

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
$gateway = new WardTableGateway($connection);

$statement = $gateway->getWardById($id);
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
        <script type="text/javascript" src="js/ward.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <h1>Edit Ward Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="editWardForm" name="editWardForm" action="editWard.php" method="POST">
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
                        <td>Number of Beds</td>
                        <td>
                            <input type="text" name="numBeds" value="<?php
                                if (isset($_POST) && isset($_POST['numBeds'])) {
                                    echo $_POST['numBeds'];
                                }
                                else echo $row['numBeds'];
                            ?>" />
                            <span id="numBedsError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['numBeds'])) {
                                    echo $errorMessage['numBeds'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Nurse</td>
                        <td>
                            <input type="text" name="nurse" value="<?php
                                if (isset($_POST) && isset($_POST['nurse'])) {
                                    echo $_POST['nurse'];
                                }
                                else echo $row['nurse'];
                            ?>" />
                            <span id="nurseError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['nurse'])) {
                                    echo $errorMessage['nurse'];
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
