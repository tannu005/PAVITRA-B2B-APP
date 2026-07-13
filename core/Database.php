<?php
namespace Core;
class Database {
    protected ?\PDO $pdo = null;
    public ?string $connectionError = null;
    public function __construct() {
        $config = require dirname(__DIR__) . '/config/db.php';
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
        try {
            $this->pdo = new \PDO($dsn, $config['username'], $config['password'], [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (\PDOException $e) {
            if ($e->getCode() == 1049 || str_contains($e->getMessage(), 'Unknown database')) {
                try {
                    $tempDsn = "mysql:host={$config['host']};port={$config['port']};charset={$config['charset']}";
                    $tempPdo = new \PDO($tempDsn, $config['username'], $config['password']);
                    $tempPdo->exec("CREATE DATABASE IF NOT EXISTS `{$config['dbname']}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                    $this->pdo = new \PDO($dsn, $config['username'], $config['password'], [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                        \PDO::ATTR_EMULATE_PREPARES => false,
                    ]);
                } catch (\PDOException $innerEx) {
                    $this->connectionError = "Database connection failed and auto-creation was unsuccessful: " . $innerEx->getMessage();
                }
            } else {
                $this->connectionError = $e->getMessage();
            }
        }
    }
    public function getPdo(): \PDO {
        if (!$this->pdo) {
            throw new \PDOException("Database connection is not established. Error: " . $this->connectionError);
        }
        return $this->pdo;
    }
    public function query(string $sql, array $params = []): \PDOStatement {
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    public function prepare(string $sql): \PDOStatement {
        return $this->getPdo()->prepare($sql);
    }
    public function lastInsertId(): string {
        return $this->getPdo()->lastInsertId();
    }
    public function beginTransaction(): bool {
        return $this->getPdo()->beginTransaction();
    }
    public function commit(): bool {
        return $this->getPdo()->commit();
    }
    public function rollBack(): bool {
        return $this->getPdo()->rollBack();
    }
    public function inTransaction(): bool {
        return $this->getPdo()->inTransaction();
    }
}
