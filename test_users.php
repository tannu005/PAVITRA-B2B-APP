<?php
require 'core/Database.php';
$db = new \Core\Database();
$stmt = $db->query("SELECT id, name, email, status FROM users");
print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
