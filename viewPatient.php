<?php
require_once 'Connection.php';
require_once 'PatientTableGateway.php';
require_once 'WardTableGateway.php';
require_once 'MedicineTableGateway.php';

$sessionId = session_id();
if ($sessionId == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$patientGateway = new PatientTableGateway($connection);
$medicineGateway = new MedicineTableGateway($connection);

$patients = $patientGateway->getPatientById($id);
$medicine = $medicineGateway->getMedicineByPatientId($id);
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
            <h2>View Patient Details</h2>
            <?php
            if (isset($message)) {
                echo '<p>'.$message.'</p>';
            }
            ?>
            <table class="table">
                <tbody>
                    <?php
                    $patient = $patients->fetch(PDO::FETCH_ASSOC);
                    echo '<tr>';
                    echo '<td>Name</td>'
                    . '<td>' . $patient['name'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Address</td>'
                    . '<td>' . $patient['address'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Mobile</td>'
                    . '<td>' . $patient['Mobile'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Email</td>'
                    . '<td>' . $patient['email'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Birthday</td>'
                    . '<td>' . $patient['birthday'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Ward</td>'
                    . '<td>' . $patient['wardName'] . '</td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>
            <p>
                <a href="editPatientForm.php?id=<?php echo $patient['id']; ?>">
                    Edit Patient</a>
                <a class="deletePatient" href="deletePatient.php?id=<?php echo $patient['id']; ?>">
                    Delete Patient</a>
            </p>
            <h3>Medicine Assigned to <?php echo $patient['name']; ?></h3>
            <?php if ($medicine->rowCount() !== 0) { ?>
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
                        $row = $medicine->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $row['dateAdministered'] . '</td>';
                            echo '<td>' . $row['medicationName'] . '</td>';
                            echo '<td>' . $row['dosageGiven'] . '</td>';
                            echo '<td>'
                            . '<a href="viewMedicine.php?id='.$row['id'].'">View</a> '
                            . '<a href="editMedicineForm.php?id='.$row['id'].'">Edit</a> '
                            . '<a class="deleteMedicine" href="deleteMedicine.php?id='.$row['id'].'">Delete</a> '
                            . '</td>';
                            echo '</tr>';

                            $row = $medicine->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
            <?php }  else { ?>
                <p>There is no medicine assigned to this patient.</p>
            <?php } ?>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
