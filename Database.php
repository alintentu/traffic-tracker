<?php

class Database {
    private $pdo;
    private $host = 'localhost';
    private $dbname = 'traffic_tracker';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        try {
            // Establish a PDO connection
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle any database connection errors
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Public method to get PDO instance
    public function getPdo() {
        return $this->pdo;
    }

    // New method to fetch visit data from the database
    public function getVisitData() {
        // Query to get all visit records
        $stmt = $this->pdo->query("SELECT * FROM visits ORDER BY timestamp DESC");

        // Fetch all rows from the result set
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
