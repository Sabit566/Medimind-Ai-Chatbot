<?php
// ── Database Configuration ──
define('DB_HOST', 'localhost');
define('DB_USER', 'root');         // Change to your DB username
define('DB_PASS', '');             // Change to your DB password
define('DB_NAME', 'medicare_db');

function getDB() {
    static $conn = null;
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            // Return null so pages degrade gracefully
            return null;
        }
        $conn->set_charset('utf8mb4');
    }
    return $conn;
}
?>
