<?php

class PatientTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getPatients() {
        // execute a query to get all patients
        $sqlQuery = "SELECT * FROM patients";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }

    public function getPatientById($id) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM patients WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve patient");
        }

        return $statement;
    }

    public function insertPatient($n, $a, $m, $e, $b) {
        $sqlQuery = "INSERT INTO patients " .
                "(name, address, Mobile, email, birthday) " .
                "VALUES (:name, :address, :mobile, :email, :birthday)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "name" => $n,
            "address" => $a,
            "mobile" => $m,
            "email" => $e,
            "birthday" => $b
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert user");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deletePatient($id) {
        $sqlQuery = "DELETE FROM patients WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete user");
        }

        return ($statement->rowCount() == 1);
    }

    public function updatePatient($id, $n, $a, $m, $e, $b) {
        $sqlQuery =
                "UPDATE patients SET " .
                "name = :name, " .
                "address = :address, " .
                "Mobile = :mobile, " .
                "email = :email, " .
                "birthday = :birthday " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id,
            "name" => $n,
            "address" => $a,
            "mobile" => $m,
            "email" => $e,
            "birthday" => $b,
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
}