<?php
require __DIR__ . '/../vendor/autoload.php';
// Define APPPATH constant so Config files can reference it when run from CLI helper script
if (!defined('APPPATH')) define('APPPATH', __DIR__ . '/../app/');
require __DIR__ . '/../app/Config/Database.php';
$db = new \Config\Database();
echo "defaultGroup: " . $db->defaultGroup . PHP_EOL;
print_r($db->default);
