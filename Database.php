<?php

class Database {
    private $pdo;
    private $redis;
    private $host = 'localhost';
    private $dbname = 'traffic_tracker';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        try {
            // Connect to MySQL database
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Connect to Redis
            $this->redis = new Redis();
            $this->redis->connect('127.0.0.1', 6379); // Default Redis server
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        } catch (RedisException $e) {
            die("Redis connection failed: " . $e->getMessage());
        }
    }

    // Get PDO instance
    public function getPdo() {
        return $this->pdo;
    }

    // Get visit data with Redis caching
    public function getVisitData() {
        // Try to get the cached visit data from Redis
        $cachedData = $this->redis->get('visit_data');
        
        if ($cachedData) {
            // If data is in cache, return it
            return json_decode($cachedData, true);
        }

        // If no cache, fetch from the database
        $stmt = $this->pdo->query("SELECT * FROM visits ORDER BY timestamp DESC");
        $visitData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cache the visit data in Redis for 5 minutes
        $this->redis->setex('visit_data', 300, json_encode($visitData));

        // Return the visit data
        return $visitData;
    }
}
