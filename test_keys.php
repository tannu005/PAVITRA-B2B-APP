<?php
require 'core/Database.php';
$db = new \Core\Database();
$stmt = $db->query("SELECT setting_key, setting_value FROM system_settings");
print_r($stmt->fetchAll(\PDO::FETCH_KEY_PAIR));
