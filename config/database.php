<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    public function __construct() {
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            $this->connectSQLite();
        } else {
            $this->connectMySQL();
        }
    }

    private function connectSQLite() {
        try {
            // SQLite database for development (no driver issues)
            $this->pdo = new PDO('sqlite:' . __DIR__ . '/dev_database.db');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Create tables if they don't exist (basic structure)
            $this->createDevTables();
            
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            error_log("SQLite connection failed: " . $this->error);
            die("Development database connection failed: " . $this->error);
        }
    }

    private function connectMySQL() {
        // Production MySQL settings
        $this->host = '127.0.0.1';
        $this->db_name = 'sautiya1_mtaa';
        $this->username = 'sautiya1_mtaa';  
        $this->password = 'A5(Bh0ZP74ep*r';

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
            error_log("MySQL connection failed: " . $this->error);
            die("Production database connection failed: " . $this->error);
        }
    }

    private function createDevTables() {
        // Add your basic table structure here for development
        // This is just an example - adjust based on your actual schema
        $sql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT UNIQUE NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            error_log("Error creating dev tables: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getError() {
        return $this->error;
    }
}
?>