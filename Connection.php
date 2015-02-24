<?php
class Connection {

    private static $connection = NULL;

    public static function getInstance() {
        if (Connection::$connection === NULL) {
            // connect to the database
            $host = "daneel";
            $database = "n00134689";
            $username = "N00134689";
            $password = "N00134689";

            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) {
                die("Could not connect to database");
            }
        }

        return Connection::$connection;
    }
}
