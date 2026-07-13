<?php
require 'core/Database.php';
$db = new \Core\Database();
$stmt = $db->query("SELECT message, file_name, line_number, created_at FROM error_logs ORDER BY id DESC LIMIT 5");
print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
