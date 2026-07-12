<?php
class Database {
    private string $host;
    private string $db;
    private string $user;
    private string $pass;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'localhost';
        $this->db   = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'zmzfdoiw_xtream_server_8_1';
        $this->user = $_ENV['DB_USER'] ?? getenv('DB_USER') ?: 'zmzfdoiw_xtream_server_8_1';
        $this->pass = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?: '30121985';
    }

    public function connect(): PDO {
        return new PDO(
            "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
            $this->user,
            $this->pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }
}
