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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/ward.js"></script>
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
                    echo '<td>Number of Beds</td>'
                    . '<td>' . $row['numBeds'] . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td>Nurse</td>'
                    . '<td>' . $row['nurse'] . '</td>';
                    echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href="editWardForm.php?id=<?php echo $row['id']; ?>">
                Edit Ward</a>
            <a class="deleteWard" href="deleteWard.php?id=<?php echo $row['id']; ?>">
                Delete Ward</a>
        </p>
        <?php require 'footer.php'; ?>
    </body>
</html>
