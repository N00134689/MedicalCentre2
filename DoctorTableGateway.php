<?php

class DoctorTableGateway {

    private $connection;

    public function __construct($d) {
        $this->connection = $d;
    }

    public function getDoctors() {
        // execute a query to get all doctors
        //$sqlQuery =
        //        "SELECT d.*, p.name AS patientName
        //         FROM doctors d
        //         LEFT JOIN patients p ON p.id = d.doctor_id";
        $sqlQuery = "SELECT * from doctors";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("Could not retrieve doctors");
        }

        return $statement;
    }

    public function getDoctorById($id) {
        // execute a query to get the doctor with the specified id
        //$sqlQuery =
        //        "SELECT d.*, p.name AS patientName
        //         FROM doctors d
        //         LEFT JOIN patients p ON p.id = d.patient_id
        //         WHERE d.id = :id";

        $sqlQuery = "SELECT * FROM doctors WHERE id = :id";
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve doctor");
        }

        return $statement;
    }

    public function insertDoctor($dn, $dm, $de, $as) {
        $sqlQuery = "INSERT INTO doctors " .
                "(doctorName, doctorMobile, doctorEmail, areaOfSpecialisation) " .
                "VALUES (:doctorName, :doctorMobile, :doctorEmail, :areaOfSpecialisation)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "doctorName" => $dn,
            "doctorMobile" => $dm,
            "doctorEmail" => $de,
            "areaOfSpecialisation" => $as
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert doctor");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deleteDoctor($id) {
        $sqlQuery = "DELETE FROM doctors WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete doctor");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateDoctor($id, $dn, $dm, $de, $as, $pId) {
        $sqlQuery =
                "UPDATE doctors SET " .
                "doctorName = :doctorName, " .
                "doctorMobile = :doctorMobile, " .
                "doctorEmail = :doctorEmail, " .
                "areaOfSpecialisation = :areaOfSpecialisation " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "doctorName" => $dn,
            "doctorMobile" => $dm,
            "doctorEmail" => $de,
            "areaOfSpecialisation" => $as
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
}
