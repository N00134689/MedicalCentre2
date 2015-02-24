<?php
require_once 'Connection.php';
require_once 'WardTableGateway.php';

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$wardGateway = new WardTableGateway($connection);

$wards = $wardGateway->getWards();
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
        <h2>View Wards</h2>
        <?php
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>NumBeds</th>
                    <th>Nurse</th>
                    <th>Admitted</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $wards->fetch(PDO::FETCH_ASSOC);
                while ($row) {


                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['numBeds'] . '</td>';
                    echo '<td>' . $row['nurse'] . '</td>';
                    echo '<td>'
                    . '<a href="viewWard.php?id='.$row['id'].'">View</a> '
                    . '<a href="editWardForm.php?id='.$row['id'].'">Edit</a> '
                    . '<a class="deleteWard" href="deleteWard.php?id='.$row['id'].'">Delete</a> '
                    . '</td>';
                    echo '</tr>';

                    $row = $wards->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createWardForm.php">Create Ward</a></p>
        <?php require 'footer.php'; ?>
    </body>
</html>
