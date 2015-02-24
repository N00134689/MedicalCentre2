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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/patient.js"></script>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <?php
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Name</td>'
                    . '<td>' . $row['name'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Address</td>'
                    . '<td>' . $row['address'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Mobile</td>'
                    . '<td>' . $row['Mobile'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Email</td>'
                    . '<td>' . $row['email'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Birthday</td>'
                    . '<td>' . $row['birthday'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href="editPatientForm.php?id=<?php echo $row['id']; ?>">
                Edit Patient</a>
            <a class="deletePatient" href="deletePatient.php?id=<?php echo $row['id']; ?>">
                Delete Patient</a>
        </p>
        <?php require 'footer.php'; ?>
    </body>
</html>
