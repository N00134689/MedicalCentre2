<?php
require_once 'Connection.php';
require_once 'DoctorTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$doctorGateway = new DoctorTableGateway($connection);

$doctors = $doctorGateway->getDoctors();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/patient.js"></script>
        <?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <h2>View Doctors</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Doctor Mobile</th>
                        <th>Doctor Email</th>
                        <th>Area of Specialisation</th>
                        <th>Patient</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $doctors->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<td>' . $row['Doctor Name'] . '</td>';
                        echo '<td>' . $row['Doctor Mobile'] . '</td>';
                        echo '<td>' . $row['Doctor Email'] . '</td>';
                        echo '<td>' . $row['Area of Specialisation'] . '</td>';
                        //echo '<td>' . $row['patientName'] . '</td>';
                        echo '<td>'
                        //. '<a href="viewDoctor.php?id='.$row['id'].'">View</a> '
                        //. '<a href="editDoctorForm.php?id='.$row['id'].'">Edit</a> '
                        //. '<a class="deleteDoctor" href="deleteDoctor.php?id='.$row['id'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $doctors->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createDoctorForm.php">Create Doctor</a></p>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
