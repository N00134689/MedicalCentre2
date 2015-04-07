<?php

class MedicineTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getMedicines() {
        // execute a query to get all medicines
        $sqlQuery =
                "SELECT m.*, p.name AS patientName
                 FROM medicines m
                 LEFT JOIN patients p ON p.id = m.patient_id";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve medicines");
        }

        return $statement;
    }

    public function getMedicinesByPatientId($patientId) {
        // execute a query to get all medicines
        $sqlQuery =
                "SELECT m.*, p.name AS patientName
                 FROM medicines m
                 LEFT JOIN medicines p ON p.id = m.patient_id
                 WHERE m.patient_id = :patient_id";

        $params = array(
            "patient_id" => $patientId
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve medicines");
        }

        return $statement;
    }

    public function getMedicineById($id) {
        // execute a query to get the medicine with the specified id
        $sqlQuery =
                "SELECT m.*, p.name AS patientName
                 FROM medicines m
                 LEFT JOIN patients p ON p.id = m.patient_id
                 WHERE m.id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve medicine");
        }

        return $statement;
    }

        public function insertMedicine($da, $mn, $dg, $pId) {
        $sqlQuery = "INSERT INTO medicines " .
                "(dateAdministered, medicationName, dosageGiven, patient_id) " .
                "VALUES (:dateAdministered, :medicationName, :dosageGiven, :patient_id)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dateAdministered" => $da,
            "medicationName" => $mn,
            "dosageGiven" => $dg,
            "patient_id" => $pId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert medicine");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteMedicine($id) {
        $sqlQuery = "DELETE FROM medicines WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete medicine");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateMedicine($id, $da, $mn, $dg, $pId) {
        $sqlQuery =
                "UPDATE medicines SET " .                             
                "dateAdministered = :dateAdministered, " .
                "medicationName = :medicationName, " .
                "dosageGiven = :dosageGiven, " .
                "patient_id = :patient_id " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "dateAdministered" => $da,
            "medicationName" => $mn,
            "dosageGiven" => $dg,
            "patient_id" => $pId
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
}