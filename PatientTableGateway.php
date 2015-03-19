<?php

class PatientTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getPatients() {
        // execute a query to get all patients
        $sqlQuery =
                "SELECT p.*, w.name AS wardName
                 FROM patients p
                 LEFT JOIN wards w ON w.id = p.ward_id";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }

    public function getPatientsByWardId($wardId) {
        // execute a query to get all patients
        $sqlQuery =
                "SELECT p.*, w.name AS wardName
                 FROM patients p
                 LEFT JOIN wards w ON w.id = p.ward_id
                 WHERE p.ward_id = :wardId";

        $params = array(
            'wardId' => $wardId
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve patients");
        }

        return $statement;
    }

    public function getPatientById($id) {
        // execute a query to get the user with the specified id
        $sqlQuery =
                "SELECT p.*, w.name AS wardName
                 FROM patients p
                 LEFT JOIN wards w ON w.id = p.ward_id
                 WHERE p.id = :id";

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

    public function insertProgrammer($n, $a, $m, $sn, $sk, $sl, $mId) {
        $sqlQuery = "INSERT INTO programmers " .
                "(name, email, mobile, staffNumber, skills, salary, manager_id) " .
                "VALUES (:name, :email, :mobile, :staffNumber, :skills, :salary, :manager_id)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "name" => $n,
            "email" => $e,
            "mobile" => $m,
            "staffNumber" => $sn,
            "skills" => $sk,
            "salary" => $sl,
            "manager_id" => $mId
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert programmer");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteProgrammer($id) {
        $sqlQuery = "DELETE FROM programmers WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete programmer");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateProgrammer($id, $n, $a, $m, $e, $b, $wId) {
        $sqlQuery =
                "UPDATE programmers SET " .
                "name = :name, " .               
                "address = :address, " .
                "mobile = :mobile, " .
                "email = :email, " .
                "birthday = :birthday, " .
                "ward_id = :ward_id " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id,
            "name" => $n,
            "address" => $a,
            "mobile" => $m,
            "email" => $e,
            "birthday" => $b,
            "manager_id" => $mId
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
}