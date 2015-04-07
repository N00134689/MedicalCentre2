<?php
require_once 'Connection.php';
require_once 'MedicineTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$medicineGateway = new MedicineTableGateway($connection);

$medicines = $medicineGateway->getMedicines();
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
            <h2>View Medicines</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date Administered</th>
                        <th>Medication Name</th>
                        <th>Dosage Given</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $medicines->fetch(PDO::FETCH_ASSOC);
                    while ($row) {
                        echo '<td>' . $row['dateAdministered'] . '</td>';
                        echo '<td>' . $row['medicationName'] . '</td>';
                        echo '<td>' . $row['dosageGiven'] . '</td>';
                        echo '<td>' . $row['patientName'] . '</td>';
                        echo '<td>'
                        . '<a href="viewMedicine.php?id='.$row['id'].'">View</a> '
                        . '<a href="editMedicineForm.php?id='.$row['id'].'">Edit</a> '
                        . '<a class="deleteMedicine" href="deleteMedicine.php?id='.$row['id'].'">Delete</a> '
                        . '</td>';
                        echo '</tr>';

                        $row = $medicines->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <p><a href="createMedicineForm.php">Create Medicine</a></p>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
