<?php
class Database {
    private $host = '127.0.0.1';
    private $db_name = 'sautiya1_mtaa';
    private $username = 'sautiya1_mtaa';  
    private $password = 'A5(Bh0ZP74ep*r';  
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            error_log("Database connection failed: " . $this->error);
            
            // Show user-friendly error in development, log in production
            if (ENVIRONMENT === 'development') {
                die("Database connection failed: " . $this->error);
                
            } else {
                die("Sorry, we're experiencing technical difficulties. Please try again later.");
            }
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getError() {
        return $this->error;
    }
}
