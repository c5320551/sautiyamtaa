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
        // Existing users table
        $usersSql = "
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT UNIQUE NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        // Events table
        $eventsSql = "
            CREATE TABLE IF NOT EXISTS events (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                event_date DATE NOT NULL,
                start_time TIME,
                end_time TIME,
                location VARCHAR(255),
                expected_attendees INT DEFAULT 0,
                icon_class VARCHAR(100) DEFAULT 'fas fa-calendar-alt',
                is_featured BOOLEAN DEFAULT 0,
                status VARCHAR(20) DEFAULT 'upcoming',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ";
        
        try {
            $this->pdo->exec($usersSql);
            $this->pdo->exec($eventsSql);
            
            // Insert sample events if table is empty
            $this->insertSampleEvents();
            
        } catch (PDOException $e) {
            error_log("Error creating dev tables: " . $e->getMessage());
        }
    }

    private function insertSampleEvents() {
        // Check if events table is empty
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM events");
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            $sampleEvents = [
                [
                    'title' => 'Community Town Hall: Affordable Housing Crisis',
                    'description' => 'Join us for a critical discussion on the housing affordability crisis affecting our community. City officials, housing advocates, and community members will come together to explore solutions and plan actionable steps forward.',
                    'event_date' => '2025-08-15',
                    'start_time' => '18:00:00',
                    'end_time' => '20:30:00',
                    'location' => 'Community Center Hall',
                    'expected_attendees' => 200,
                    'icon_class' => 'fas fa-bullhorn',
                    'is_featured' => 1
                ],
                [
                    'title' => 'Youth Leadership Workshop',
                    'description' => 'Empowering the next generation of community leaders through interactive workshops on public speaking, organizing, and advocacy.',
                    'event_date' => '2025-08-20',
                    'start_time' => '10:00:00',
                    'end_time' => '16:00:00',
                    'location' => 'Youth Center',
                    'expected_attendees' => 50,
                    'icon_class' => 'fas fa-graduation-cap',
                    'is_featured' => 0
                ],
                [
                    'title' => 'Community Garden Day',
                    'description' => 'Join us for a day of planting, learning about sustainable agriculture, and building community connections through gardening.',
                    'event_date' => '2025-08-25',
                    'start_time' => '09:00:00',
                    'end_time' => '14:00:00',
                    'location' => 'Central Park Garden',
                    'expected_attendees' => 75,
                    'icon_class' => 'fas fa-seedling',
                    'is_featured' => 0
                ],
                [
                    'title' => 'Small Business Networking',
                    'description' => 'Connect with local entrepreneurs, learn about business resources, and explore opportunities for collaboration and growth.',
                    'event_date' => '2025-09-01',
                    'start_time' => '18:00:00',
                    'end_time' => '21:00:00',
                    'location' => 'Business Hub',
                    'expected_attendees' => 80,
                    'icon_class' => 'fas fa-chart-line',
                    'is_featured' => 0
                ],
                [
                    'title' => 'Community Health Fair',
                    'description' => 'Free health screenings, wellness education, and connections to healthcare resources for the entire family.',
                    'event_date' => '2025-09-10',
                    'start_time' => '11:00:00',
                    'end_time' => '17:00:00',
                    'location' => 'Main Street Plaza',
                    'expected_attendees' => 150,
                    'icon_class' => 'fas fa-heartbeat',
                    'is_featured' => 0
                ]
            ];
            
            $insertSql = "INSERT INTO events (title, description, event_date, start_time, end_time, location, expected_attendees, icon_class, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($insertSql);
            
            foreach ($sampleEvents as $event) {
                $stmt->execute([
                    $event['title'],
                    $event['description'],
                    $event['event_date'],
                    $event['start_time'],
                    $event['end_time'],
                    $event['location'],
                    $event['expected_attendees'],
                    $event['icon_class'],
                    $event['is_featured']
                ]);
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
?>