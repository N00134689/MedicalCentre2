<?php

class WardTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getWards() {
        // execute a query to get all wards
        $sqlQuery = "SELECT * FROM wards";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve wards");
        }

        return $statement;
    }

    public function getWardById($id) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM wards WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve ward");
        }

        return $statement;
    }

    public function insertWard($n, $nb, $nr) {
        $sqlQuery = "INSERT INTO wards " .
                "(name, numBeds, nurse) " .
                "VALUES (:name, :numBeds, :nurse)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "name" => $n,
            "numBeds" => $nb,
            "nurse" => $nr
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert user");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteWard($id) {
        $sqlQuery = "DELETE FROM wards WHERE id = :id";

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

    public function updateWard($id, $n, $nb, $nr) {
        $sqlQuery =
                "UPDATE wards SET " .
                "name = :name, " .
                "numBeds = :numBeds, " .
                "nurse = :nurse " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id,
            "name" => $n,
            "numBeds" => $nb,
            "nurse" => $nr
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
}