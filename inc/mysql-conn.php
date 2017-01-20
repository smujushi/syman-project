<?php
require_once 'options.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
        die("MySQLi Error: Connection failed: " . $conn->connect_error);
}
?>
