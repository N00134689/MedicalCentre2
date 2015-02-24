<?php
require_once 'Connection.php';
require_once 'PatientTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new PatientTableGateway($connection);

$statement = $gateway->getPatients();
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
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                while ($row) {


                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['Mobile'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['birthday'] . '</td>';
                    echo '<td>'
                    . '<a href="viewPatient.php?id='.$row['id'].'">View</a> '
                    . '<a href="editPatientForm.php?id='.$row['id'].'">Edit</a> '
                    . '<a class="deletePatient" href="deletePatient.php?id='.$row['id'].'">Delete</a> '
                    . '</td>';
                    echo '</tr>';

                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createPatientForm.php">Create Patient</a></p>
        <?php require 'footer.php'; ?>
    </body>
</html>
