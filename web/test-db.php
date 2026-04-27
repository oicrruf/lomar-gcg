<?php
$host = '82.197.82.12';
$db   = 'u320060676_lomar_gcg';
$user = 'u320060676_rm';
$pass = 'pD0!A|Ee@';

echo "Testing PDO...\n";
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    echo "PDO Connected successfully!<br>\n";
} catch (\PDOException $e) {
    echo "PDO Error: " . $e->getMessage() . "<br>\n";
}

echo "Testing MySQLi...\n";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli($host, $user, $pass, $db);
    echo "MySQLi Connected successfully!<br>\n";
} catch (\mysqli_sql_exception $e) {
    echo "MySQLi Error: " . $e->getMessage() . "<br>\n";
}
