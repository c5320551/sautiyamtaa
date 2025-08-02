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
        // Environment-specific configuration
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            // Codespace/Local development settings
            $this->host = '127.0.0.1';
            $this->db_name = 'sautiya1_mtaa';
            $this->username = 'root';  // Often 'root' in development
            $this->password = 'rootpassword';  // Your dev password
        } else {
            // Production settings (DirectAdmin)
            $this->host = '127.0.0.1';
            $this->db_name = 'sautiya1_mtaa';
            $this->username = 'sautiya1_mtaa';  
            $this->password = 'A5(Bh0ZP74ep*r';  
        }

        $this->connect();
    }

    private function connect() {
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
            
            // Check if it's a driver issue
            if (strpos($this->error, 'could not find driver') !== false) {
                $this->handleDriverError();
            }
            
            // Show user-friendly error in development, log in production
            if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
                die("Database connection failed: " . $this->error);
            } else {
                die("Sorry, we're experiencing technical difficulties. Please try again later.");
            }
        }
    }

    private function handleDriverError() {
        $message = "MySQL PDO driver not found. Please install it:\n";
        $message .= "sudo apt update && sudo apt install php-mysql php-pdo-mysql\n";
        $message .= "Then restart your web server.";
        
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            die($message);
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