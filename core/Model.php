<?php

namespace Core;

abstract class Model {
    protected static string $table = '';

    public static function db(): Database {
        return Application::$app->db;
    }

    public static function find(int $id): ?array {
        $table = static::$table;
        $stmt = self::db()->prepare("SELECT * FROM `{$table}` WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function all(string $orderBy = 'id DESC'): array {
        $table = static::$table;
        $stmt = self::db()->query("SELECT * FROM `{$table}` ORDER BY {$orderBy}");
        return $stmt->fetchAll();
    }

    public static function where(string $condition, array $params = []): array {
        $table = static::$table;
        $stmt = self::db()->prepare("SELECT * FROM `{$table}` WHERE {$condition}");
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
